CREATE TABLE IF NOT EXISTS UTILISATEUR (
  idUtilisateur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(42),
  prenom VARCHAR(42),
  email VARCHAR(42),
  mdp VARCHAR(110),
  tel VARCHAR(13),
  adresse VARCHAR(42),
  codepostal INT,
  datenaissance DATE,
  role BOOLEAN,
  banni BOOLEAN
);

CREATE TABLE IF NOT EXISTS SUJET (
  idSujet INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  titre VARCHAR(42),
  datecreation DATETIME,
  datemodification DATETIME,
  status BOOLEAN,
  idUtilisateur INT,
  FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur)
);

CREATE TABLE IF NOT EXISTS CASQUE (
  idCasque INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  dateachat DATETIME,
  idUtilisateur INT,
  FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur)
);

CREATE TABLE IF NOT EXISTS CAPTEUR (
  idCapteur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(42),
  type VARCHAR(42),
  idCasque INT,
  FOREIGN KEY (idCasque) REFERENCES CASQUE(idCasque)
);

CREATE TABLE IF NOT EXISTS DONNEE (
  idDonnee INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  valeur FLOAT,
  date DATETIME,
  idCapteur INT,
  FOREIGN KEY (idCapteur) REFERENCES CAPTEUR(idCapteur)
);

CREATE TABLE IF NOT EXISTS FAQ (
  idFaq INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  question TEXT,
  réponse TEXT
);

CREATE TABLE IF NOT EXISTS QUIZ (
  idQuiz INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(42)
);

CREATE TABLE IF NOT EXISTS COMPLETE (
  idQuiz INT,
  idUtilisateur INT,
  FOREIGN KEY (idQuiz) REFERENCES QUIZ(idQuiz),
  FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur)
);

CREATE TABLE IF NOT EXISTS QUESTION (
  idQuestion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  question TEXT,
  reponse TEXT
);

CREATE TABLE IF NOT EXISTS COMPOSE (
  idQuiz INT,
  idQuestion INT,
  FOREIGN KEY (idQuiz) REFERENCES QUIZ(idQuiz),
  FOREIGN KEY (idQuestion) REFERENCES QUESTION(idQuestion),
  PRIMARY KEY (idQuiz,idQuestion)
);

CREATE TABLE IF NOT EXISTS MESSAGEDIRECT (
  idUtilisateur INT,
  idUtilisateur1 INT,
  date DATETIME,
  contenu TEXT,
  FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur),
  FOREIGN KEY (idUtilisateur1) REFERENCES UTILISATEUR(idUtilisateur),
  PRIMARY KEY (idUtilisateur,idUtilisateur1)
);

CREATE TABLE IF NOT EXISTS POST (
  idPost INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  date DATETIME,
  contenu TEXT,
  idUtilisateur INT,
  idSujet INT,
  idReponse INT,
  FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur),
  FOREIGN KEY (idSujet) REFERENCES SUJET(idSujet),
  FOREIGN KEY (idReponse) REFERENCES POST(idPost)
);

CREATE USER 'adminHealthyVibe'@'localhost' IDENTIFIED BY 'adminHealthyVibe';
GRANT ALL PRIVILEGES ON HeathyVibe . * TO 'adminHealthyVibe'@'localhost';

INSERT INTO `UTILISATEUR` (`idUtilisateur`, `nom`, `prenom`, `email`, `mdp`, `tel`, `adresse`, `codepostal`, `datenaissance`, `role`, `banni`) VALUES
(14, 'AdminNom', 'Admin', 'admin@gmail.com', 'admin', '192168', '1 rue du Web', 192, '1970-01-01', 0, 0);
