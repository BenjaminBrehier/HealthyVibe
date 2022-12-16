CREATE DATABASE IF NOT EXISTS HealthyVibe;

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
  role BOOLEAN,
  banni BOOLEAN
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

CREATE USER IF NOT EXISTS 'adminHealthyVibe'@'localhost' IDENTIFIED BY 'adminHealthyVibe';
GRANT SELECT, INSERT, UPDATE, DELETE ON `healthyvibe`.* TO 'adminHealthyVibe'@'localhost';

INSERT INTO HealthyVibe.UTILISATEUR (`idUtilisateur`, `nom`, `prenom`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(1, 'AdminNom', 'Admin', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$S1JiYlZ0ZnRvTVlTcEFBcQ$5SSvDGbtYY4CJ8CYITT2WOgb4zsGCd/jmUIm3k1PLOc', '192168', '1 rue du Web', 192, '1970-01-01', 1, 0);
INSERT INTO HealthyVibe.UTILISATEUR (`idUtilisateur`, `nom`, `prenom`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(2, 'UserNom', 'user', 'user@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bDg5T3hKSGZDRGVpUFRGLg$NKwLCD+XiDQrBvvuoqqeP1EX0SELHbxMnGlhlL1exp0', '192168', '1 rue du Web', 192, '1970-01-01', 0, 0);
