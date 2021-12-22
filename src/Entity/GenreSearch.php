<?php

namespace App\Entity;




use Doctrine\Common\Collections\ArrayCollection;

class GenreSearch
{
    /**
     * @var ArrayCollection|null
     */
    private $nom;

    public function _construct(){
        $this ->nom = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|null
     */
    public function getNom(): ?ArrayCollection
    {
        return $this->nom;
    }

    /**
     * @param ArrayCollection|null $nom
     * @return GenreSearch
     */
    public function setNom(ArrayCollection $nom): GenreSearch
    {
        $this->nom = $nom;
        return $this;
    }



}
