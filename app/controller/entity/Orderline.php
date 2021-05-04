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
    public function getQuantitybyOrder()
    { // Surement à deplacer dans Article....et a modifier
        $model = new ModelOrderline();
        $quant = $model->readAllBy("idOrders", $this->getIdOrders());
        
        $fullquant=$this->getQuantity();

        return $fullquant;
    }
  
    public function setOrderlineFromArray($orderLine)
    {
       foreach ($orderLine as $key => $value) {
 
          $this->$key = $value;
       }
    }

    public function getArticle()
   {
      $model = new ModelArticles();
      $article = $model->readOneBy("idArticle", $this->getIdArticle());
     
      return $article;
   }
}