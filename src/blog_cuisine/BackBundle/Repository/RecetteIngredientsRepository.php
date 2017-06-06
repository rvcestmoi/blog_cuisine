<?php

namespace blog_cuisine\BackBundle\Repository;

/**
 * RecetteIngredientsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecetteIngredientsRepository extends \Doctrine\ORM\EntityRepository
{
    public function rechercherIngredients($id) {
        
        return $this->createQueryBuilder('i')
                        ->where('i.recette = :recette')
                        ->setParameter('recette', $id)
                        //->addOrderBy('a.dateAjout', "DESC")
                        //->setMaxResults($limit)
                        ->getQuery();
        
    }
}
