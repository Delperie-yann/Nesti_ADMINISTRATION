<?php

class Rating
{
    private $idUsers;
    private $idRecipe;
    private $rating;





    
    public function setRatingFromArray($rating)
    {
        // var_dump($recipe);
        foreach ($rating as $key => $value) {

            $this->$key = $value;
        }



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
    public function setIdUsers($idUsers) : self
    {
        $this->idUsers = $idUsers;

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
     * Get the value of rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     */
    public function setRating($rating) : self
    {
        $this->rating = $rating;

        return $this;
    }
}