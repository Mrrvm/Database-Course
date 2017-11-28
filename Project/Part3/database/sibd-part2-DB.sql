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
    foreign key(p_start, p_end) references Period(p_start, p_end) ON UPDATE cascade,
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

insert into Patient values(001, 'Adams', '1978-03-30', 'Sunset Av.');       --Doctor
insert into Patient values(023, 'Brooks', '1997-04-25', 'Sesame Street');
insert into Patient values(147, 'Curry', '1996-06-16', 'Areeiro Street');
insert into Patient values(055, 'Glenn', '1995-10-07', 'Madison Av.');
insert into Patient values(012, 'Green', '1943-02-13', 'Baker Street');     --Doctor
insert into Patient values(108, 'Jackson', '1969-12-02', 'Fifth Av.');      --Doctor
insert into Patient values(097, 'Hayes', '1968-11-21', 'First Street');
insert into Patient values(015, 'Johnson', '2016-03-24', 'Second Street');
insert into Patient values(130, 'Jones', '2005-09-12', 'Madison Av.');
insert into Patient values(086, 'Lindsay', '1981-05-17', 'Second Street');  --Doctor
insert into Patient values(159, 'Smith', '1956-01-05', 'Fifth Av.');
insert into Patient values(123, 'Turner', '1974-07-26', 'Madison Av.');     --Doctor


/* All people are patients. Some of the patients are doctors */
insert into Doctor values(001, 201);
insert into Doctor values(108, 202);
insert into Doctor values(012, 203);
insert into Doctor values(086, 204);
insert into Doctor values(123, 205);

/* devices that are sensors/wearables */
insert into Device values('A23OE5', 'Proteus', 'M3'); --cholesterol sensor
insert into Device values('A10U7F', 'Proteus', 'M3'); --cholesterol sensor
insert into Device values('A47B8M', 'Proteus', 'M3'); --cholesterol sensor
insert into Device values('B5TR46', 'Samsung', 'M6'); --thermometer
insert into Device values('CF2YH9', 'HP', 'HP7');     --voltmeter
/* devices to perform studies */
insert into Device values('S57BT2', 'Medtronic', 'M4'); --X-ray machine
insert into Device values('S76BT3', 'Medtronic', 'M4'); --X-ray machine
insert into Device values('S89RE4', 'Medtronic', 'M5'); --ECG machine
insert into Device values('S35G7U', 'Medtronic', 'M5'); --ECG machine
insert into Device values('S64OI1', 'Medtronic', 'M2'); --echography machine


insert into Sensor values('A23OE5', 'Proteus', 'mg/dL');
insert into Sensor values('A10U7F', 'Proteus', 'mg/dL');
insert into Sensor values('A47B8M', 'Proteus', 'mg/dL');
insert into Sensor values('B5TR46', 'Samsung', 'ºC');
insert into Sensor values('CF2YH9', 'HP', 'mV');


insert into Reading values('A23OE5', 'Proteus', '2017-06-15 14:35:06', 235); --Smith
insert into Reading values('A23OE5', 'Proteus', '2017-08-23 14:35:06', 235); --Smith
insert into Reading values('A23OE5', 'Proteus', '2017-08-30 14:34:30', 220); --Smith
insert into Reading values('A23OE5', 'Proteus', '2017-09-07 14:36:00', 205); --Smith
insert into Reading values('A23OE5', 'Proteus', '2017-09-14 14:27:53', 180); --Smith
insert into Reading values('A23OE5', 'Proteus', '2017-09-21 14:30:26', 190); --Green
insert into Reading values('A23OE5', 'Proteus', '2017-09-30 14:32:15', 200); --Green
insert into Reading values('A23OE5', 'Proteus', '2017-10-01 14:33:52', 190); --Green

insert into Reading values('A10U7F', 'Proteus', '2017-09-02 15:24:14', 185); --Hayes
insert into Reading values('A10U7F', 'Proteus', '2017-09-15 13:15:36', 190); --Hayes
insert into Reading values('A10U7F', 'Proteus', '2017-09-21 16:35:54', 200); --Hayes
insert into Reading values('A10U7F', 'Proteus', '2017-09-30 15:24:14', 185); --Hayes
insert into Reading values('A10U7F', 'Proteus', '2017-10-02 12:30:25', 210); --Jackson
insert into Reading values('A10U7F', 'Proteus', '2017-10-14 14:53:05', 195); --Jackson

