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
    private $idImage;

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
    public function setIdRecipe($idRecipe): self
    {
        $this->idRecipe = $idRecipe;

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
     * Get the value of preparationTime
     */
    public function getPreparationTime()
    {
        $timeFormat= DateTime::createFromFormat('H:i:s',$this->preparationTime)->format('H:i:s');
        return $timeFormat;
    }

    /**
     * Set the value of preparationTime
     *
     * @return self
     */
    public function setPreparationTime($preparationTime): self
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
    public function setIdChef($idChef): self
    {
        $this->idChef = $idChef;

        return $this;
    }

    /**
     * Get the value of chief
     */
    public function getChef()
    {
        $model = new ModelUsers();
        $chef = $model->readOneBy("idUsers", $this->getIdChef());
        $fullName = $chef->getLastname() .' '. $chef->getFirstname(); 
        return $fullName;
    }

    public function setRecipeFromArray($recipe)
    {
        // var_dump($recipe);
        foreach ($recipe as $key => $value) {

            $this->$key = $value;
        }
    }

    /**
     * Get the value of idImage
     */
    public function getIdImage()
    {
        return $this->idImage;
    }

    /**
     * Set the value of idImage
     *
     * @return  self
     */
    public function setIdImage($idImage)
    {
        $this->idImage = $idImage;

        return $this;
    }

    
    /**
     * getIdColor
     *
     * @return string
     */
    function getIdColor()
    {
        $color = "text-dark";

        if ($this->flag == "a") {
            $color = "bg-1";
        }
        if ($this->flag == "b") {
            $color = "bg-2";
        }
        return $color;
    }
    
    /**
     * getImages
     *
     * @return object
     */
    public function getImages()
    {
        $model = new ModelImages();
        $images = $model->readOneBy("idImage", $this->getIdImage());
        return $images;
    }
    
    /**
     * displayImages
     *
     * @return string
     */
    public function displayImages()
    {
        $imageName = $this->getImages()->getName();
        $imageExtension = $this->getImages()->getFileExtension();
        return BASE_URL . "public/img/recipes/$imageName.$imageExtension";
    }
    
    /**
     * getParagraphs
     *
     * @return object
     */
    public function getParagraphs()
    {
        $model = new ModelParagraph();
        $paragraphs = $model->readAllBy("idRecipe", $this->getIdRecipe());
        return $paragraphs;
    }
        
    /**
     * getRatting
     *
     * @return object
     */
    public function getRatting()
    {
       $model = new ModelRating();
       $logs = $model->readAllBy("idRecipe", $this->getIdRecipe());
    //  var_dump(  $logs);
       return $logs;
    }
   
}
