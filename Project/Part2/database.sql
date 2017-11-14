/* Project PART 2 */

/* clear all existent tables */
drop table if exists Region;
drop table if exists Element;
drop table if exists Series;
drop table if exists Study;
drop table if exists Request;
drop table if exists Wears;
drop table if exists Period;
drop table if exists Reading;
drop table if exists Sensor;
drop table if exists Device;
drop table if exists Doctor;
drop table if exists Patient;



/* create new tables */
CREATE TABLE Patient(
    p_number    integer,
    name        varchar(255),
    birthday    date,
    address     varchar(255),
    primary key(p_number)
);

CREATE TABLE Doctor(
    p_number    integer,
    doctor_id   integer,
    primary key(doctor_id),
    foreign key(p_number) references Patient(p_number)
);

CREATE TABLE Device(
    serialnum       varchar(255),
    manufacturer    varchar(255),
    model           varchar(255),
    primary key(serialnum, manufacturer)
);

CREATE TABLE Sensor(
    snum        varchar(255),
    manuf       varchar(255),
    units       varchar(255),
    primary key(snum, manuf),
    foreign key(snum, manuf) references Device(serialnum, manufacturer)
);

CREATE TABLE Reading(
    snum        varchar(255),
    manuf       varchar(255),
    date_time   datetime,
    value       numeric(20,2),
    primary key(snum, manuf, date_time),
    foreign key(snum, manuf) references Sensor(snum, manuf)
);

CREATE TABLE Period(
    p_start   date,
    p_end     date,
    primary key(p_start, p_end)
);

CREATE TABLE Wears(
    p_start   date,
    p_end     date,
    patient   integer,
    snum      varchar(255),
    manuf     varchar(255),
    primary key(p_start, p_end, patient),
    foreign key(p_start, p_end) references Period(p_start, p_end),
    foreign key(patient) references Patient(p_number),
    foreign key(snum, manuf) references Device(serialnum, manufacturer)
);

CREATE TABLE Request(
    r_number      integer,
    patient_id    integer,
    doctor_id     integer,
    r_date        date,
    primary key(r_number),
    foreign key(patient_id) references Patient(p_number),
    foreign key(doctor_id) references Doctor(doctor_id)
);

CREATE TABLE Study(
    request_number  integer,
    description     varchar(255),
    s_date          date,
    doctor_id       integer,
    serial_number   varchar(255),
    manufacturer    varchar(255),
    primary key(request_number, description),
    foreign key(request_number) references Request(r_number),
    foreign key(doctor_id) references Doctor(doctor_id),
    foreign key(serial_number, manufacturer) references Device(serialnum, manufacturer)
);

CREATE TABLE Series(
    series_id       integer,
    name            varchar(255),
    base_url        varchar(255),
    request_number  integer,
    description     varchar(255),
    primary key(series_id),
    foreign key(request_number, description) references Study(request_number, description)
);

CREATE TABLE Element(
    series_id   integer,
    elem_index  integer,
    primary key(series_id, elem_index),
    foreign key(series_id) references Series(series_id)
);

CREATE TABLE Region(
    series_id   integer,
    elem_index  integer,
    x1          numeric(20,2),
    y1          numeric(20,2),
    x2          numeric(20,2),
    y2          numeric(20,2),
    primary key(series_id, elem_index, x1, y1, x2, y2),
    foreign key(series_id, elem_index) references Element(series_id, elem_index)
);


/* populate tables */

INSERT INTO Patient VALUES(001, 'Adams', '1978-03-30', 'Sunset Av.');       --Doctor
INSERT INTO Patient VALUES(023, 'Brooks', '1997-04-25', 'Sesame Street');
INSERT INTO Patient VALUES(147, 'Curry', '1996-06-16', 'Areeiro Street');
INSERT INTO Patient VALUES(055, 'Glenn', '1995-10-07', 'Madison Av.');
INSERT INTO Patient VALUES(012, 'Green', '1943-02-13', 'Baker Street');     --Doctor
INSERT INTO Patient VALUES(108, 'Jackson', '1969-12-02', 'Fifth Av.');      --Doctor
INSERT INTO Patient VALUES(097, 'Hayes', '1968-11-21', 'First Street');
INSERT INTO Patient VALUES(015, 'Johnson', '2016-03-24', 'Second Street');
INSERT INTO Patient VALUES(130, 'Jones', '2005-09-12', 'Madison Av.');
INSERT INTO Patient VALUES(086, 'Lindsay', '1981-05-17', 'Second Street');  --Doctor
INSERT INTO Patient VALUES(159, 'Smith', '1956-01-05', 'Fifth Av.');
INSERT INTO Patient VALUES(123, 'Turner', '1974-07-26', 'Madison Av.');     --Doctor


