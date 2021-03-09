<?php


    class Articles{
        private $id;
        private $unitQuantity;
        private $flag;
        private $dateCreation;
        private $dateModification;
        private $idImage;
        private $unit;
        private $idProduct;
        private $price;
        private $importationDate;
        private $name;
        private $quantStock;

        public function getId()
        {
            return $this->id;
        }
    
        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;
    
            return $this;
        }


        
        public function getQuantStock()
        {
            return $this->quantStock;
        }
    
        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setQuantStock($quantStock)
        {
            $this->quantStock = $quantStock;
    
            return $this;
        }


        public function getUnit()
        {   if($unit="UNITE"){
            $this->unit="";
        }

            return $this->unit;
        }
    
        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setUnit($unit)
        {
            $this->unit = $unit;
    
            return $this;
        }

        public function getName()
        {
            return $this->name;
        }
    
        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setName($name)
        {
            $this->name = $name;
    
            return $this;
        }
        public function getImportationDate()
        {
            return $this->importationDate;
        }
    
        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setImportationDate($importationDate)
        {
            $this->importationDate = $importationDate;
    
            return $this;
        }
        
        public function getPrice()
        {
            return $this->price;
        }
    
        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
            $this->price = $price;
    
            return $this;
        }
    
        /**
         * Get the value of name
         */ 
        public function getUnitQuantity()
        {
            return $this->unitQuantity;
        }
    
        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setUnitQuantity($unitQuantity)
        {
            $this->unitQuantity = $unitQuantity;
    
            return $this;
    
    }
    
    
}