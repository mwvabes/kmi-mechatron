DROP DATABASE IF EXISTS project;
CREATE DATABASE project;
USE project;

CREATE TABLE users (
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
  status ENUM('złożone', 'zaakceptowane', 'odrzucone') DEFAULT 'złożone' NOT NULL,
  application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (email, firstname, lastname, password, admin) VALUES
('admin@ur.pl', 'Admin', 'Admin', '$2y$10$JJm7cyQ1bQQD.Y/rOzDVde/bexEIZXnFi5z39kXckgkw6dzrn0y92', TRUE),
('arkadiusz.bremowski@wp.pl', 'Arkadiusz', 'Bremowski', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('dawid.nowak@onet.pl', 'Dawid', 'Nowak', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('marek.gil@gmail.com', 'Marek', 'Gil', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('tomasz.kot@wp.pl', 'Tomasz', 'Kot', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('anna.bal@op.pl', 'Anna', 'Bal', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('monika.lech@wp.com', 'Monika', 'Lech', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('marek.kus@gmail.com', 'Marek', 'Kus', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE),
('michal.chmiel@wp.pl', 'Michał', 'Chmiel', '$2y$10$Pk9EIAD2GNlDTH4ROAeIgObDhjuVfnhEJQeaS7kHtFyXIjQYqQhZ6', FALSE);

INSERT INTO application (user_id, authors, affiliation, title, category, status, application_date, regulations) VALUES
(2, 'Bartłomiej Iwaszek, Kacper Niemiec', 'Akademia Górniczo-Hutnicza', 'Algorytm detekcji mimiki twarzy', 'projekt IT', 'zaakceptowane', '2020-03-05 12:48:24', 'zaakceptowane'),
(3, NULL, 'Uniwersytet Rzeszowski', 'WiredLine', 'freestyle', 'odrzucone', '2020-03-05 12:48:24', 'zaakceptowane'),
(4, NULL, 'Politechnika Wrocławska', 'Innowacyjny projekt traktora', 'projekt IT', 'złożone', '2020-03-12 12:48:24', 'zaakceptowane'),
(5, 'Andżelika Wiech', 'Uniwersytet Jagielloński', 'Stacja meteorologiczna na platformie Raspberry PI', 'freestyle', 'złożone', '2020-03-20 12:48:24', 'zaakceptowane'),
(6, NULL, 'Uniwersytet Jagielloński', 'Insudi - kalkulator insuliny', 'freestyle', 'złożone', '2020-03-20 12:48:24', 'zaakceptowane'),
(7, NULL, 'Politechnika Poznańska', 'Projekt gry mobilnej "ranDungeon"', 'freestyle', 'zaakceptowane', '2020-03-20 12:48:24', 'zaakceptowane'),
(8, NULL, 'Uniwersytet Rzeszowski', 'Wizualizacja silnika benzynowego 1,6l 16v', 'projekt IT', 'złożone', '2020-03-25 12:48:24', 'zaakceptowane'),
(9, NULL, 'Uniwersytet Rzeszowski', 'ManualGearBox', 'freestyle', 'złożone', '2020-03-30 12:48:24', 'zaakceptowane');