/* All people are patients. Some of the patients are doctors */
INSERT INTO Doctor VALUES(001, 201);
INSERT INTO Doctor VALUES(108, 202);
INSERT INTO Doctor VALUES(012, 203);
INSERT INTO Doctor VALUES(086, 204);
INSERT INTO Doctor VALUES(123, 205);

/* devices that are sensors/wearables */
INSERT INTO Device VALUES('A23OE5', 'Proteus', 'M3'); --cholesterol sensor
INSERT INTO Device VALUES('A10U7F', 'Proteus', 'M3'); --cholesterol sensor
INSERT INTO Device VALUES('A47B8M', 'Proteus', 'M3'); --cholesterol sensor
INSERT INTO Device VALUES('B5TR46', 'Samsung', 'M6'); --thermometer
INSERT INTO Device VALUES('CF2YH9', 'HP', 'HP7');     --voltmeter
/* devices to perform studies */
INSERT INTO Device VALUES('S57BT2', 'Medtronic', 'M4'); --X-ray machine
INSERT INTO Device VALUES('S76BT3', 'Medtronic', 'M4'); --X-ray machine
INSERT INTO Device VALUES('S89RE4', 'Medtronic', 'M5'); --ECG machine
INSERT INTO Device VALUES('S35G7U', 'Medtronic', 'M5'); --ECG machine
INSERT INTO Device VALUES('S64OI1', 'Medtronic', 'M2'); --echography machine


INSERT INTO Sensor VALUES('A23OE5', 'Proteus', 'mg/dL');
INSERT INTO Sensor VALUES('A10U7F', 'Proteus', 'mg/dL');
INSERT INTO Sensor VALUES('A47B8M', 'Proteus', 'mg/dL');
INSERT INTO Sensor VALUES('B5TR46', 'Samsung', 'ºC');
INSERT INTO Sensor VALUES('CF2YH9', 'HP', 'mV');

INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-06-15 14:35:06', 235); --Smith
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-08-23 14:35:06', 235); --Smith
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-08-30 14:34:30', 220); --Smith
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-09-07 14:36:00', 205); --Smith
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-09-14 14:27:53', 180); --Smith
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-09-21 14:30:26', 190); --Green
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-09-30 14:32:15', 200); --Green
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-10-01 14:33:52', 190); --Green
INSERT INTO Reading VALUES('A23OE5', 'Proteus', '2017-09-17 14:35:26', 214); --Green

INSERT INTO Reading VALUES('A10U7F', 'Proteus', '2017-09-02 15:24:14', 185); --Hayes
INSERT INTO Reading VALUES('A10U7F', 'Proteus', '2017-09-15 13:15:36', 190); --Hayes
INSERT INTO Reading VALUES('A10U7F', 'Proteus', '2017-09-21 16:35:54', 200); --Hayes
INSERT INTO Reading VALUES('A10U7F', 'Proteus', '2017-09-30 15:24:14', 185); --Hayes
INSERT INTO Reading VALUES('A10U7F', 'Proteus', '2017-10-02 12:30:25', 210); --Jackson
INSERT INTO Reading VALUES('A10U7F', 'Proteus', '2017-10-14 14:53:05', 195); --Jackson

INSERT INTO Reading VALUES('A47B8M', 'Proteus', '2017-09-13 09:25:34', 195); --Glenn
INSERT INTO Reading VALUES('A47B8M', 'Proteus', '2017-09-20 10:30:45', 200); --Glenn
INSERT INTO Reading VALUES('A47B8M', 'Proteus', '2017-09-27 11:14:51', 205); --Glenn
INSERT INTO Reading VALUES('A47B8M', 'Proteus', '2017-10-05 10:45:02', 205); --Glenn
INSERT INTO Reading VALUES('A47B8M', 'Proteus', '2017-10-15 11:20:10', 210); --Glenn
INSERT INTO Reading VALUES('A47B8M', 'Proteus', '2017-10-20 10:53:40', 205); --Glenn

INSERT INTO Reading VALUES('B5TR46', 'Samsung', '2017-10-07 16:37:24', 38);   --Johnson
INSERT INTO Reading VALUES('B5TR46', 'Samsung', '2017-10-08 16:40:00', 38.5); --Johnson
INSERT INTO Reading VALUES('B5TR46', 'Samsung', '2017-10-09 16:35:16', 38.5); --Johnson
INSERT INTO Reading VALUES('B5TR46', 'Samsung', '2017-10-10 16:30:10', 38);   --Johnson
INSERT INTO Reading VALUES('B5TR46', 'Samsung', '2017-10-11 16:37:45', 37);   --Johnson
INSERT INTO Reading VALUES('B5TR46', 'Samsung', '2017-10-12 16:35:02', 36.5); --Johnson

