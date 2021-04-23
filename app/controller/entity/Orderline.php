<?php

class Orderline
{
    private $idOrders;
    private $idArticle;
    private $quantity;



    /**
     * Get the value of idOrders
     */
    public function getIdOrders()
    {
        return $this->idOrders;
    }

    /**
     * Set the value of idOrders
     */
    public function setIdOrders($idOrders) : self
    {
        $this->idOrders = $idOrders;

        return $this;
    }

    /**
     * Get the value of idArticle
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set the value of idArticle
     */
    public function setIdArticle($idArticle) : self
    {
        $this->idArticle = $idArticle;

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

  
}