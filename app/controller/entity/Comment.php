<?php

class Comment
{
    private $idRecipe;
    private $idUsers;
    private $commentTitle;
    private $commentContent;
    private $dateCreation;
    private $flag;
    private $idModerator;

    /**
     * Get the Name of this recipe
     */
    public function getNameRecipe($idRecipe)
    {
        $model = new ModelRecipes();
        $name = $model->readOneBy("idRecipe", $idRecipe);
        return  $name->getName();
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
    public function setIdRecipe($idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }

    /**
     * Get the value of idUsers
     */
    public function getIdUsers()
    {
        return $this->idUsers;
    }

    /**
     * Set the value of idUsers
     */
    public function setIdUsers($idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    /**
     * Get the value of commentTitle
     */
    public function getCommentTitle()
    {
        return $this->commentTitle;
    }

    /**
     * Set the value of commentTitle
     */
    public function setCommentTitle($commentTitle): self
    {
        $this->commentTitle = $commentTitle;

        return $this;
    }

    /**
     * Get the value of commentContent
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * Set the value of commentContent
     */
    public function setCommentContent($commentContent): self
    {
        $this->commentContent = $commentContent;

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
     */
    public function setFlag($flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get the value of idModerator
     */
    public function getIdModerator()
    {
        return $this->idModerator;
    }

    /**
     * Set the value of idModerator
     */
    public function setIdModerator($idModerator): self
    {
        $this->idModerator = $idModerator;

        return $this;
    }
    
    /**
     * getState
     *
     * @param  mixed $entity
     * @return string
     */
    public function getState($entity)
    {
        if ($entity->getFlag() == "a") {
            $state = "Approuvé";
        } else if ($entity->getFlag() == "b") {
            $state = "Bloqué";
        } else {
            $state = "En attente";
        }
        return $state;
    }    
    /**
     * setCommentFromArray
     *
     * @param  mixed $unit
     * @return void
     */
    public function setCommentFromArray($unit)
    {

        foreach ($unit as $key => $value) {

            $this->$key = $value;
        }
    }
}