INSERT INTO Reading VALUES('CF2YH9', 'HP', '2017-10-28 17:23:05', 35); --Curry
INSERT INTO Reading VALUES('CF2YH9', 'HP', '2017-10-30 17:20:23', 30); --Curry
INSERT INTO Reading VALUES('CF2YH9', 'HP', '2017-11-01 17:25:42', 32); --Curry
INSERT INTO Reading VALUES('CF2YH9', 'HP', '2017-11-03 17:24:36', 37); --Curry


INSERT INTO Period VALUES('2017-06-10', '2017-09-15');
INSERT INTO Period VALUES('2017-09-16', '2017-10-02');
INSERT INTO Period VALUES('2017-09-02', '2017-09-30');
INSERT INTO Period VALUES('2017-10-01', '2017-10-15');
INSERT INTO Period VALUES('2017-09-12', '2017-10-21');
INSERT INTO Period VALUES('2017-10-07', '2017-10-12');
INSERT INTO Period VALUES('2017-10-27', '2017-11-04');


INSERT INTO Wears VALUES('2017-06-10', '2017-09-15', 159, 'A23OE5', 'Proteus'); --Smith
INSERT INTO Wears VALUES('2017-09-16', '2017-10-02', 012, 'A23OE5', 'Proteus'); --Green
INSERT INTO Wears VALUES('2017-09-02', '2017-09-30', 097, 'A10U7F', 'Proteus'); --Hayes
INSERT INTO Wears VALUES('2017-10-01', '2017-10-15', 108, 'A10U7F', 'Proteus'); --Jackson
INSERT INTO Wears VALUES('2017-09-12', '2017-10-21', 055, 'A47B8M', 'Proteus'); --Glenn
INSERT INTO Wears VALUES('2017-10-07', '2017-10-12', 015, 'B5TR46', 'Samsung'); --Johnson
INSERT INTO Wears VALUES('2017-10-27', '2017-11-04', 147, 'CF2YH9', 'HP');      --Curry


INSERT INTO Request VALUES(01, 159, 201, '2016-08-18'); --Smith
INSERT INTO Request VALUES(02, 012, 202, '2016-09-10'); --Green
INSERT INTO Request VALUES(03, 097, 203, '2016-08-28'); --Hayes
INSERT INTO Request VALUES(04, 108, 204, '2016-09-25'); --Jackson
INSERT INTO Request VALUES(05, 023, 201, '2016-09-09'); --Brooks
INSERT INTO Request VALUES(06, 015, 205, '2016-10-07'); --Johnson
INSERT INTO Request VALUES(07, 159, 203, '2016-10-27'); --Smith
INSERT INTO Request VALUES(08, 159, 204, '2016-09-15'); --Smith
INSERT INTO Request VALUES(09, 159, 201, '2016-10-16'); --Smith
INSERT INTO Request VALUES(10, 159, 202, '2016-11-04'); --Smith
INSERT INTO Request VALUES(11, 108, 203, '2017-03-24'); --Jackson
INSERT INTO Request VALUES(12, 108, 203, '2017-05-12'); --Jackson
INSERT INTO Request VALUES(13, 108, 203, '2017-06-04'); --Jackson
INSERT INTO Request VALUES(14, 108, 203, '2017-09-15'); --Jackson
INSERT INTO Request VALUES(15, 108, 203, '2017-09-20'); --Jackson



