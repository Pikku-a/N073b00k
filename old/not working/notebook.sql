CREATE DATABASE notebookdb;
USE notebookdb;

CREATE TABLE users (
  'username' varchar(255) NOT NULL,
  'password' varchar(255) NOT NULL,
  'text' varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*INSERT INTO 'users' ('user_name','text') VALUES
(1, 'John Doe'),
(2, 'Jane Doe'),
(3, 'Johan Doe');

/*ALTER TABLE 'users'
  ADD PRIMARY KEY ('user_id'),
  ADD KEY 'username' ('username');