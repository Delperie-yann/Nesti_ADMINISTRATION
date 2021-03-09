<?php

class Orders
{
 private $id;
 private $lastname;
 private $firstname;
 private $flag;
 private $dateCreation;
 private $quant;

 /**
  * Get the value of id
  */
 public function getId()
 {
  return $this->id;
 }

 /**
  * Set the value of id
  *
  * @return self
  */
 public function setId($id): self
 {
  $this->id = $id;

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
  * Get the value of flag
  */
 public function getFlag()
 {
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
  * Get the value of firstname
  */
 public function getFirstname()
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

 /**
  * Get the value of lastname
  */
 public function getLastname()
 {
  return $this->lastname;
 }

 /**
  * Set the value of lastname
  *
  * @return self
  */
 public function setLastname($lastname): self
 {
  $this->lastname = $lastname;

  return $this;
 }

 /**
  * Get the value of quant
  */
 public function getQuant()
 {
  return $this->quant;
 }

 /**
  * Set the value of quant
  *
  * @return self
  */
 public function setQuant($quant): self
 {
  $this->quant = $quant;

  return $this;
 }
}
