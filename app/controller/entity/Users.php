<?php

class Users
{
 private $id;
 private $lastname;
 private $firstname;
 private $email;
 private $passwordHash;
 private $flag;
 private $dateCreation;
 private $login;
 private $adress1;
 private $adress2;
 private $zipCode;
 private $idCity;
 private $lastConnection;

 public function isChef(): bool
 {
  $model = new ModelUsers();
  $chef  = $model->findChild("chef", $this->getId());
  //var_dump($chef);
  return $chef != null;

 }
 public function isModerateur(): bool
 {
  $model     = new ModelUsers();
  $moderator = $model->findChild("moderator", $this->getId());
  //var_dump($chef);
  return $moderator != null;

 }
 public function isAdmin(): bool
 {
  $model = new ModelUsers();
  $admin = $model->findChild("administrator", $this->getId());
  //var_dump($chef);
  return $admin != null;

 }

 public function setUserFromArray($user)
 {
  // var_dump($user);
  foreach ($user as $key => $value) {

   $this->$key = $value;

  }
 }
 public function isPassword($plaintextPassword)
 {
  return password_verify($plaintextPassword, $this->getPasswordHash());
 }

 public function getId(): int
 {
  return $this->id;
 }
 public function setId($id): int
 {
  $this->id = $id;

  return $this;
 }
 public function getLastname(): string
 {
  return $this->lastname;
 }
 public function setLastname($lastname): string
 {
  $this->lastname = $lastname;

  return $this;
 }
 public function getPasswordHash()
 {
  return $this->passwordHash;
 }
 public function setPasswordHash($passwordHash)
 {
  $this->passwordHash = $passwordHash;

  return $this;
 }
 public function getLogin(): string
 {
  return $this->login;
 }
 public function setLogin(string $login): string
 {
  $this->login = $login;

  return $this;
 }
 /**
  * Get the value of flag
  */
 public function getFlag(): string
 {
     if($this->flag =="a"){
        $this->flag = "Actif";
     }
     if($this->flag =="w"){
        $this->flag = "En attente";
     }
     if($this->flag =="b"){
        $this->flag = "Bloqué";
     }
    
  return $this->flag;
 }

 /**
  * Set the value of flag
  *
  * @return self
  */
 public function setFlag($flag): self
 {
  $this->flag = $flag;

  return $this;
 }

 /**
  * Get the value of dateCreation
  */
 public function getDateCreation()
 {
  return $this->dateCreation;
 }

 /**
  * Set the value of dateCreation
  *
  * @return self
  */
 public function setDateCreation($dateCreation): self
 {
  $this->dateCreation = $dateCreation;

  return $this;
 }

 /**
  * Get the value of adress1
  */
 public function getAdress1(): string
 {
  return $this->adress1;
 }

 /**
  * Set the value of adress1
  *
  * @return self
  */
 public function setAdress1($adress1): self
 {
  $this->adress1 = $adress1;

  return $this;
 }

 /**
  * Get the value of adress2
  */
 public function getAdress2(): string
 {
  return $this->adress2;
 }

 /**
  * Set the value of adress2
  *
  * @return self
  */
 public function setAdress2($adress2): self
 {
  $this->adress2 = $adress2;

  return $this;
 }

 /**
  * Get the value of zipCode
  */
 public function getZipCode()
 {
  return $this->zipCode;
 }

 /**
  * Set the value of zipCode
  *
  * @return self
  */
 public function setZipCode($zipCode): self
 {
  $this->zipCode = $zipCode;

  return $this;
 }

 /**
  * Get the value of idCity
  */
 public function getIdCity(): string
 {
  return $this->idCity;
 }

 /**
  * Set the value of idCity
  *
  * @return self
  */
 public function setIdCity($idCity): self
 {
  $this->idCity = $idCity;

  return $this;
 }

 /**
  * Get the value of email
  */
 public function getEmail(): string
 {
  return $this->email;
 }

 /**
  * Set the value of email
  *
  * @return self
  */
 public function setEmail($email): self
 {
  $this->email = $email;

  return $this;
 }

 /**
  * Get the value of firstname
  */
 public function getFirstname(): string
 {
  return $this->firstname;
 }

 /**
  * Set the value of firstname
  *
  * @return self
  */
 public function setFirstname($firstname): self
 {
  $this->firstname = $firstname;

  return $this;
 }

 public function getRoles(): string
 {
  $result = "";
  $format = ", ";
  if ($this->isChef()) {
   $result .= "Chef" . $format;
  }
  if ($this->isModerateur()) {
   $result .= "Moderateur" . $format;
  }
  if ($this->isAdmin()) {
   $result .= "Administateur" . $format;
  }
  if ($result == "") {
   $result = "Utilisateur" . $format;
  }
  $pos = substr($result, 0, -2);

  return $pos;
 }

 /**
  * Get the value of lastConnection
  */
 public function getLastConnection()
 {
  return $this->lastConnection;
 }

 /**
  * Set the value of lastConnection
  *
  * @return self
  */
 public function setLastConnection($lastConnection): self
 {
  $this->lastConnection = $lastConnection;

  return $this;
 }
}
