<?php


    class Articles{
        private $idArticle;
        private $unitQuantity;
        private $flag;
        private $dateCreation;
        private $dateModification;
        private $idImage;
        private $unit;
        private $idProduct;

      
  

    
       
    
    

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
         * Get the value of unitQuantity
         */
        public function getUnitQuantity()
        {
                return $this->unitQuantity;
        }

        /**
         * Set the value of unitQuantity
         */
        public function setUnitQuantity($unitQuantity) : self
        {
                $this->unitQuantity = $unitQuantity;

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
        public function setFlag($flag) : self
        {
                $this->flag = $flag;

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
        public function setDateCreation($dateCreation) : self
        {
                $this->dateCreation = $dateCreation;

                return $this;
        }

        /**
         * Get the value of dateModification
         */
        public function getDateModification()
        {
                return $this->dateModification;
        }

        /**
         * Set the value of dateModification
         */
        public function setDateModification($dateModification) : self
        {
                $this->dateModification = $dateModification;

                return $this;
        }

        /**
         * Get the value of idImage
         */
        public function getIdImage()
        {
                return $this->idImage;
        }

        /**
         * Set the value of idImage
         */
        public function setIdImage($idImage) : self
        {
                $this->idImage = $idImage;

                return $this;
        }

        /**
         * Get the value of unit
         */
        
        public function getUnit()
        {   
            if($unit="UNITE"){
            $this->unit="";
        }

            return $this->unit;
        }

        /**
         * Set the value of unit
         */
        public function setUnit($unit) : self
        {
                $this->unit = $unit;

                return $this;
        }

        /**
         * Get the value of idProduct
         */
        public function getIdProduct()
        {
                return $this->idProduct;
        }

        /**
         * Set the value of idProduct
         */
        public function setIdProduct($idProduct) : self
        {
                $this->idProduct = $idProduct;

                return $this;
        }

        public function getName(){
            $name = new ModelProduct();
            // var_dump($this->idProduct);
         $name1= $name->readOneBy("idProduct",$this->idProduct);
          
            // var_dump($name1);
            return  $name1->getName();
        }

        public function getPrice(){
            $name = new ModelArticleprice();
            // var_dump($this->idProduct);
         $name2= $name->readOneBy("idArticle",$this->idArticle);
          ///----------->>>>prendre la dateStrat max
            // var_dump($name2);
            return  $name2->getPrice();
        }
        
        public function setArticleFromArray($recipe)
        {
    
            foreach ($recipe as $key => $value) {
    
                $this->$key = $value;
            }
        }

        public function getLastimport(){
            $name = new ModelImportation();
            // var_dump($this->idProduct);
         $name3= $name->readOneBy("idArticle",$this->idArticle);
          
            // var_dump($name3->getImportationDate());
            return  $name3->getImportationDate();
        }

        public function getStock(){
            $name = new ModelLot();
            // var_dump($this->idProduct);
         $name4= $name->readOneBy("idArticle",$this->idArticle);
          
            // var_dump($name4->getquantity());
            return  $name4->getQuantity();
        }
        public function getUnitName(){
            $unit = new ModelUnit();
            // var_dump($this->idProduct);
         $unit1= $unit->readOneBy("idUnit",$this->idUnit);
         $unity=$unit1->getName();
        //  var_dump($unity);
         
        
            // var_dump($unit1->getName());
            return  $unity;
        }
        }



