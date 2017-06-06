<?php

namespace blog_cuisine\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="blog_cuisine\BackBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=512, nullable=true)
     */
    private $nom;
    

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=512, nullable=true)
     */
    private $commentaire;
    
    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="commentaires" )
     * @ORM\JoinColumn(onDelete="CASCADE")
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Commentaire
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    public function getNom() {
        return $this->nom;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setArticle($article) {
        $this->article = $article;
        return $this;
    }


}

