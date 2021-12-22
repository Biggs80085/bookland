<?php

namespace App\Entity;

class LivreSearch
{
    /**
     * @var string|null
     */
    private $titre;

    /**
     * @var int|null
     */
    private $nbpages;


    private $dateDeParution;
    private $dateDeParution1;
    /**
     * @var int|null
     */
    private $note;

    private $note1;


    public function getDateDeParution1()
    {
        return $this->dateDeParution1;
    }

    /**
     * @return int|null
     */
    public function getNote1()
    {
        return $this->note1;
    }

    /**
     * @return string|null
     */

    public function getTitre(): ?string
    {
    return $this->titre;
    }

    /**
     * @param string|null $titre
     * @return $this
     */
    public function setTitre(string $titre): self
    {
    $this->titre = $titre;

    return $this;
    }

    /**
     * @return int|null
     */
    public function getNbpages(): ?int
    {
    return $this->nbpages;
    }

    /**
     * @param mixed $dateDeParution1
     * @return LivreSearch
     */
    public function setDateDeParution1($dateDeParution1)
    {
        $this->dateDeParution1 = $dateDeParution1;
        return $this;
    }

    /**
     * @param mixed $note1
     * @return LivreSearch
     */
    public function setNote1($note1)
    {
        $this->note1 = $note1;
        return $this;
    }

    /**
     * @param int|null $nbpages
     * @return $this
     */
    public function setNbpages(int $nbpages): self
    {
    $this->nbpages = $nbpages;

    return $this;
    }

    public function getDateDeParution(): ?\DateTimeInterface
    {
    return $this->dateDeParution;
    }

    public function setDateDeParution($dateDeParution): self
    {
    $this->dateDeParution = $dateDeParution;

    return $this;
    }

    /**
     * @return int|null
     */
    public function getNote(): ?int
    {
    return $this->note;
    }

    /**
     * @param int|null $note
     * @return $this
     */
    public function setNote(int $note): self
    {
    $this->note = $note;

    return $this;
    }
}
