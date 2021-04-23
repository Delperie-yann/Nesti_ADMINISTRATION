<?php

class Product
{
private $idProduct;
private $name;




/**
 * Get the value of idProduct
 */
public function getIdProduct()
{
return $this->idProduct;
}

/**
 * Set the value of idProduct
 */
public function setIdProduct($idProduct) : self
{
$this->idProduct = $idProduct;

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
public function setProductFromArray($product)
{

    foreach ($product as $key => $value) {

        $this->$key = $value;
    }
}
}