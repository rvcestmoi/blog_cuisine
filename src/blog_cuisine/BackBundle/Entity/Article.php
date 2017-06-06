<?php

namespace blog_cuisine\BackBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="blog_cuisine\BackBundle\Repository\ArticleRepository")
 */
class Article
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateAjout", type="datetime", nullable=true)
     */
    private $dateAjout;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="enLigne", type="boolean")
     */
    private $enLigne;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=512)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=10000, nullable=true)
     */
    private $description;

    /**
     * 
     *
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="article")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $commentaires;
    
    /**
     * @ORM\ManyToMany(targetEntity="Theme")
     * @ORM\JoinTable(name="Article_Theme",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="theme_id", referencedColumnName="id")}
     *      )
     */
    private $theme;

    /**
     * 
     *
     * @ORM\OneToOne(targetEntity="Recette")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $recette;
    
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $chemin;

    public function __construct() {
        $this->theme= new ArrayCollection();
        //
        //
        //$this->recette= new ArrayCollection();
    }
    
    

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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Article
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return Article
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set recette
     *
     * @param string $recette
     *
     * @return Article
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
    public function getEnLigne() {
        return $this->enLigne;
    }

    public function getTheme() {
        return $this->theme;
    }

    public function setEnLigne($enLigne) {
        $this->enLigne = $enLigne;
        return $this;
    }

    public function setTheme($theme) {
        $this->theme = $theme;
        return $this;
    }
    public function getChemin() {
        return $this->chemin;
    }

    public function setChemin($chemin) {
        $this->chemin = $chemin;
        return $this;
    }



}

