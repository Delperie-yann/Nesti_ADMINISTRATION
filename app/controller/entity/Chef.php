<?php

class Chef {


 
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
}