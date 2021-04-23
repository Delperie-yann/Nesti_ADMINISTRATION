<?php

class Importation
{
private $idAministrator;
private $idArticle;
private $idSupplierOrder;
private $importationDate;






/**
 * Get the value of idAministrator
 */
public function getIdAministrator()
{
return $this->idAministrator;
}

/**
 * Set the value of idAministrator
 */
public function setIdAministrator($idAministrator) : self
{
$this->idAministrator = $idAministrator;

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
 * Get the value of idSupplierOrder
 */
public function getIdSupplierOrder()
{
return $this->idSupplierOrder;
}

/**
 * Set the value of idSupplierOrder
 */
public function setIdSupplierOrder($idSupplierOrder) : self
{
$this->idSupplierOrder = $idSupplierOrder;

return $this;
}

/**
 * Get the value of importationDate
 */
public function getImportationDate()
{
return $this->importationDate;
}

/**
 * Set the value of importationDate
 */
public function setImportationDate($importationDate) : self
{
$this->importationDate = $importationDate;

return $this;
}

public function setImportationFromArray($importation)
        {
    
            foreach ($importation as $key => $value) {
    
                $this->$key = $value;
            }
        }

}