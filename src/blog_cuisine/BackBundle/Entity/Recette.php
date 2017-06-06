<?php

namespace blog_cuisine\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass="blog_cuisine\BackBundle\Repository\RecetteRepository")
 */
class Recette
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
     * @var string
     *
     *@ORM\Column(name="recette", type="string", length=255, nullable=true)
     */
    private $recette;
    
    
    /**
     * @var string
     *
     *@ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * 
     *@ORM\ManyToMany(targetEntity="Ingredient")
     * 
     */
    private $ingredients;

    /**
     * 
     *
     * @ORM\OneToOne(targetEntity="Article")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $article;


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
     * Set recette
     *
     * @param string $recette
     *
     * @return Recette
     */
    public function setRecette($recette)
    {
        $this->recette = $recette;

        return $this;
    }

    /**
     * Get recette
     *
     * @return string
     */
    public function getRecette()
    {
        return $this->recette;
    }

    /**
     * Set ingredients
     *
     * @param string $ingredients
     *
     * @return Recette
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * Get ingredients
     *
     * @return string
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set article
     *
     * @param string $article
     *
     * @return Recette
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }
    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }


}