INSERT INTO Study VALUES(01, 'X-ray left knee', '2016-08-23', 202, 'S57BT2', 'Medtronic');      --Smith
INSERT INTO Study VALUES(02, 'X-ray both hands', '2016-09-16', 203, 'S76BT3', 'Medtronic');     --Green
INSERT INTO Study VALUES(03, 'ECG', '2016-09-02', 204, 'S89RE4', 'Medtronic');                  --Hayes
INSERT INTO Study VALUES(04, 'ECG', '2016-10-01', 205, 'S35G7U', 'Medtronic');                  --Jackson
INSERT INTO Study VALUES(05, 'pregnancy echography', '2016-09-12', 202, 'S64OI1', 'Medtronic'); --Brooks
INSERT INTO Study VALUES(06, 'X-ray right arm', '2016-10-07', 201, 'S57BT2', 'Medtronic');      --Johnson
INSERT INTO Study VALUES(07, 'X-ray left knee', '2016-10-27', 204, 'S76BT3', 'Medtronic');      --Smith
INSERT INTO Study VALUES(08, 'ECG', '2016-09-15', 205, 'S89RE4', 'Medtronic');                  --Smith
INSERT INTO Study VALUES(09, 'ECG', '2016-10-16', 202, 'S35G7U', 'Medtronic');                  --Smith
INSERT INTO Study VALUES(10, 'echography left knee', '2016-11-07', 203, 'S64OI1', 'Medtronic'); --Smith
INSERT INTO Study VALUES(11, 'X-ray right hand', '2017-04-02', 202, 'S57BT2', 'Medtronic');     --Jackson
INSERT INTO Study VALUES(12, 'X-ray both knees', '2017-05-20', 204, 'S76BT3',  'Medtronic');    --Jackson
INSERT INTO Study VALUES(13, 'echography right knee', '2017-06-12', 201, 'S64OI1', 'Medtronic');--Jackson
INSERT INTO Study VALUES(14, 'ECG', '2017-09-20', 205, 'S89RE4', 'Medtronic');                  --Jackson
INSERT INTO Study VALUES(15, 'ECG', '2017-10-01', 205, 'S35G7U', 'Medtronic');                  --Jackson


INSERT INTO Series VALUES(01, 'S0101', 'series01.01', 01, 'X-ray left knee');
INSERT INTO Series VALUES(02, 'S0202', 'series02.02', 02, 'X-ray both hands');
INSERT INTO Series VALUES(03, 'S0303', 'series03.03', 03, 'ECG');
INSERT INTO Series VALUES(04, 'S0404', 'series04.04', 04, 'ECG');
INSERT INTO Series VALUES(05, 'S0505', 'series05.05', 05, 'pregnancy echography');
INSERT INTO Series VALUES(06, 'S0606', 'series06.06', 06, 'X-ray right arm');
INSERT INTO Series VALUES(07, 'S0707', 'series07.07', 07, 'X-ray left knee');
INSERT INTO Series VALUES(08, 'S0808', 'series08.08', 08, 'ECG');
INSERT INTO Series VALUES(09, 'S0909', 'series09.09', 09, 'ECG');
INSERT INTO Series VALUES(10, 'S1010', 'series10.10', 10, 'echography left knee');
INSERT INTO Series VALUES(11, 'S57BT2', 'series11.11', 11, 'X-ray right hand');
INSERT INTO Series VALUES(12, 'S76BT3', 'series12.12', 12, 'X-ray both knees');
INSERT INTO Series VALUES(13, 'S64OI1', 'series13.13', 13, 'echography right knee');
INSERT INTO Series VALUES(14, 'S89RE4', 'series14.14', 14, 'ECG');


INSERT INTO Element VALUES(01, 01);
INSERT INTO Element VALUES(02, 01);
INSERT INTO Element VALUES(02, 02);
INSERT INTO Element VALUES(03, 01);
INSERT INTO Element VALUES(03, 02);
INSERT INTO Element VALUES(03, 03);
INSERT INTO Element VALUES(03, 04);
INSERT INTO Element VALUES(04, 01);
INSERT INTO Element VALUES(04, 02);
INSERT INTO Element VALUES(04, 03);
INSERT INTO Element VALUES(05, 01);
INSERT INTO Element VALUES(05, 02);
INSERT INTO Element VALUES(06, 01);
INSERT INTO Element VALUES(07, 01);
INSERT INTO Element VALUES(08, 01);
INSERT INTO Element VALUES(08, 02);
INSERT INTO Element VALUES(09, 01);
INSERT INTO Element VALUES(09, 02);
INSERT INTO Element VALUES(09, 03);
INSERT INTO Element VALUES(10, 01);
INSERT INTO Element VALUES(11, 01);
INSERT INTO Element VALUES(12, 01);
INSERT INTO Element VALUES(12, 02);
INSERT INTO Element VALUES(13, 01);
INSERT INTO Element VALUES(14, 01);


INSERT INTO Region VALUES(01, 01, 0.7, 0.3, 0.75, 0.35);
INSERT INTO Region VALUES(05, 01, 0.5, 0.4, 0.6, 0.6);
INSERT INTO Region VALUES(05, 02, 0.6, 0.3, 0.8, 0.45);
INSERT INTO Region VALUES(06, 01, 0.3, 0.4, 0.35, 0.5);
INSERT INTO Region VALUES(07, 01, 07.7, 0.3, 0.75, 0.35);
INSERT INTO Region VALUES(10, 01, 0.2, 0.5, 0.35, 0.6);
INSERT INTO Region VALUES(12, 01, 0.3, 0.5, 0.35, 0.55);
INSERT INTO Region VALUES(13, 01, 0.5, 0.8, 0.6, 0.85);
