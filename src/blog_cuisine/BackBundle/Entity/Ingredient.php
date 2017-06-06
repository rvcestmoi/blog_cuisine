<?php

namespace blog_cuisine\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table(name="ingredient")
 * @ORM\Entity(repositoryClass="blog_cuisine\BackBundle\Repository\IngredientRepository")
 */
class Ingredient
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
     * @ORM\ManyToMany(targetEntity="Recette")
     * @ORM\JoinTable(name="Ingredient_Recette",
     *      joinColumns={@ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="recette_id", referencedColumnName="id")}
     *      )
     */
    private $recette;
    
    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=256, nullable=true)
     */
    private $unite;
    
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=256, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="calorie", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $calorie;
    
    /**
     * @var string
     *
     * @ORM\Column(name="defaut", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $defaut;

    /**
     * @var string
     *
     * @ORM\Column(name="proteine", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $proteine;
    
    /**
     * @var string
     *
     * @ORM\Column(name="glucide", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $glucide;
    /**
     * @var string
     *
     * @ORM\Column(name="lipide", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $lipide;
    /**
     * @var string
     *
     * @ORM\Column(name="sel", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $sel;
    


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Ingredient
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set calorie
     *
     * @param string $calorie
     *
     * @return Ingredient
     */
    public function setCalorie($calorie)
    {
        $this->calorie = $calorie;

        return $this;
    }

    /**
     * Get calorie
     *
     * @return string
     */
    public function getCalorie()
    {
        return $this->calorie;
    }

    /**
     * Set proteine
     *
     * @param string $proteine
     *
     * @return Ingredient
     */
    public function setProteine($proteine)
    {
        $this->proteine = $proteine;

        return $this;
    }

    /**
     * Get proteine
     *
     * @return string
     */
    public function getProteine()
    {
        return $this->proteine;
    }
    public function getGlucide() {
        return $this->glucide;
    }

    public function getLipide() {
        return $this->lipide;
    }

    public function getSel() {
        return $this->sel;
    }

    public function setGlucide($glucide) {
        $this->glucide = $glucide;
        return $this;
    }

    public function setLipide($lipide) {
        $this->lipide = $lipide;
        return $this;
    }

    public function setSel($sel) {
        $this->sel = $sel;
        return $this;
    }
    public function getRecette() {
        return $this->recette;
    }

    public function getUnite() {
        return $this->unite;
    }

    public function setRecette($recette) {
        $this->recette = $recette;
        return $this;
    }

    public function setUnite($unite) {
        $this->unite = $unite;
        return $this;
    }

    public function getDefaut() {
        return $this->defaut;
    }

    public function setDefaut($defaut) {
        $this->defaut = $defaut;
        return $this;
    }



}