insert into Reading values('A47B8M', 'Proteus', '2017-09-13 09:25:34', 195); --Glenn
insert into Reading values('A47B8M', 'Proteus', '2017-09-20 10:30:45', 200); --Glenn
insert into Reading values('A47B8M', 'Proteus', '2017-09-27 11:14:51', 205); --Glenn
insert into Reading values('A47B8M', 'Proteus', '2017-10-05 10:45:02', 205); --Glenn
insert into Reading values('A47B8M', 'Proteus', '2017-10-15 11:20:10', 210); --Glenn
insert into Reading values('A47B8M', 'Proteus', '2017-10-20 10:53:40', 205); --Glenn

insert into Reading values('B5TR46', 'Samsung', '2017-10-07 16:37:24', 38);   --Johnson
insert into Reading values('B5TR46', 'Samsung', '2017-10-08 16:40:00', 38.5); --Johnson
insert into Reading values('B5TR46', 'Samsung', '2017-10-09 16:35:16', 38.5); --Johnson
insert into Reading values('B5TR46', 'Samsung', '2017-10-10 16:30:10', 38);   --Johnson
insert into Reading values('B5TR46', 'Samsung', '2017-10-11 16:37:45', 37);   --Johnson
insert into Reading values('B5TR46', 'Samsung', '2017-10-12 16:35:02', 36.5); --Johnson

insert into Reading values('CF2YH9', 'HP', '2017-10-28 17:23:05', 35); --Curry
insert into Reading values('CF2YH9', 'HP', '2017-10-30 17:20:23', 30); --Curry
insert into Reading values('CF2YH9', 'HP', '2017-11-01 17:25:42', 32); --Curry
insert into Reading values('CF2YH9', 'HP', '2017-11-03 17:24:36', 37); --Curry


insert into Period values('2017-06-10', '2017-09-15');
insert into Period values('2017-09-16', '2017-10-02');
insert into Period values('2017-09-02', '2017-09-30');
insert into Period values('2017-10-01', '2017-10-15');
insert into Period values('2017-09-12', '2017-10-21');
insert into Period values('2017-10-07', '2017-10-12');
insert into Period values('2017-10-27', '2017-11-04');
insert into Period values('2017-10-30', '2500-01-01');
insert into Period values('2017-11-04', '2017-12-24');
insert into Period values('2017-11-16', '2018-01-06');



insert into Wears values('2017-06-10', '2017-09-15', 159, 'A23OE5', 'Proteus'); --Smith
insert into Wears values('2017-09-16', '2017-10-02', 012, 'A23OE5', 'Proteus'); --Green
insert into Wears values('2017-09-02', '2017-09-30', 097, 'A10U7F', 'Proteus'); --Hayes
insert into Wears values('2017-10-01', '2017-10-15', 108, 'A10U7F', 'Proteus'); --Jackson
insert into Wears values('2017-09-12', '2017-10-21', 055, 'A47B8M', 'Proteus'); --Glenn
insert into Wears values('2017-10-07', '2017-10-12', 015, 'B5TR46', 'Samsung'); --Johnson
insert into Wears values('2017-10-27', '2017-11-04', 147, 'CF2YH9', 'HP');      --Curry
insert into Wears values('2017-10-30', '2500-01-01', 159, 'A10U7F', 'Proteus'); --Smith
insert into Wears values('2017-10-30', '2500-01-01', 147, 'CF2YH9', 'HP');      --Curry
insert into Wears values('2017-11-04', '2017-12-24', 012, 'B5TR46', 'Samsung'); --Green
insert into Wears values('2017-11-16', '2018-01-06', 097, 'A47B8M', 'Proteus'); --Hayes



insert into Request values(01, 159, 201, '2016-08-18'); --Smith
insert into Request values(02, 012, 202, '2016-09-10'); --Green
insert into Request values(03, 097, 203, '2016-08-28'); --Hayes
insert into Request values(04, 108, 204, '2016-09-25'); --Jackson
insert into Request values(05, 023, 201, '2016-09-09'); --Brooks
insert into Request values(06, 015, 205, '2016-10-07'); --Johnson
insert into Request values(07, 159, 203, '2016-10-27'); --Smith
insert into Request values(08, 159, 204, '2016-09-15'); --Smith
insert into Request values(09, 159, 201, '2016-10-16'); --Smith
insert into Request values(10, 159, 202, '2016-11-04'); --Smith
insert into Request values(11, 108, 203, '2017-03-24'); --Jackson
insert into Request values(12, 108, 203, '2017-05-12'); --Jackson
insert into Request values(13, 108, 203, '2017-06-04'); --Jackson
insert into Request values(14, 108, 203, '2017-09-15'); --Jackson



