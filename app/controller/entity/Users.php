<?php

class Users
{
   private $idUser;
   private $lastname;
   private $firstname;
   private $email;
   private $passwordHash;
   private $flag;
   private $dateCreation;
   private $login;
   private $address1;
   private $address2;
   private $zipCode;
   private $idCity;

   public function getConnectionLogs()
   {
      $model = new ModelConnectionLog();
      $logs = $model->readAllBy("idUsers", $this->getIdUser());
      return $logs;
   }

   public function getLastConnectionLog()
   {
      $lateCoDate = "-";
      if ($this->getConnectionLogs()) {
         $lateCoDate = $this->getConnectionLogs()[0]->getDateConnection();
      }
   
      return $lateCoDate;
   }

   public function getChef()
   {
      $model = new ModelUsers();
      $data  = $model->findChild("chef", $this->getIdUser());
      $chef = new Chef();
      $chef->setChefFromArray($data);
      return $chef;
   }

   public function isChef(): bool
   {
      return $this->getChef() != null;
   }

   public function getModerator()
   {
      $model     = new ModelUsers();
      $moderator = $model->findChild("moderator", $this->getIdUser());
      return $moderator;
   }

   public function isModerateur(): bool
   {
      return $this->getModerator() != null;
   }

   public function getAdmin()
   {
      $model = new ModelUsers();
      $admin = $model->findChild("administrator", $this->getIdUser());
      return $admin;
   }

   public function isAdmin(): bool
   {
      return $this->getAdmin() != null;
   }

   public function setUserFromArray($user)
   {
      foreach ($user as $key => $value) {

         $this->$key = $value;
      }
   }

   public function isPassword($plaintextPassword)
   {
      return password_verify($plaintextPassword, $this->getPasswordHash());
   }

   public function getLastname()
   {
      return $this->lastname;
   }

   public function setLastname(string $lastname)
   {
      $this->lastname = $lastname;
   }

   public function getPasswordHash()
   {
      return $this->passwordHash;
   }

   public function setPasswordHash(string $passwordHash)
   {
      $passwordHash = password_hash($passwordHash, PASSWORD_DEFAULT);
      $this->passwordHash = $passwordHash;
      return $this;
   }

   public function getLogin(): string
   {
      return $this->login;
   }

   public function setLogin(string $login)
   {
      $this->login = $login;

      return $this;
   }

   /**
    * Get the value of flag
    */
   public function getFlag(): string
   {
      return $this->flag;
   }

   /**
    * Get the value of flag
    */
   public function getDisplayFlag(): string
   {
      if ($this->flag == "a") {
         $flag = "Actif";
      }
      if ($this->flag == "w") {
         $flag = "En attente";
      }
      if ($this->flag == "b") {
         $flag = "Bloqué";
      }
      return $flag;
   }

   /**
    * Set the value of flag
    *
    * @return self
    */
   public function setFlag(string $flag): self
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
   public function getAddress1()
   {
      return $this->address1;
   }

   /**
    * Set the value of adress1
    *
    * @return self
    */
   public function setAddress1($address1): self
   {
      $this->address1 = $address1;
      return $this;
   }

   /**
    * Get the value of adress2
    */
   public function getAddress2()
   {
      return $this->address2;
   }

   /**
    * Set the value of adress2
    *
    * @return self
    */
   public function setAddress2($address2): self
   {
      $this->address2 = $address2;

      return $this;
   }

   /**
    * Get the value of zipCode
    */
   public function getZipCode(): int
   {
      return $this->zipCode;
   }

   /**
    * Set the value of zipCode
    *
    * @return self
    */
   public function setZipCode(int $zipCode): self
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

   public function setRoles()
   {
   }

   public function makeAdmin()
   {
      $admin = new Admin();
      $admin->setIdAdmin($this->idUser);
      $model = new ModelAdmin();
      $model->insertAdmin($admin);
   }

   public function makeModerator()
   {
      $moderator = new Moderator();
      $moderator->setIdModerator($this->idUser);
      $model = new ModelModerator();
      $model->insertModerator($moderator);
   }

   public function makeChef()
   {
      $chef = new Chef();
      $chef->setIdChef($this->idUser);
      $model = new ModelChef();
      $model->insertChef($chef);
   }

   /**
    * Get the value of idUser
    */
   public function getIdUser()
   {
      return $this->idUser;
   }

   /**
    * Set the value of idUser
    *
    * @return self
    */
   public function setIdUser($idUser): self
   {
      $this->idUser = $idUser;
      return $this;
   }

   public function getCountOrders()
   {
      return count($this->getOrders());
   }

   public function getOrders()
   {
      $modelorder = new ModelOrders();
      $orders = $modelorder->readAllBy("idUsers", $this->idUser);
      return $orders;
   }

   public function getComments()
   {
      $com = new ModelComment();
      $comments = $this->data['arrayCom'] = $com->readAll();
      return $comments;
   }

   // public function getLastConnection()
   // {
   //    $connect = new ModelConnectionLog();
   //    $co = $connect->readOneBy("idUsers", $this->idUser);
   //    return $co;
   // }
}
