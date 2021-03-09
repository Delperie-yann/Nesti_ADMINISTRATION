<?php


class Recipes

{
    private $idRecipe;
    private $dateCreation;
    private $name;
    private $difficulty;
    private $portions;
    private $flag;
    private $preparationTime;
    private $idChef;
    private $image;
   
    

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of difficulty
     */ 
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set the value of difficulty
     *
     * @return  self
     */ 
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get the value of for
     */ 
    public function getPortions()
    {
        return $this->portions;
    }

    /**
     * Set the value of for
     *
     * @return  self
     */ 
    public function setPortions($portions)
    {
        $this->portions = $portions;

        return $this;
    }

   
    /**
     * Get the value of chief
     */ 
    public function getChef()
    {
        $model= New ModelUsers();
        $chef= $model->readOneBy("idUsers",$this->getIdChef());
        return $chef->getLastname();
    }

    public function setUserFromArray($recipe)
    {
    
     foreach ($recipe as $key => $value) {
   
      $this->$key = $value;
   
     }
    }
   
/*---------------------------------------------------------------*/
/*
    Titre : Convertie de secondes en heures, minutes et secondes                                                          
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=939
    Date édition     : 15 Fév 2019                                                                                        
    Date mise à jour : 19 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/

     function ConvertisseurTime($Time){
     if($Time < 3600){ 
       $heures = 0; 
       
       if($Time < 60){$minutes = 0;} 
       else{$minutes = round($Time / 60);} 
       
       $secondes = floor($Time % 60); 
       } 
       else{ 
       $heures = round($Time / 3600); 
       $secondes = round($Time % 3600); 
       $minutes = floor($secondes / 60); 
       } 
       
       $secondes2 = round($secondes % 60); 
      
       $TimeFinal = "$heures h $minutes min $secondes2 s"; 
       return $TimeFinal; 
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
    public function setFlag($flag) : self
    {
        $this->flag = $flag;

        return $this;
    }

    

    /**
     * Get the value of preparationTime
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * Set the value of preparationTime
     *
     * @return self
     */
    public function setPreparationTime($preparationTime) : self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get the value of idChef
     */
    public function getIdChef()
    {
        return $this->idChef;
    }

    /**
     * Set the value of idChef
     *
     * @return self
     */
    public function setIdChef($idChef) : self
    {
        $this->idChef = $idChef;

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
     *
     * @return self
     */
    public function setIdRecipe($idRecipe) : self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }
}