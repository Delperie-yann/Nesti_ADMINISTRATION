<?php

class Ingredient {


 
    private $idProduct;




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
     * setIngredientFromArray
     *
     * @param  mixed $chef
     * @return void
     */
    public function setIngredientFromArray($chef)
    {
      
       foreach ($chef as $key => $value) {
 
          $this->$key = $value;
       }
    }
}