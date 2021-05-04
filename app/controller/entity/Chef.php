<?php

class Chef extends Users{


 
    private $idChef;

    /**
     * Get the value of idChef
     */
    public function getIdChef()
    {
        return $this->idChef;
    }

    /**
     * Set the value of idChef
     */
    public function setIdChef($idChef) : self
    {
        $this->idChef = $idChef;

        return $this;
    }

    public function getCountRecipe()
    {
        $model= new ModelRecipes();
        $c = $model->readAllBy("idChef",$this->idChef);
        $tot = count($c);
        return $tot;
    }
    public function setChefFromArray($chef)
    {
       //var_dump($user);
       foreach ($chef as $key => $value) {
 
          $this->$key = $value;
       }
    }
    public function getLastRecipe(){
        $model= new ModelRecipes();
        $c = $model->readAllBy("idChef",$this->idChef);
        usort($c, function($a, $b) {
            return strcmp($a->getDateCreation(), $b->getDateCreation());
        });
        $index = sizeof($c)-1;
        $result = '';
        if($index>=0){
            $result = $c[$index]->getName();
        }
        return $result;
    }
    public function getUser() { 
        $model= new ModelUsers();
        return $model->readOneBy("idUsers",$this->idChef);
    }
    public function getAllRecipeFromChef()
    {
       $model = new ModelRecipes();
       $logs = $model->readAllBy("idChef", $this->getIdChef());
       // var_dump($logs);
       return $logs;
    }

}