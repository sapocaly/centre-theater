CREATE TABLE Costume (
  costumeid SERIAL PRIMARY KEY,
  pattern VARCHAR,
  year INTEGER,
  gender VARCHAR,
  season VARCHAR,
  description VARCHAR,
  location VARCHAR,
  size VARCHAR,
  material VARCHAR,
  type VARCHAR,
  memo VARCHAR,
  color VARCHAR,
  mainphoto VARCHAR,
  secphoto VARCHAR,
  play VARCHAR
);

CREATE TABLE Photo (
  costumeid INTEGER REFERENCES  Costume (costumeid),
  filename VARCHAR PRIMARY KEY,
  priority SMALLINT
);

CREATE TABLE UserAccount (
  email VARCHAR PRIMARY KEY,
  password VARCHAR ,
  wrongcount INTEGER DEFAULT 0,
  name VARCHAR ,
  lastlogin TIMESTAMP,
  usergroup VARCHAR
);

CREATE TABLE Option (
  field_name varchar,
  value varchar
);