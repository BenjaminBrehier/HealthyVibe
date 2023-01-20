<?php 
class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $mdp;
    private $role;
    private $username;
    private $tel;
    private $adresse;
    private $codepostal;
    private $datenaissance;
    private $banni;
    private $dateBanDebut;
    private $dateBanFin;

    //Le constructeur va chercher les données de l'utilisateur dans la base de données
    public function __construct($idUtilisateur) {
        $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $result = $co->query("SELECT * FROM utilisateur WHERE idUtilisateur = $idUtilisateur");
        $row = $result->fetch_object();
        $this->id = $row->idUtilisateur;
        $this->nom = $row->nom;
        $this->prenom = $row->prenom;
        $this->username = $row->username;
        $this->mail = $row->email;
        $this->mdp = $row->mdp;
        $this->role = $row->role;
        $this->tel = $row->tel;
        $this->adresse = $row->adresse;
        $this->codepostal = $row->codepostal;
        $this->datenaissance = $row->datenaissance;
        $this->banni = $row->banni;
        $this->dateBanDebut = $row->dateBanDebut;
        $this->dateBanFin = $row->dateBanFin;
    }

    public function update() {
        $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $result = $co->query("SELECT * FROM utilisateur WHERE idUtilisateur = $this->id");
        $row = $result->fetch_object();
        $this->id = $row->idUtilisateur;
        $this->nom = $row->nom;
        $this->prenom = $row->prenom;
        $this->username = $row->username;
        $this->mail = $row->email;
        $this->mdp = $row->mdp;
        $this->role = $row->role;
        $this->tel = $row->tel;
        $this->adresse = $row->adresse;
        $this->codepostal = $row->codepostal;
        $this->datenaissance = $row->datenaissance;
        $this->banni = $row->banni;
        $this->dateBanDebut = $row->dateBanDebut;
        $this->dateBanFin = $row->dateBanFin;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($idUtilisateur) {
        $this->id = $idUtilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getCodepostal() {
        return $this->codepostal;
    }

    public function setCodepostal($codepostal) {
        $this->codepostal = $codepostal;
    }

    public function getDatenaissance() {
        return $this->datenaissance;
    }

    public function setDatenaissance($datenaissance) {
        $this->datenaissance = $datenaissance;
    }

    public function getBanni() {
        return $this->banni;
    }

    public function setBanni($banni) {
        $this->banni = $banni;
    }

    public function getDateBanDebut() {
        return $this->dateBanDebut;
    }

    public function setDateBanDebut($dateBanDebut) {
        $this->dateBanDebut = $dateBanDebut;
    }

    public function getDateBanFin() {
        return $this->dateBanFin;
    }

    public function setDateBanFin($dateBanFin) {
        $this->dateBanFin = $dateBanFin;
    }

}




?>