insert into Study values(01, 'X-ray left knee', '2016-08-23', 202, 'S57BT2', 'Medtronic');      --Smith
insert into Study values(02, 'X-ray both hands', '2016-09-16', 203, 'S76BT3', 'Medtronic');     --Green
insert into Study values(03, 'ECG', '2016-09-02', 204, 'S89RE4', 'Medtronic');                  --Hayes
insert into Study values(04, 'ECG', '2016-10-01', 205, 'S35G7U', 'Medtronic');                  --Jackson
insert into Study values(05, 'pregnancy echography', '2016-09-12', 202, 'S64OI1', 'Medtronic'); --Brooks
insert into Study values(06, 'X-ray right arm', '2016-10-07', 201, 'S57BT2', 'Medtronic');      --Johnson
insert into Study values(07, 'X-ray left knee', '2016-10-27', 204, 'S76BT3', 'Medtronic');      --Smith
insert into Study values(08, 'ECG', '2016-09-15', 205, 'S89RE4', 'Medtronic');                  --Smith
insert into Study values(09, 'ECG', '2016-10-16', 202, 'S35G7U', 'Medtronic');                  --Smith
insert into Study values(10, 'echography left knee', '2016-11-07', 203, 'S64OI1', 'Medtronic'); --Smith
insert into Study values(11, 'X-ray right hand', '2017-04-02', 202, 'S57BT2', 'Medtronic');     --Jackson
insert into Study values(12, 'X-ray both knees', '2017-05-20', 204, 'S76BT3',  'Medtronic');    --Jackson
insert into Study values(13, 'echography right knee', '2017-06-12', 201, 'S64OI1', 'Medtronic');--Jackson
insert into Study values(14, 'ECG', '2017-09-20', 205, 'S89RE4', 'Medtronic');                  --Jackson


insert into Series values(01, 'S0101', 'series01.01', 01, 'X-ray left knee');
insert into Series values(02, 'S0202', 'series02.02', 02, 'X-ray both hands');
insert into Series values(03, 'S0303', 'series03.03', 03, 'ECG');
insert into Series values(04, 'S0404', 'series04.04', 04, 'ECG');
insert into Series values(05, 'S0505', 'series05.05', 05, 'pregnancy echography');
insert into Series values(06, 'S0606', 'series06.06', 06, 'X-ray right arm');
insert into Series values(07, 'S0707', 'series07.07', 07, 'X-ray left knee');
insert into Series values(08, 'S0808', 'series08.08', 08, 'ECG');
insert into Series values(09, 'S0909', 'series09.09', 09, 'ECG');
insert into Series values(10, 'S1010', 'series10.10', 10, 'echography left knee');
insert into Series values(11, 'S57BT2', 'series11.11', 11, 'X-ray right hand');
insert into Series values(12, 'S76BT3', 'series12.12', 12, 'X-ray both knees');
insert into Series values(13, 'S64OI1', 'series13.13', 13, 'echography right knee');
insert into Series values(14, 'S89RE4', 'series14.14', 14, 'ECG');


insert into Element values(01, 01);
insert into Element values(02, 01);
insert into Element values(02, 02);
insert into Element values(03, 01);
insert into Element values(03, 02);
insert into Element values(03, 03);
insert into Element values(03, 04);
insert into Element values(04, 01);
insert into Element values(04, 02);
insert into Element values(04, 03);
insert into Element values(05, 01);
insert into Element values(05, 02);
insert into Element values(06, 01);
insert into Element values(07, 01);
insert into Element values(08, 01);
insert into Element values(08, 02);
insert into Element values(09, 01);
insert into Element values(09, 02);
insert into Element values(09, 03);
insert into Element values(10, 01);
insert into Element values(11, 01);
insert into Element values(12, 01);
insert into Element values(12, 02);
insert into Element values(13, 01);
insert into Element values(14, 01);


insert into Region values(01, 01, 0.7, 0.3, 0.75, 0.35);
insert into Region values(05, 01, 0.5, 0.4, 0.6, 0.6);
insert into Region values(05, 02, 0.6, 0.3, 0.8, 0.45);
insert into Region values(06, 01, 0.3, 0.4, 0.35, 0.5);
insert into Region values(07, 01, 07.7, 0.3, 0.75, 0.35);
insert into Region values(10, 01, 0.2, 0.5, 0.35, 0.6);
insert into Region values(12, 01, 0.3, 0.5, 0.35, 0.55);
insert into Region values(13, 01, 0.5, 0.8, 0.6, 0.85);
