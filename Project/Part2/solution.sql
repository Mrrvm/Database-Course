-- 3. query to retrieve the name(s) of the patient(s) with the highest number of readings
--    of units of “LDL cholesterol in mg/dL" above 200 in the past 90 days
SELECT Patient.name FROM Patient, Wears, Reading, Sensor
WHERE Patient.p_number = Wears.patient
    AND Wears.snum = Reading.snum
    AND Wears.manuf = Reading.manuf
    AND Sensor.snum = Reading.snum
    AND Sensor.manuf = Reading.manuf
    AND Sensor.units = "mg/dL"
    AND Reading.value > 200
    AND Wears.p_start <= DATE(Reading.date_time)
    AND Wears.p_end >= DATE(Reading.date_time)
    AND TIMESTAMPDIFF(day, current_timestamp , Reading.date_time) <= 90
    GROUP BY Patient.name
    HAVING COUNT(Reading.value) >= ALL(SELECT COUNT(Reading.value)
                                       FROM Patient, Wears, Reading, Sensor
                                       WHERE Patient.p_number = Wears.patient
                                            AND Wears.snum = Reading.snum
                                            AND Wears.manuf = Reading.manuf
                                            AND Sensor.snum = Reading.snum
                                            AND Sensor.manuf = Reading.manuf
                                            AND Sensor.units = "mg/dL"
                                            AND Reading.value > 200
                                            AND Wears.p_start <= DATE(Reading.date_time)
                                            AND Wears.p_end >= DATE(Reading.date_time)
                                            AND TIMESTAMPDIFF(day, current_timestamp , Reading.date_time) <= 90
                                            GROUP BY Patient.name);


-- 4. query to retrieve the name(s) of the patient(s) who have been subject to
--    studies with all devices of manufacturer “Medtronic” in the past calendar year
SELECT distinct name FROM Patient as p
WHERE NOT EXISTS(SELECT  serialnum
                 FROM    Device
                 WHERE   manufacturer = "Medtronic"
                 AND serialnum NOT IN (SELECT Study.serial_number FROM Patient as p2, Study, Request
                                       WHERE Request.r_number = Study.request_number
                                            AND p2.p_number = Request.patient_id
                                            AND Request.patient_id = p.p_number
                                            AND p2.p_number = p.p_number
                                            AND YEAR(Study.s_date) = YEAR(current_date) - 1));



-- 5. Triggers
-- i) ensure that a doctor who prescribes an exam may not perform that same exam

insert into Request values(15, 023, 201, '2017-11-13');
insert into Study values(15, 'teste', '2017-11-14', 201, 'S89RE4', 'Medtronic');

update Study set doctor_id = 202 where request_number = 10 and description = 'echography left knee';


drop trigger if exists check_doctor_insert;

drop trigger if exists check_doctor_update;

delimiter $$

CREATE  TRIGGER check_doctor_insert BEFORE INSERT ON Study
for each row
BEGIN
    IF EXISTS (SELECT  Request.doctor_id
                FROM    Request
                WHERE   Request.r_number = new.request_number
                        AND new.doctor_id = Request.doctor_id) THEN
        call invalid_doctor_assignment();
    END IF;
END$$

CREATE  TRIGGER check_doctor_update BEFORE UPDATE ON Study
for each row
BEGIN
    IF EXISTS (SELECT  Request.doctor_id
                FROM    Request
                WHERE   Request.r_number = old.request_number
                        AND new.doctor_id = Request.doctor_id) THEN
        call invalid_doctor_assignment();
    END IF;
END$$

delimiter ;

-- ii) prevent someone from trying to associate a device to a patient in overlapping
--     periods. Fire an error message with text “Overlapping Periods” when this event occurs

insert into Period values('2017-06-01', '2017-06-12');

insert into Wears values('2017-06-01', '2017-06-12', 055, 'A23OE5', 'Proteus'); --Glenn

UPDATE Wears set p_start = '2017-09-14' WHERE p_start = '2017-09-16' and p_end='2017-10-02' and patient = 012;


drop trigger if exists overlapping_periods_insert;

drop trigger if exists overlapping_periods_update;

delimiter $$

CREATE  TRIGGER overlapping_periods_insert BEFORE INSERT ON Wears
for each row
BEGIN
    IF EXISTS (SELECT  snum, manuf, p_start, p_end
                FROM    Wears
                WHERE   new.snum = snum
                        AND new.manuf = manuf
                        AND NOT (new.p_end <= p_start
                                OR new.p_start >= p_end)) THEN
            signal sqlstate '45000' set message_text = 'Overlapping periods';
    END IF;
END$$

CREATE  TRIGGER overlapping_periods_update BEFORE UPDATE ON Wears
for each row
BEGIN
    IF  old.snum = new.snum
        AND old.manuf = new.manuf
        AND NOT (new.p_end <= old.p_start
                OR new.p_start >= old.p_end) THEN
                signal sqlstate '45000' set message_text='Overlapping periods';
    END IF;
END$$

delimiter ;


-- 6.  function: region_overlaps_element(), that, given the (series_id, index) of an
--     Element A, and the coordinates (x1, y1, x2, y2) of a Region B, returns true if
--     any region of the element A overlaps with Region B, and false otherwise

select region_overlaps_element(01, 01, 0.5, 0.5, 0.6, 0.6);

drop function if exists region_overlaps_element;

delimiter $$

CREATE FUNCTION region_overlaps_element(s_id integer, s_index integer, x1_B numeric(20,2),
                                    y1_B numeric(20,2), x2_B numeric(20,2), y2_B numeric(20,2))
RETURNS integer
BEGIN
    IF EXISTS (SELECT   x1, y1, x2, y2
                FROM    Region
                WHERE   series_id = s_id
                        AND elem_index = s_index
                        AND (x2_B <= x1
                            OR x1_B >= x2
                            OR y2_B <= y1
                            OR y1_B >= y2)) THEN
        RETURN 0;
    ELSE
        RETURN 1;
    END IF;
END$$

delimiter ;
