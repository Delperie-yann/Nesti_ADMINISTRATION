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

    /**
     * getState
     *
     * @param  mixed $entity
     * @return string
     */
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
     * getDateCreation
     *
     * @return string
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

    /**
     * orderUserName
     *
     * @return string
     */
    public function orderUserName()
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $this->getIdUsers());
        $fullName = $user->getFirstname() . " " . $user->getLastname();
        return  $fullName;
    }

    /**
     * getCoast
     *
     * @return double
     */
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
    /**
     * getCoastByid
     *
     * @param  mixed $idOrders
     * @return int
     */
    public function getCoastByid($idOrders)
    {
        $quants = 0;
        $model = new ModelOrderline();
        $orderLines = $model->readAllBy("idOrders", $idOrders);
        $date = strtotime($this->getDateCreation());
        foreach ($orderLines as $orderLine) {
            $quants +=  $orderLine->getQuantity() * $orderLine->getArticle()->getLastPriceAt($date);
        }
        return $quants;
    }

    /**
     * getNumberArticles
     *
     * @return int
     */
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
    /**
     * getLastOrder
     *
     * @param  mixed $idUsers
     *
     */
    public function getLastOrder($idUsers)
    {
        $model = new ModelOrders();
        $orderLines = $model->readAllBy("idUsers", $idUsers);


        usort($orderLines, function ($v1, $v2) {
            return $v2->getDateCreation() <=> $v1->getDateCreation();
        });
        $ArrayOrderLines2 = array_slice($orderLines, 0, 1);
        foreach ($ArrayOrderLines2 as $orderlinedate) {
            return $orderlinedate->getDateCreation();
        }
    }
}
