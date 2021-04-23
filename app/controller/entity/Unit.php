<?php

class Unit
{
private $idUnit;
private $name;





/**
 * Get the value of idUnit
 */
public function getIdUnit()
{
return $this->idUnit;
}

/**
 * Set the value of idUnit
 */
public function setIdUnit($idUnit) : self
{
$this->idUnit = $idUnit;

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
public function setName($name) : self
{
$this->name = $name;

return $this;
}
public function getUnit(){
    $unit = new ModelUnit();
    // var_dump($this->idProduct);
 $unit1= $unit->readOneBy("idUnit",$this->idUnit);
  
    var_dump($unit1->getName());
    return  $unit1->getName();
}
public function setUnitFromArray($unit)
{

    foreach ($unit as $key => $value) {

        $this->$key = $value;
    }
}

}