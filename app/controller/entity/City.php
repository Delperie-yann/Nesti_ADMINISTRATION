<?php

class City
{


  private $idCity;
  private $name;


  /**
   * Get the value of idCity
   */
  public function getIdCity()
  {
    return $this->idCity;
  }

  /**
   * Set the value of idCity
   */
  public function setIdCity($idCity): self
  {
    $this->idCity = $idCity;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   */
  public function setName($name): self
  {
    $this->name = $name;

    return $this;
  }
  
  /**
   * setCityFromArray
   *
   * @param  mixed $user
   * @return void
   */
  public function setCityFromArray($user)
  {
    if ($user == true) {
      foreach ($user as $key => $value) {

        $this->$key = $value;
      }
    }
  }
}
