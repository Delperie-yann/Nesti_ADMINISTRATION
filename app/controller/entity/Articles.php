<?php

declare(strict_types=1);


/** @var string $val */
/** @var string $price */

class Articles
{
        private $idArticle;
        private $unitQuantity;
        private $flag;
        private $dateCreation;
        private $dateModification;
        private $idImage;
        private $idUnit;
        private $idProduct;
        private $realName;

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
        public function setIdArticle($idArticle): self
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
        public function setUnitQuantity($unitQuantity): self
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
        public function setFlag($flag): self
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
        public function setDateCreation($dateCreation): self
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
        public function setDateModification($dateModification): self
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
        public function setIdImage($idImage): self
        {
                $this->idImage = $idImage;

                return $this;
        }

        /**
         * Get the value of unit
         */

        public function getIdUnit()
        {
                if ($this->idUnit == "UNITE") {
                        $this->idUnit = "";
                }

                return $this->idUnit;
        }

        /**
         * Set the value of unit
         */
        public function setIdUnit($idUnit): self
        {
                $this->idUnit = $idUnit;

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
        public function setIdProduct($idProduct): self
        {
                $this->idProduct = $idProduct;

                return $this;
        }
        /**
         * Get the value of realName
         */
        public function getRealName()
        {
                return $this->realName;
        }

        /**
         * Set the value of realName
         */
        public function setRealName($realName): self
        {
                $this->realName = $realName;

                return $this;
        }

        public function getName()
        {
                $name = new ModelProduct();
                // var_dump($this->idProduct);
                $name1 = $name->readOneBy("idProduct", $this->idProduct);

                // var_dump($name1);
                return  $name1->getName();
        }

        /**
         * getPrice
         *
         * @return bool
         */
        public function getPrice()
        {
                $name = new ModelArticleprice();

                $name2 = $name->readAllBy("idArticle", $this->idArticle);
                // prendre le dernier prix de vente
                $val = 0;
                foreach ($name2 as $price) {
                        if ($price->getPrice() != null) {
                                $val = $price->getPrice();
                        }
                }
                return $val;
        }

        /**
         * setArticleFromArray
         *
         * @param  mixed $recipe
         * @return void
         */
        public function setArticleFromArray($recipe)
        {

                foreach ($recipe as $key => $value) {

                        $this->$key = $value;
                }
        }

        /**
         * getLastimport
         *
         * @return string
         */
        public function getLastimport()
        {


                $name = new ModelImportation();

                $name3 = $name->readOneBy("idArticle", $this->idArticle);
                $lastImport = $name3->getImportationDate();

                return $lastImport;
        }
        
        /**
         * getStock
         *
         * @return string
         */
        public function getStock()
        {
                $name = new ModelLot();
                $name4 = $name->readOneBy("idArticle", $this->idArticle);
                return  $name4->getQuantity();
        }
        
        /**
         * getUnitName
         *
         * @return string
         */
        public function getUnitName()
        {
                $unit = new ModelUnit();
                $unit1 = $unit->readOneBy("idUnit", $this->idUnit);
                $unity = $unit1->getName();
                return  $unity;
        }
        
        /**
         * getType
         *
         * @return string
         */
        public function getType()
        {
                $model = new ModelProduct();
                $data  = $model->findChildType("ingredient", "product", $this->getIdProduct());

                if ($data != Null) {
                        $type = "ingredient";
                } else {
                        $type = "";
                }

                return $type;
        }
        
        /**
         * isIngredient
         *
         * @return bool
         */
        public function isIngredient(): bool
        {

                return $this->getType() != null;
        }
                
        /**
         * getLots
         *
         * @return object
         */
        public function getLots()
        {
                $lot = new ModelLot();
                $lot = $lot->readOneBy("idArticle", $this->getIdArticle());

                return $lot;
        }

        
        /**
         * getFactoryName
         *
         * @return string
         */
        public function getFactoryName()
        {
                $article = new ModelArticles();
                $name = $article->readOneBy("idArticle", $this->getIdArticle());
                $factoryName = $name->getUnitQuantity() . " " . ($name->getUnitName() == 'UNITE' ? '' : $name->getUnitName()) . " " . $name->getName();

                return  $factoryName;
        }
        
        /**
         * getArticleQuantIn
         *
         * @return string
         */
        public function getArticleQuantIn()
        {
                return $this->getLots();
        }
        
        /**
         * getNbBought
         *
         * @return double
         */
        public function getNbBought()
        {
                $totalQuantity = 0;
                foreach ($this->getLots() as $lot) {
                        $totalQuantity += $this->getLots()->getQuantity();
                }
                return $totalQuantity;
        }
        
        /**
         * getArticlePrices
         *
         * @return object
         */
        public function getArticlePrices()
        {
                $model = new ModelArticleprice();

                $articlePrices = $model->readAllBy("idArticle", $this->getIdArticle());
                return $articlePrices;
        }
        
        /**
         * getLastPriceAt
         *
         * @param  mixed $dateMax
         * @return String
         */
        public function getLastPriceAt(String $dateMax): String
        {
                $maxDate = 0;
                $arrayArticlePrice = $this->getArticlePrices();
                $price = 0;
                foreach ($arrayArticlePrice as $value) {
                        $date = strtotime($value->getDateStart());
                        if ($date <= $dateMax) {
                                if ($maxDate <  $date) {
                                        $maxDate =  $date;
                                        $price = $value->getPrice();
                                }
                        }
                }
                return $price;
        }
}
