<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $univers = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $famille = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sous_famille = null;

    #[ORM\Column(length: 40)]
    private ?string $code_article = null;

    #[ORM\Column]
    private ?int $ean = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description_courte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description_longue = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $couleur = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix_vente = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $eco_taxe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getUnivers(): ?string
    {
        return $this->univers;
    }

    public function setUnivers(?string $univers): self
    {
        $this->univers = $univers;

        return $this;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(?string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getSousFamille(): ?string
    {
        return $this->sous_famille;
    }

    public function setSousFamille(?string $sous_famille): self
    {
        $this->sous_famille = $sous_famille;

        return $this;
    }

    public function getCodeArticle(): ?string
    {
        return $this->code_article;
    }

    public function setCodeArticle(string $code_article): self
    {
        $this->code_article = $code_article;

        return $this;
    }

    public function getEan(): ?int
    {
        return $this->ean;
    }

    public function setEan(int $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    public function getDescriptionCourte(): ?string
    {
        return $this->description_courte;
    }

    public function setDescriptionCourte(?string $description_courte): self
    {
        $this->description_courte = $description_courte;

        return $this;
    }

    public function getDescriptionLongue(): ?string
    {
        return $this->description_longue;
    }

    public function setDescriptionLongue(?string $description_longue): self
    {
        $this->description_longue = $description_longue;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPrixVente(): ?int
    {
        return $this->prix_vente;
    }

    public function setPrixVente(?int $prix_vente): self
    {
        $this->prix_vente = $prix_vente;

        return $this;
    }

    public function getEcoTaxe(): ?string
    {
        return $this->eco_taxe;
    }

    public function setEcoTaxe(?string $eco_taxe): self
    {
        $this->eco_taxe = $eco_taxe;

        return $this;
    }
}
