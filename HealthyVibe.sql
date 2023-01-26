CREATE DATABASE IF NOT EXISTS HealthyVibe;

DROP TABLE IF EXISTS HealthyVibe.commande;
DROP TABLE IF EXISTS HealthyVibe.lieuVente;
DROP TABLE IF EXISTS HealthyVibe.POST;
DROP TABLE IF EXISTS HealthyVibe.messagedirect;
DROP TABLE IF EXISTS HealthyVibe.compose;
DROP TABLE IF EXISTS HealthyVibe.question;
DROP TABLE IF EXISTS HealthyVibe.complete;
DROP TABLE IF EXISTS HealthyVibe.quiz;
DROP TABLE IF EXISTS HealthyVibe.faq;
DROP TABLE IF EXISTS HealthyVibe.donnee;
DROP TABLE IF EXISTS HealthyVibe.capteur;
DROP TABLE IF EXISTS HealthyVibe.casque;
DROP TABLE IF EXISTS HealthyVibe.sujet;
DROP TABLE IF EXISTS HealthyVibe.utilisateur;
DROP TABLE IF EXISTS HealthyVibe.tipseco;

CREATE TABLE IF NOT EXISTS HealthyVibe.utilisateur (
  idUtilisateur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(42),
  prenom VARCHAR(42),
  username VARCHAR(42),
  email VARCHAR(42),
  mdp VARCHAR(110),
  tel VARCHAR(13),
  adresse VARCHAR(42),
  codepostal INT,
  datenaissance DATE,
  role BOOLEAN DEFAULT 0,
  banni BOOLEAN DEFAULT 0,
  dateBanDebut DATE DEFAULT NULL,
  dateBanFin DATE DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS HealthyVibe.sujet (
  idSujet INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  titre VARCHAR(42),
  datecreation DATETIME,
  datemodification DATETIME,
  status BOOLEAN,
  idUtilisateur INT,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.utilisateur(idUtilisateur) ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS HealthyVibe.casque (
  idCasque INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  dateachat DATETIME,
  idUtilisateur INT,
  ancienID INT DEFAULT NULL,
  actif BOOLEAN DEFAULT 1,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.utilisateur(idUtilisateur) ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS HealthyVibe.capteur (
  idCapteur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(42),
  type VARCHAR(42),
  idCasque INT,
  FOREIGN KEY (idCasque) REFERENCES HealthyVibe.casque(idCasque)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.donnee (
  idDonnee INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  valeur FLOAT,
  date DATETIME,
  idCapteur INT,
  FOREIGN KEY (idCapteur) REFERENCES HealthyVibe.capteur(idCapteur)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.faq (
  idFaq INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  question TEXT,
  reponse TEXT
);

CREATE TABLE IF NOT EXISTS HealthyVibe.tipseco (
  idTips INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  contenu TEXT,
  lienVideo TEXT DEFAULT NULL
);

--! En vue d'amérlioration du site, on peut imaginer un système de quiz
-- CREATE TABLE IF NOT EXISTS HealthyVibe.quiz (
--   idQuiz INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
--   nom VARCHAR(42)
-- );

-- CREATE TABLE IF NOT EXISTS HealthyVibe.complete (
--   idQuiz INT,
--   idUtilisateur INT,
--   FOREIGN KEY (idQuiz) REFERENCES HealthyVibe.quiz(idQuiz),
--   FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.utilisateur(idUtilisateur)
-- );

-- CREATE TABLE IF NOT EXISTS HealthyVibe.question (
--   idQuestion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
--   question TEXT,
--   reponse TEXT
-- );

CREATE TABLE IF NOT EXISTS HealthyVibe.compose (
  idQuiz INT,
  idQuestion INT,
  FOREIGN KEY (idQuiz) REFERENCES HealthyVibe.quiz(idQuiz),
  FOREIGN KEY (idQuestion) REFERENCES HealthyVibe.question(idQuestion),
  PRIMARY KEY (idQuiz,idQuestion)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.messagedirect (
  idMessage INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  idUtilisateur INT,
  idUtilisateur1 INT,
  date DATETIME,
  contenu TEXT,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.utilisateur(idUtilisateur),
  FOREIGN KEY (idUtilisateur1) REFERENCES HealthyVibe.utilisateur(idUtilisateur)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.post (
  idPost INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  date DATETIME,
  contenu TEXT,
  idUtilisateur INT,
  idSujet INT,
  idReponse INT,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.utilisateur(idUtilisateur) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (idSujet) REFERENCES HealthyVibe.sujet(idSujet) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (idReponse) REFERENCES HealthyVibe.post(idPost) ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS HealthyVibe.lieuvente (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(100) NOT NULL,
  PRIMARY KEY (`idLieu`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS HealthyVibe.commande (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `Prenom` varchar(25) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Tel` int(10) NOT NULL,
  `lieu` INT NOT NULL,
  `DateDeReservation` date NOT NULL,
  PRIMARY KEY (`idReservation`),
  FOREIGN KEY (lieu) REFERENCES HealthyVibe.lieuvente(idLieu) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE USER IF NOT EXISTS 'adminHealthyVibe'@'localhost' IDENTIFIED BY 'adminHealthyVibe';
GRANT SELECT, INSERT, UPDATE, DELETE ON `healthyvibe`.* TO 'adminHealthyVibe'@'localhost';

INSERT INTO HealthyVibe.utilisateur (`idUtilisateur`, `nom`, `prenom`, `username`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(1, 'AdminNom', 'AdminP', 'AdminU', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$S1JiYlZ0ZnRvTVlTcEFBcQ$5SSvDGbtYY4CJ8CYITT2WOgb4zsGCd/jmUIm3k1PLOc', '192168', '1 rue du Web', 192, '1970-01-01', 1, 0);
INSERT INTO HealthyVibe.utilisateur (`idUtilisateur`, `nom`, `prenom`, `username`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(2, 'UserNom', 'UserP', 'UserU', 'user@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bDg5T3hKSGZDRGVpUFRGLg$NKwLCD+XiDQrBvvuoqqeP1EX0SELHbxMnGlhlL1exp0', '192168', '1 rue du Web', 192, '1970-01-01', 0, 0);
INSERT INTO HealthyVibe.utilisateur (`idUtilisateur`, `nom`, `prenom`, `username`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(3, 'Leroy', 'Chloe', 'cleroy', 'chloe@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bDg5T3hKSGZDRGVpUFRGLg$NKwLCD+XiDQrBvvuoqqeP1EX0SELHbxMnGlhlL1exp0', '0654567788', '34 Avenue Foch', 75008, '2002-12-01', 0, 0);
INSERT INTO HealthyVibe.utilisateur (`idUtilisateur`, `nom`, `prenom`, `username`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(4, 'Golder', 'Jean', 'jiji', 'jiji@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bDg5T3hKSGZDRGVpUFRGLg$NKwLCD+XiDQrBvvuoqqeP1EX0SELHbxMnGlhlL1exp0', '0745675345', '1 rue Falret', 92170, '1970-11-23', 0, 0);



INSERT INTO HealthyVibe.casque (dateachat, idUtilisateur, actif) VALUES('2023-01-17 15:00:00', 2, 1);

-- Insertion de capteurs "température", "pouls" et "gaz"… dans la table Capteurs
INSERT INTO HealthyVibe.capteur (type, idCasque) VALUES ('temperature corporelle', 1);
INSERT INTO HealthyVibe.capteur (type, idCasque) VALUES ('pouls', 1);
INSERT INTO HealthyVibe.capteur (type, idCasque) VALUES ('gaz', 1);
INSERT INTO HealthyVibe.capteur (type, idCasque) VALUES ('decibel', 1);
INSERT INTO HealthyVibe.capteur (type, idCasque) VALUES ('temperature extérieure', 1);
INSERT INTO HealthyVibe.capteur (type, idCasque) VALUES ('décibel extérieur', 1);

-- Insertion de données dans la table Donnees
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.5, '2022-12-17 09:37:24', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (37.0, '2022-12-17 15:56:47', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.8, '2022-12-17 16:52:09', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.6, '2022-12-18 08:43:34', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (35.7, '2022-12-18 15:59:10', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.4, '2022-12-18 17:05:18', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (35.9, '2022-12-19 10:52:49', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (35.8, '2022-12-19 19:22:26', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (35.7, '2022-12-19 21:23:25', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.0, '2022-12-20 09:46:08', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.2, '2022-12-20 10:29:13', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.3, '2022-12-20 16:37:50', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.8, '2022-12-21 11:02:31', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (36.7, '2022-12-21 13:28:24', 1);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (37.5, '2022-12-21 17:08:57', 1);

INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (80, '2022-12-17 15:00:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (78, '2022-12-17 15:05:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (70, '2022-12-17 15:10:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (70, '2022-12-17 15:15:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (70, '2022-12-17 15:20:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (68, '2022-12-18 15:25:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (65, '2022-12-18 15:30:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (68, '2022-12-18 15:35:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (70, '2022-12-18 15:40:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (73, '2022-12-18 15:45:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (70, '2022-12-19 15:50:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (70, '2022-12-19 20:00:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (71, '2022-12-19 20:05:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (79, '2022-12-19 20:10:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (120, '2022-12-19 20:15:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (118, '2022-12-20 20:20:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (119, '2022-12-20 15:25:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (119, '2022-12-20 15::00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (120, '2022-12-21 15:02:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (79, '2022-12-21 15:02:00', 2);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (79, '2022-12-21 15:02:00', 2);

INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (645, '2022-12-17 16:20:08', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (695, '2022-12-17 21:02:23', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (708, '2022-12-17 22:39:47', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (791, '2022-12-18 12:53:21', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (697, '2022-12-18 14:01:29', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (785, '2022-12-18 17:19:02', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (774, '2022-12-19 11:28:43', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (720, '2022-12-19 19:14:39', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (759, '2022-12-19 21:42:47', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (624, '2022-12-20 08:37:39', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (617, '2022-12-20 08:57:10', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (735, '2022-12-20 14:12:51', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (663, '2022-12-21 11:24:41', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (677, '2022-12-21 13:05:42', 3);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (638, '2022-12-21 16:32:27', 3);


INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (80, '2022-12-17 15:00:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (70, '2022-12-17 15:05:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (75, '2022-12-17 15:10:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (110, '2022-12-18 16:10:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (109, '2022-12-18 17:10:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (60, '2022-12-18 18:10:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (65, '2022-12-19 15:10:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (75, '2022-12-19 16:20:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (85, '2022-12-19 17:10:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (95, '2022-12-20 17:25:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (90, '2022-12-20 17:45:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (65, '2022-12-20 17:55:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (45, '2022-12-21 10:10:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (20, '2022-12-21 10:15:00', 4);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (20, '2022-12-21 10:20:00', 4);


INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (20.2, '2022-12-17 15:02:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (23, '2022-12-17 15:00:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (10, '2022-12-17 15:05:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (12, '2022-12-17 15:10:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (10, '2022-12-18 16:10:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (5, '2022-12-18 17:10:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (6, '2022-12-18 18:10:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (4, '2022-12-19 15:10:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (7, '2022-12-19 16:20:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (13, '2022-12-19 17:10:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (2, '2022-12-20 17:25:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (2, '2022-12-20 17:45:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (3, '2022-12-20 17:55:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (1, '2022-12-21 10:10:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (3, '2022-12-21 10:15:00', 5);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (2, '2022-12-21 10:20:00', 5);


INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (90, '2023-01-17 15:00:00', 6);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (85.8, '2023-01-17 15:01:00', 6);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (50, '2023-01-17 15:02:00', 6);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (52, '2023-01-17 15:03:00', 6);
INSERT INTO HealthyVibe.donnee (valeur, date, idCapteur) VALUES (50, '2023-01-17 15:04:00', 6);

INSERT INTO HealthyVibe.lieuvente (lieu) VALUES
('10 Rue de Vanves, Issy-les-Moulineaux, 92130'),
('28 Rue Notre-Dame des Champs, Paris, 75006'),
('15 Rue Linois, Paris, 75015');

INSERT INTO HealthyVibe.faq (`idFaq`, `question`, `reponse`) VALUES
(1, 'Comment créer une compte client?', 'Aller dans l\'onglet en haut à droite puis cliquer sur \"S\'inscrire\".\r\nEnsuite, remplir le formulaire comme indiqué.'),
(2, 'Comment contacter le service client ?', 'Nos coordonnées sont indiquées dans en bas de page. Vous pouvez également utiliser l\'onglet \'Nous contacter\' dans la barre de menu'),
(3, 'Est-ce que le casque est résistant à l\'eau (Waterproof) ?', 'Non, notre casque n\'est pas encore étanche, mais notre équipe de recherche travaille sur une version du casque résistante à l\'eau.'),
(4, 'Est-ce que je peux commander un deuxième casque ?', 'Oui, mais à chaque compte ne peut être associé qu\'un seul casque. Vous pouvez acheter et changer de casque tout en gardant le même compte. Pour cela, contacter l\'administrateur.');

INSERT INTO HealthyVibe.tipseco (idTips,contenu,lienVideo ) VALUES
(1, 'Consommer des produits locaux pour réduire les émissions de CO2','https://youtu.be/oKL11przvhg'),
(2, 'Triez vos déchets pour faciliter le recyclage', 'https://www.youtube.com/watch?v=rNwtMO_Hay4'),
(3, 'Favoriser l\'utilisation des transports en commun,le pedibus ou le vélo','https://youtu.be/29sPmNeS4AQ'),
(4, 'S\'habiller de manière écologique','https://youtu.be/H9K1R2_N17k'),
(5, 'Transformer les eaux inutilisées pour le maréchage', 'https://www.youtube.com/watch?v=bpUiwa0ei9A'),
(6, 'Diminuer votre consommation d\'énergie en utilisant des lampes à basse consommation', 'https://www.youtube.com/watch?v=E331tTmy0Hw');