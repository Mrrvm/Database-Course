/*3******************************************************************************/
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
            AND timestampdiff(day, current_timestamp , Reading.date_time) <= 90
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
                                                    AND timestampdiff(day, current_timestamp , Reading.date_time) < 90
                                        GROUP BY    Patient.name);



/*4******************************************************************************/
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
                                                AND datediff(Study.s_date, current_date) < 365));

/*This also may work if count getss distincts..*/

SELECT distinct name
FROM Patient, Request, Study, Device
WHERE Patient.p_number = Request.patient_id
AND Request.r_number = Study.request_number
AND Study.serial_number = Device.serialnum
AND Study.manufacturer = Device.manufacturer
AND datediff(Study.s_date, current_date) < 365
AND Study.manufacturer = "Medtronic"
GROUP BY name
having count(distinct Device.serialnum) >= ALL 
                                (SELECT count(serialnum)
                                FROM Device
                                WHERE manufacturer = "Medtronic"
                                );

/*5. I)******************************************************************************/

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

/* Or with a function */

drop trigger if exists check_doctor_insert;

drop trigger if exists check_doctor_update;

drop function if exists is_diff_doctor;

delimiter $$
CREATE FUNCTION is_diff_doctor(study_r_number int)
	RETURNS int
	BEGIN
		declare ret_id int;
		SELECT doctor_id into ret_id
		FROM Request 
		WHERE Request.r_number = study_r_number;
		RETURN ret_id;
	END$$
delimiter;


delimiter $$
CREATE 	TRIGGER check_doctor_insert BEFORE INSERT 
	ON Study
	FOR EACH ROW BEGIN
		IF is_diff_doctor(NEW.request_number) = NEW.doctor_id THEN
			CALL raise_error();
		END IF;
    END$$
delimiter;

delimiter $$
CREATE  TRIGGER check_doctor_update BEFORE UPDATE
    ON Study
    FOR EACH ROW BEGIN
        IF is_diff_doctor(OLD.request_number) = NEW.doctor_id THEN
            CALL raise_error();
        END IF;
    END$$
delimiter;


/*5. II)******************************************************************************/

DROP TRIGGER if exists prevent_overlap_insert;
DROP TRIGGER if exists prevent_overlap_update;
DROP FUNCTION if exists is_dates_ok;

delimiter $$
CREATE FUNCTION is_dates_ok(new_start date, new_end date, device_snum varchar(255), device_manuf varchar(255))
    RETURNS int
    BEGIN
        DECLARE done int default 0;
        DECLARE snum, manuf, patient varchar(255);
        DECLARE p_start, p_end date;
        DECLARE my_cursor cursor for select * from Wears;
        DECLARE continue handler for not found set done = 1;
        OPEN my_cursor;
        my_loop: loop
            FETCH my_cursor INTO p_start, p_end, patient, snum, manuf;
            IF done THEN LEAVE my_loop; END IF;
            IF snum = device_snum THEN
                IF manuf = device_manuf THEN
                    IF p_end >= new_start THEN
                        RETURN 0;
                    END IF;
                    IF p_start <= new_end THEN
                        RETURN 0;
                    END IF;
                END IF;
            END IF;
        END loop;
        RETURN 1;
        CLOSE my_cursor;
    END$$
delimiter ;

delimiter $$
CREATE TRIGGER prevent_overlap_insert BEFORE INSERT 
    ON Wears
    FOR EACH ROW 
    BEGIN
        IF (is_dates_ok(NEW.p_start, NEW.p_end, NEW.snum, NEW.manuf) = 0) THEN
            signal sqlstate '45000' set message_text = 'Overlapping periods';
        END IF;
    END$$
delimiter ;

delimiter $$
CREATE TRIGGER prevent_overlap_update BEFORE UPDATE
    ON Wears
    FOR EACH ROW 
    BEGIN
        IF (is_dates_ok(NEW.p_start, NEW.p_end, OLD.snum, OLD.manuf) = 0) THEN
            signal sqlstate '45000' set message_text = 'Overlapping periods';
        END IF;
    END$$
delimiter ;


/*6******************************************************************************/
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
