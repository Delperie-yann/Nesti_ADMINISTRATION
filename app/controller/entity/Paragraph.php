<?php

class Paragraph
{

    private $idParagraph;
    private $content;
    private $paragraphPosition;
    private $dateCreation;
    private $idRecipe;

    /**
     * Get the value of idRecipe
     */
    public function getIdRecipe()
    {
        return $this->idRecipe;
    }

    /**
     * Set the value of idRecipe
     *
     * @return  self
     */
    public function setIdRecipe($idRecipe)
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }

    /**
     * Get the value of idParagraph
     */
    public function getIdParagraph()
    {
        return $this->idParagraph;
    }

    /**
     * Set the value of idParagraph
     *
     * @return  self
     */
    public function setIdParagraph($idParagraph)
    {
        $this->idParagraph = $idParagraph;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of paragraphPosition
     */
    public function getParagraphPosition()
    {
        return $this->paragraphPosition;
    }

    /**
     * Set the value of paragraphPosition
     *
     * @return  self
     */
    public function setParagraphPosition($paragraphPosition)
    {
        $this->paragraphPosition = $paragraphPosition;

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
     *
     * @return  self
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
    
    /**
     * setParagraphFromArray
     *
     * @param  mixed $paragraph
     * @return void
     */
    public function setParagraphFromArray($paragraph)
    {
       
        foreach ($paragraph as $key => $value) {

            $this->$key = $value;
        }
    }
}
