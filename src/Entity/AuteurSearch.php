<?php

namespace App\Entity;

class AuteurSearch{


    /**
     * @var string|null
     */
    private $nomPrenom;

    /**
     * @var string|null
     */
    private $sexe;

    private $dateDeNaissance;

    /**
     * @var string|null
     */
    private $nationalite;



    /**
     * @var int|null
     */
    private $nbLivre;
    /**
     * @return string|null
     */

    /**
     * @return int|null
     */
    public function getNbLivre(): ?int
    {
        return $this->nbLivre;
    }

    /**
     * @param int|null $nbLivre
     * @return AuteurSearch
     */
    public function setNbLivre(?int $nbLivre): AuteurSearch
    {
        $this->nbLivre = $nbLivre;
        return $this;
    }
    public function getNomPrenom(): ?string
    {
        return $this->nomPrenom;
    }

    /**
     * @param string|null $nomPrenom
     * @return AuteurSearch
     */
    public function setNomPrenom(?string $nomPrenom): AuteurSearch
    {
        $this->nomPrenom = $nomPrenom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    /**
     * @param string|null $sexe
     * @return AuteurSearch
     */
    public function setSexe(?string $sexe): AuteurSearch
    {
        $this->sexe = $sexe;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * @param mixed $dateDeNaissance
     * @return AuteurSearch
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    /**
     * @param string|null $nationalite
     * @return AuteurSearch
     */
    public function setNationalite(?string $nationalite): AuteurSearch
    {
        $this->nationalite = $nationalite;
        return $this;
    }


}