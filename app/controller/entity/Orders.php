<?php

class Orders
{
    private $idOrders;
    private $flag;
    private $dateCreation;
    private $idUsers;

    /**
     * Get the value of idOrdes
     */
    public function getIdOrders()
    {
        return $this->idOrders;
    }

    /**
     * Set the value of idOrdes
     *
     * @return  self
     */
    public function setIdOrders($idOrders)
    {
        $this->idOrders = $idOrders;
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
     * @return  self
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
        return $this;
    }

    public function getState($entity)
    {
        if ($entity->getFlag() == "a") {
            $state = "Payé";
        } else if ($entity->getFlag() == "w") {
            $state = "En attente";
        } else {
            $state = "Annulé";
        }
        return $state;
    }

    /**
     * Get the value of dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function getFormatedDate()
    {
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        return utf8_encode(ucwords(strftime(" %d %B %G %Hh%M", strtotime($this->getDateCreation()))));
    }

    /**
     * Set the value of dateCreation
     *
     * @return  self
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
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
     *
     * @return  self
     */
    public function setIdUsers($idUsers)
    {
        $this->idUsers = $idUsers;
        return $this;
    }

    public function orderUserName()
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $this->getIdUsers());
        $fullName = $user->getFirstname() . " " . $user->getLastname();
        return  $fullName;
    }

    public function getCoast()
    {
        $quants = 0;
        $model = new ModelOrderline();
        $orderLines = $model->readAllBy("idOrders", $this->getIdOrders());
        $date = strtotime($this->getDateCreation());
        foreach ($orderLines as $orderLine) {
            $quants +=  $orderLine->getQuantity() * $orderLine->getArticle()->getLastPriceAt($date);
        }
        return $quants;
    }

    public function getNumberArticles()
    {
        $quants = 0;
        $model = new ModelOrderline();
        $orderLines = $model->readAllBy("idOrders", $this->getIdOrders());
        foreach ($orderLines as $orderLine) {
            $quants +=  $orderLine->getQuantity();
        }
        return $quants;
    }
}
