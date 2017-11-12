-- 3. query to retrieve the name(s) of the patient(s) with the highest number of readings
--    of units of “LDL cholesterol in mg/dL" above 200 in the past 90 days
SELECT      Patient.name
FROM        Patient, Wears, Reading, Sensor
WHERE       Patient.p_number = Wears.patient
            AND Wears.snum = Reading.snum
            AND Wears.manuf = Reading.manuf
            AND Sensor.snum = Reading.snum
            AND Sensor.manuf = Reading.manuf
            AND Sensor.units = "mg/dL"
            AND Reading.value > 200
            AND Wears.p_start <= DATE(Reading.date_time)
            AND Wears.p_end >= DATE(Reading.date_time)
            AND ABS(DATEDIFF(DATE(current_timestamp),DATE(Reading.date_time))) <= 90
GROUP BY    Patient.name
HAVING      COUNT(Reading.value) >= ALL(SELECT      COUNT(Reading.value)
                                        FROM        Patient, Wears, Reading, Sensor
                                        WHERE       Patient.p_number = Wears.patient
                                                    AND Wears.snum = Reading.snum
                                                    AND Wears.manuf = Reading.manuf
                                                    AND Sensor.snum = Reading.snum
                                                    AND Sensor.manuf = Reading.manuf
                                                    AND Sensor.units = "mg/dL"
                                                    AND Reading.value > 200
                                                    AND Wears.p_start <= DATE(Reading.date_time)
                                                    AND Wears.p_end >= DATE(Reading.date_time)
                                                    AND ABS(DATEDIFF(DATE(current_timestamp),DATE(Reading.date_time))) <= 90
                                        GROUP BY    Patient.name);


-- 4. query to retrieve the name(s) of the patient(s) who have been subject to
--    studies with all devices of manufacturer “Medtronic” in the past calendar year
SELECT  distinct name
FROM    Patient as p
WHERE   not exists(
            SELECT  serialnum
            FROM    Device
            WHERE   manufacturer = "Medtronic"
                    AND serialnum not in(SELECT  Study.serial_number
                                        FROM    Patient as p2, Study, Request
                                        WHERE   Request.r_number = Study.request_number
                                                AND p2.p_number = Request.patient_id
                                                AND Request.patient_id = p.p_number
                                                AND p2.p_number = p.p_number
                                                AND ABS(DATEDIFF(DATE(current_timestamp),DATE(Study.s_date))) <= 365));


-- 5. Triggers
-- i) ensure that a doctor who prescribes an exam may not perform that same exam

drop trigger if exists check_doctor_insert;

drop trigger if exists check_doctor_update;

delimiter $$

CREATE  TRIGGER check_doctor_insert BEFORE INSERT ON Study
for each row
BEGIN
    SELECT  Request.doctor_id
    INTO    @doctor_id
    FROM    Request
    WHERE   Request.r_number = new.request_number;
    IF  new.doctor_id = @doctor_id THEN
        signal sqlstate '45000' set message_text='The doctor performing the exam
                                                cannot be the one who prescribed it';
    END IF;
END$$

CREATE  TRIGGER check_doctor_update BEFORE UPDATE ON Study
for each row
BEGIN
    SELECT  Request.doctor_id
    INTO    @doctor_id
    FROM    Request
    WHERE   Request.r_number = old.request_number;
    IF  new.doctor_id = @doctor_id THEN
        signal sqlstate '45000' set message_text='The doctor performing the exam
                                                cannot be the one who prescribed it';
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
    SELECT  snum
    INTO    @serial_number
    FROM    Wears;
    SELECT  manuf
    INTO    @manufacturer
    FROM    Wears;
    SELECT  p_start
    INTO    @start_date
    FROM    Wears;
    SELECT  p_end
    INTO    @end_date
    FROM    Wears;
    IF      new.snum = @serial_number
            AND new.manuf = @manufacturer
            AND NOT ( new.p_end <= @start_date
                    OR new.p_start >= @end_date) THEN
                    signal sqlstate '45000' set message_text='Overlapping periods';
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
RETURNS varchar(255)
BEGIN
    DECLARE x1_A    numeric(20,2);
    DECLARE y1_A    numeric(20,2);
    DECLARE x2_A    numeric(20,2);
    DECLARE y2_A    numeric(20,2);

    SELECT  x1 into x1_A
    FROM    Region
    WHERE   series_id = s_id
            AND elem_index = s_index;

    SELECT  y1 into y1_A
    FROM    Region
    WHERE   series_id = s_id
            AND elem_index = s_index;

    SELECT  x2 into x2_A
    FROM    Region
    WHERE   series_id = s_id
            AND elem_index = s_index;

    SELECT  y2 into y2_A
    FROM    Region
    WHERE   series_id = s_id
            AND elem_index = s_index;

    IF  x2_B <= x1_A
        OR x1_B >= x2_A
        OR y2_B <= y1_A
        OR y1_B >= y2_A THEN

        RETURN  'FALSE';
    ELSE
        RETURN 'TRUE';
    END IF;
END$$

delimiter ;
