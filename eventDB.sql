CREATE TABLE Events (
  Event_ID varchar (100),
  Showground_Name varchar(150),
  Email varchar (100),
  Showground_Address varchar (150),
  Postcode varchar(8),
  Date_of_Event date,
  Closing_Date date,
  Time_of_first_class time,
  Discipline varchar(70),
  Classes varchar(100),
  Cost_per_class varchar (4),
  Special_Instructions varchar(250),
  PRIMARY KEY (`Event_ID`)
);
