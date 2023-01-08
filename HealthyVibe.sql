CREATE DATABASE IF NOT EXISTS HealthyVibe;

DROP TABLE IF EXISTS HealthyVibe.commande;
DROP TABLE IF EXISTS HealthyVibe.lieuVente;
DROP TABLE IF EXISTS HealthyVibe.POST;
DROP TABLE IF EXISTS HealthyVibe.MESSAGEDIRECT;
DROP TABLE IF EXISTS HealthyVibe.COMPOSE;
DROP TABLE IF EXISTS HealthyVibe.QUESTION;
DROP TABLE IF EXISTS HealthyVibe.COMPLETE;
DROP TABLE IF EXISTS HealthyVibe.QUIZ;
DROP TABLE IF EXISTS HealthyVibe.FAQ;
DROP TABLE IF EXISTS HealthyVibe.DONNEE;
DROP TABLE IF EXISTS HealthyVibe.CAPTEUR;
DROP TABLE IF EXISTS HealthyVibe.CASQUE;
DROP TABLE IF EXISTS HealthyVibe.SUJET;
DROP TABLE IF EXISTS HealthyVibe.UTILISATEUR;
CREATE TABLE IF NOT EXISTS HealthyVibe.UTILISATEUR (
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

CREATE TABLE IF NOT EXISTS HealthyVibe.SUJET (
  idSujet INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  titre VARCHAR(42),
  datecreation DATETIME,
  datemodification DATETIME,
  status BOOLEAN,
  idUtilisateur INT,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.UTILISATEUR(idUtilisateur) ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS HealthyVibe.CASQUE (
  idCasque INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  dateachat DATETIME,
  idUtilisateur INT,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.UTILISATEUR(idUtilisateur) ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS HealthyVibe.CAPTEUR (
  idCapteur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(42),
  type VARCHAR(42),
  idCasque INT,
  FOREIGN KEY (idCasque) REFERENCES HealthyVibe.CASQUE(idCasque)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.DONNEE (
  idDonnee INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  valeur FLOAT,
  date DATETIME,
  idCapteur INT,
  FOREIGN KEY (idCapteur) REFERENCES HealthyVibe.CAPTEUR(idCapteur)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.FAQ (
  idFaq INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  question TEXT,
  réponse TEXT
);

CREATE TABLE IF NOT EXISTS HealthyVibe.TIPSECO (
  idTips INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  contenu TEXT,
  lienVideo DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS HealthyVibe.QUIZ (
  idQuiz INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(42)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.COMPLETE (
  idQuiz INT,
  idUtilisateur INT,
  FOREIGN KEY (idQuiz) REFERENCES HealthyVibe.QUIZ(idQuiz),
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.UTILISATEUR(idUtilisateur)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.QUESTION (
  idQuestion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  question TEXT,
  reponse TEXT
);

CREATE TABLE IF NOT EXISTS HealthyVibe.COMPOSE (
  idQuiz INT,
  idQuestion INT,
  FOREIGN KEY (idQuiz) REFERENCES HealthyVibe.QUIZ(idQuiz),
  FOREIGN KEY (idQuestion) REFERENCES HealthyVibe.QUESTION(idQuestion),
  PRIMARY KEY (idQuiz,idQuestion)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.MESSAGEDIRECT (
  idUtilisateur INT,
  idUtilisateur1 INT,
  date DATETIME,
  contenu TEXT,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.UTILISATEUR(idUtilisateur),
  FOREIGN KEY (idUtilisateur1) REFERENCES HealthyVibe.UTILISATEUR(idUtilisateur),
  PRIMARY KEY (idUtilisateur,idUtilisateur1)
);

CREATE TABLE IF NOT EXISTS HealthyVibe.POST (
  idPost INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  date DATETIME,
  contenu TEXT,
  idUtilisateur INT,
  idSujet INT,
  idReponse INT,
  FOREIGN KEY (idUtilisateur) REFERENCES HealthyVibe.UTILISATEUR(idUtilisateur) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (idSujet) REFERENCES HealthyVibe.SUJET(idSujet) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (idReponse) REFERENCES HealthyVibe.POST(idPost) ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS HealthyVibe.LIEUVENTE (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(100) NOT NULL,
  PRIMARY KEY (`idLieu`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS HealthyVibe.COMMANDE (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `Prenom` varchar(25) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Tel` int(10) NOT NULL,
  `lieu` INT NOT NULL,
  `DateDeReservation` date NOT NULL,
  PRIMARY KEY (`idReservation`),
  FOREIGN KEY (lieu) REFERENCES HealthyVibe.LIEUVENTE(idLieu) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE USER IF NOT EXISTS 'adminHealthyVibe'@'localhost' IDENTIFIED BY 'adminHealthyVibe';
GRANT SELECT, INSERT, UPDATE, DELETE ON `healthyvibe`.* TO 'adminHealthyVibe'@'localhost';

INSERT INTO HealthyVibe.UTILISATEUR (`idUtilisateur`, `nom`, `prenom`, `username`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(1, 'AdminNom', 'AdminP', 'AdminU', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$S1JiYlZ0ZnRvTVlTcEFBcQ$5SSvDGbtYY4CJ8CYITT2WOgb4zsGCd/jmUIm3k1PLOc', '192168', '1 rue du Web', 192, '1970-01-01', 1, 0);
INSERT INTO HealthyVibe.UTILISATEUR (`idUtilisateur`, `nom`, `prenom`, `username`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(2, 'UserNom', 'UserP', 'UserU', 'user@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bDg5T3hKSGZDRGVpUFRGLg$NKwLCD+XiDQrBvvuoqqeP1EX0SELHbxMnGlhlL1exp0', '192168', '1 rue du Web', 192, '1970-01-01', 0, 0);


INSERT INTO HealthyVibe.LIEUVENTE (lieu) VALUES
('10 Rue de Vanves, Issy-les-Moulineaux, 92130'),
('28 Rue Notre-Dame des Champs, Paris, 75006'),
('15 Rue Linois, Paris, 75015');

INSERT INTO HealthyVibe.FAQ (`idFaq`, `question`, `réponse`) VALUES
(1, 'Comment créer une compte client?', 'Aller dans l\'onglet en haut à droite puis cliquer sur \"S\'inscrire\".\r\nEnsuite, remplir le formulaire comme indiqué.'),
(2, 'Comment contacter le service client ?', 'Nos coordonnées sont indiquées dans en bas de page. Vous pouvez également utiliser l\'onglet \'Nous contacter\' dans la barre de menu'),
(3, 'Est-ce que le casque est résistant à l\'eau (Waterproof) ?', 'Non, notre casque n\'est pas encore étanche, mais notre équipe de recherche travaille sur une version du casque résistante à l\'eau.'),
(4, 'Est-ce que je peux commander un deuxième casque ?', 'Oui, mais à chaque compte ne peut être associé qu\'un seul casque. Vous pouvez acheter et changer de casque tout en gardant le même compte. Pour cela, contacter l\'administrateur.');
