/*
DROP TABLE IF EXISTS Record_details, Outstanding_warrants, Criminal_summary, Person_summary;
DROP DATABASE IF EXISTS Serial_enforcing_interface_database;
*/
CREATE DATABASE IF NOT EXISTS serial_enforcing_interface_database;
USE serial_enforcing_interface_database;

CREATE TABLE IF NOT EXISTS person_summary (
    person_number int AUTO_INCREMENT NOT NULL,
    picture varchar(50) NOT NULL,
    first_name varchar(50) NOT NULL,
    last_name varchar(50) NOT NULL,
    middle_name varchar(50),
    date_of_birth date NOT NULL,
    state_of_residence varchar(50),
    CONSTRAINT PRIMARY KEY (person_number)
);

CREATE TABLE IF NOT EXISTS criminal_summary (
    person_number_criminal_summary int NOT NULL,
    charges int NOT NULL,
    convictions int NOT NULL,
    outstanding_warrants int NOT NULL,
    flight_risk varchar(3) NOT NULL,
    CONSTRAINT FK1 FOREIGN KEY (person_number_criminal_summary) REFERENCES person_summary (person_number)
);

CREATE TABLE IF NOT EXISTS outstanding_warrants (
    person_number_outstanding_warrants int NOT NULL,
    date_issues date NOT NULL,
    charge varchar(50) NOT NULL,
    country_state varchar(20) NOT NULL,
    CONSTRAINT FK2 FOREIGN KEY (person_number_outstanding_warrants) REFERENCES person_summary (person_number) 
);

CREATE TABLE IF NOT EXISTS record_details (
    person_number_record_details int NOT NULL,
    offense_date date NOT NULL,
    offense varchar(200) NOT NULL,
    disposition_outcome varchar(200) NOT NULL,
    /*offense_location varchar(200) NOT NULL,*/
    offense_location_prefix char(10) NOT NULL,
    offense_location_street_number int(10) NOT NULL,
    offense_location_street_name char(20) NOT NULL,
    offense_location_street_type char(20) NOT NULL,
    offense_location_unit char(30),
    offense_location_city char(30) NOT NULL,
    offense_location_state char(10) NOT NULL,
    offense_location_zip_code int(10),
    offense_location_county char(50),
    sentence_penalty varchar(100),
    CONSTRAINT FK3 FOREIGN KEY (person_number_record_details) REFERENCES person_summary (person_number)
);