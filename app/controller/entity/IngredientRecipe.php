<?php

class IngredientRecipe {


 
    private $idProduct;
    private $idRecipe;
    private $quantity;
    private $recipePosition;
    private $idUnit;






    
    public function setIngredientRecipeFromArray($chef)
    {
       //var_dump($user);
       foreach ($chef as $key => $value) {
 
          $this->$key = $value;
       }
    }

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
     * Get the value of idRecipe
     */
    public function getIdRecipe()
    {
        return $this->idRecipe;
    }

    /**
     * Set the value of idRecipe
     */
    public function setIdRecipe($idRecipe) : self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity($quantity) : self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of recipePosition
     */
    public function getRecipePosition()
    {
        return $this->recipePosition;
    }

    /**
     * Set the value of recipePosition
     */
    public function setRecipePosition($recipePosition) : self
    {
        $this->recipePosition = $recipePosition;

        return $this;
    }

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
    public function getNameProd()
    {
       $model = new ModelProduct();
       $ProductName = $model->readOneBy("idProduct",$this->getIdProduct());
    //  var_dump(  $ProductName->getName());
       return $ProductName;
    }
    public function getNameUnit()
    {
       $model = new ModelUnit();
       $UnitName = $model->readOneBy("idUnit",$this->getIdUnit());
    //  var_dump(  $UnitName."   ".$this->getIdUnit());
       return $UnitName;
    }

}