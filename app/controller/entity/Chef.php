<?php

class Chef extends Users
{



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
    public function setIdChef($idChef): self
    {
        $this->idChef = $idChef;

        return $this;
    }
    
    /**
     * getCountRecipe
     *
     * @return int
     */
    public function getCountRecipe()
    {
        $model = new ModelRecipes();
        $c = $model->readAllBy("idChef", $this->idChef);
        $tot = count($c);
        return $tot;
    }
        
    /**
     * setChefFromArray
     *
     * @param  mixed $chef
     * @return void
     */
    public function setChefFromArray($chef)
    {
        //var_dump($user);
        foreach ($chef as $key => $value) {

            $this->$key = $value;
        }
    }
        
    /**
     * getLastRecipe
     *
     * @return array
     */
    public function getLastRecipe()
    {
        $model = new ModelRecipes();
        $c = $model->readAllBy("idChef", $this->idChef);
        usort($c, function ($a, $b) {
            return strcmp($a->getDateCreation(), $b->getDateCreation());
        });
        $index = sizeof($c) - 1;
        $result = '';
        if ($index >= 0) {
            $result = $c[$index]->getName();
        }
        return $result;
    }
        
    /**
     * getUser
     *
     * @return object
     */
    public function getUser()
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $this->getIdChef());

        return $user;
    }    
    /**
     * getAllRecipeFromChef
     *
     * @return object
     */
    public function getAllRecipeFromChef()
    {
        $model = new ModelRecipes();

        $logs = $model->readAllBy("idChef", $this->idChef);
     
        return $logs;
    }
}
