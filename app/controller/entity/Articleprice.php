<?php

class Articleprice
{
    private $idArticlePrice;
    private $dateStart;
    private $price;
    private $idArticle;






    /**
     * Get the value of idArticlePrice
     */
    public function getIdArticlePrice()
    {
        return $this->idArticlePrice;
    }

    /**
     * Set the value of idArticlePrice
     */
    public function setIdArticlePrice($idArticlePrice) : self
    {
        $this->idArticlePrice = $idArticlePrice;

        return $this;
    }

    /**
     * Get the value of dateStart
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set the value of dateStart
     */
    public function setDateStart($dateStart) : self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price) : self
    {
        $this->price = $price;

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
    public function setArticlepriceFromArray($recipe)
        {
    
            foreach ($recipe as $key => $value) {
    
                $this->$key = $value;
            }
        }
}