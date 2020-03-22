DROP DATABASE IF EXISTS project;
CREATE DATABASE project;
USE project;

CREATE TABLE application (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL,
  name VARCHAR(30) NOT NULL,
  surname VARCHAR(30) NOT NULL,
  authors VARCHAR(200) DEFAULT NULL,
  affiliation VARCHAR(50) NOT NULL,
  title VARCHAR(100) NOT NULL,
  category ENUM('freestyle','projekt IT') NOT NULL,
  regulations ENUM('zaakceptowane') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO application (email, name, surname, authors, affiliation, title, category, regulations) VALUES
('arkadiusz.bermowski@wp.pl', 'Arkadiusz', 'Bremowski', 'Bartłomiej Iwaszek, Kacper Niemiec', 'Akademia Górniczo-Hutnicza', 'Algorytm detekcji mimiki twarzy', 'projekt IT', 'zaakceptowane'),
('dawid.nowak@onet.pl', 'Dawid', 'Nowak', NULL, 'Uniwersytet Rzeszowski', 'WiredLine', 'freestyle', 'zaakceptowane'),
('marek.gil@gmail.com', 'Marek', 'Gil', NULL, 'Politechnika Wrocławska', 'Innowacyjny projekt traktora', 'projekt IT', 'zaakceptowane'),
('tomasz.kot@wp.pl', 'Tomasz', 'Kot', 'Andżelika Wiech', 'Uniwersytet Jagielloński', 'Stacja meteorologiczna na platformie Raspberry PI', 'freestyle', 'zaakceptowane'),
('anna.bal@op.pl', 'Anna', 'Bal', NULL, 'Politechnika Warszawska', 'Insudi - kalkulator insuliny', 'freestyle', 'zaakceptowane'),
('monika.lech@wp.com', 'Monika', 'Dworak', NULL, 'Politechnika Poznańska', 'Projekt gry mobilnej "ranDungeon"', 'freestyle', 'zaakceptowane'),
('marek.kus@gmail.com', 'Marek', 'Kus', NULL, 'Katolicki Uniwersytet Lubleski', 'Wizualizacja silnika benzynowego 1,6l 16v', 'projekt IT', 'zaakceptowane'),
('michal.chmiel@wp.pl', 'Michał', 'Chmiel', NULL, 'Politechnika Gdańska', 'ManualGearBox', 'freestyle', 'zaakceptowane');

CREATE TABLE users (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  email varchar(256) DEFAULT NULL,
  password varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;