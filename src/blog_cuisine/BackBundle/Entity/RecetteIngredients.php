<?php

namespace blog_cuisine\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecetteIngredients
 *
 * @ORM\Table(name="recette_ingredients")
 * @ORM\Entity(repositoryClass="blog_cuisine\BackBundle\Repository\RecetteIngredientsRepository")
 */
class RecetteIngredients
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="Recette")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $recette;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $ingredients;
    
    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;
    
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string",length=256, nullable=true)
     */
    private $libelle;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recetteId
     *
     * @param integer $recetteId
     *
     * @return RecetteIngredients
     */
    public function setRecetteId($recetteId)
    {
        $this->recetteId = $recetteId;

        return $this;
    }

    /**
     * Get recetteId
     *
     * @return int
     */
    public function getRecetteId()
    {
        return $this->recetteId;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return RecetteIngredients
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
    public function getRecette() {
        return $this->recette;
    }

    public function getIngredients() {
        return $this->ingredients;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setRecette($recette) {
        $this->recette = $recette;
        return $this;
    }

    public function setIngredients($ingredients) {
        $this->ingredients = $ingredients;
        return $this;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
        return $this;
    }


}

