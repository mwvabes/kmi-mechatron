DROP DATABASE IF EXISTS project;
CREATE DATABASE project;
USE project;

CREATE TABLE user (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(256) NOT NULL,
  password VARCHAR(2048) NOT NULL,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  admin BOOLEAN NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE application (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  authors VARCHAR(200) DEFAULT NULL,
  affiliation VARCHAR(50) NOT NULL,
  title VARCHAR(100) NOT NULL,
  category ENUM('freestyle','projekt IT') NOT NULL,
  regulations ENUM('zaakceptowane') DEFAULT NULL,
  status ENUM('złożone', 'zaakceptowane') DEFAULT 'złożone' NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO user (email, firstname, lastname, password, admin) VALUES
('admin@ur.pl', 'Admin', 'Admin', '$2y$10$JJm7cyQ1bQQD.Y/rOzDVde/bexEIZXnFi5z39kXckgkw6dzrn0y92', TRUE),
('arkadiusz.bermowski@wp.pl', 'Arkadiusz', 'Bremowski', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('dawid.nowak@onet.pl', 'Dawid', 'Nowak', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('marek.gil@gmail.com', 'Marek', 'Gil', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('tomasz.kot@wp.pl', 'Tomasz', 'Kot', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('anna.bal@op.pl', 'Anna', 'Bal', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('monika.lech@wp.com', 'Monika', 'Lech', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('marek.kus@gmail.com', 'Marek', 'Kus', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('michal.chmiel@wp.pl', 'Michał', 'Chmiel', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE);

INSERT INTO application (user_id, authors, affiliation, title, category, regulations) VALUES
(2, 'Bartłomiej Iwaszek, Kacper Niemiec', 'Akademia Górniczo-Hutnicza', 'Algorytm detekcji mimiki twarzy', 'projekt IT', 'zaakceptowane'),
(3, NULL, 'Uniwersytet Rzeszowski', 'WiredLine', 'freestyle', 'zaakceptowane'),
(4, NULL, 'Politechnika Wrocławska', 'Innowacyjny projekt traktora', 'projekt IT', 'zaakceptowane'),
(5, 'Andżelika Wiech', 'Uniwersytet Jagielloński', 'Stacja meteorologiczna na platformie Raspberry PI', 'freestyle', 'zaakceptowane'),
(6, NULL, 'Politechnika Warszawska', 'Insudi - kalkulator insuliny', 'freestyle', 'zaakceptowane'),
(7, NULL, 'Politechnika Poznańska', 'Projekt gry mobilnej "ranDungeon"', 'freestyle', 'zaakceptowane'),
(8, NULL, 'Katolicki Uniwersytet Lubleski', 'Wizualizacja silnika benzynowego 1,6l 16v', 'projekt IT', 'zaakceptowane'),
(9, NULL, 'Politechnika Gdańska', 'ManualGearBox', 'freestyle', 'zaakceptowane');