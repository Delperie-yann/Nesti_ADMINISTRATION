<?php

class Moderator{

    private $idModerator;

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
    public function setIdModerator($idModerator) : self
    {
        $this->idModerator = $idModerator;

        return $this;
    }
}