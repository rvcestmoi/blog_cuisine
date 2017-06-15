<?php

namespace blog_cuisine\BackBundle\Controller;

use blog_cuisine\BackBundle\Entity\Recette;
use blog_cuisine\BackBundle\Entity\RecetteIngredients;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Response;

class AdminRecetteController extends Controller {

    public function ListerRecetteAction() {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:Recette');
        $recettes = $rep->findAll();
        return $this->render('blog_cuisineBackBundle:Admin:recette_list.html.twig', array(
                    'recettes' => $recettes
        ));
    }


    public function nouveauRecetteAction() {
        // ceci va en faite realiser une nouvelle liste 
        $em = $this->getDoctrine()->getManager();
        $recette = new Recette;


        $form = $this->recetteForm($recette)->getForm();

        $form->handleRequest($this->get('request'));
        if ($form->isValid()) {
            $em->persist($recette);
            $em->flush();
            return $this->redirectToRoute('admin_recette_ajouter', array('id' => $recette->getId()));
        }

        return $this->render('blog_cuisineBackBundle:Admin:recette_nouveau.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function ajouterRecetteAction($id) {
        // no ajoute a une liste sans recette
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository('blog_cuisineBackBundle:Recette')->find($id);
        $liste = new RecetteIngredients;
        $liste->setRecette($recette);


        $listeIngredients = $em->getRepository('blog_cuisineBackBundle:RecetteIngredients')->findBy(
                array('recette' => $id)
        );


        $form = $this->recetteIngredientsForm($liste)->getForm();

        $form->handleRequest($this->get('request'));
        if ($form->isValid()) {

            $em->persist($liste);
            $em->flush();
            return $this->redirectToRoute('admin_recette_ajouter', array('id' => $recette->getId()));
        }

        return $this->render('blog_cuisineBackBundle:Admin:recette_ajouter.html.twig', array(
                    'listeIngredients' => $listeIngredients,
                    'recette' => $recette,
                    'form' => $form->createView()
        ));
    }

    public function supprimerIngredientListeAction($id, $recette) {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:RecetteIngredients');
        $ingredient = $rep->find($id);


        $em->remove($ingredient);
        $em->flush();
        return $this->redirectToRoute('admin_recette_ajouter', array('id' => $recette));
    }

    public function supprimerRecetteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:Recette');
        $recette = $rep->find($id);


        $em->remove($recette);
        $em->flush();
        return $this->redirectToRoute('admin_recette');
        
    }
    public function modifierRecetteAction($id) {
        // ceci va en faite realiser une nouvelle liste 
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository('blog_cuisineBackBundle:Recette')->find($id);


        $form = $this->recetteForm($recette)->getForm();

        $form->handleRequest($this->get('request'));
        if ($form->isValid()) {
            $em->persist($recette);
            $em->flush();
            return $this->redirectToRoute('admin_recette_ajouter', array('id' => $recette->getId()));
        }

        return $this->render('blog_cuisineBackBundle:Admin:recette_nouveau.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function recetteIngredientsForm($liste) {
        $form = $this->createFormBuilder($liste)
                ->add("quantite", NumberType::class,array('label'=>'Quantité'))
                ->add('ingredients', 'entity', array('label'=>'Ingrédients',
                    'class' => 'blog_cuisineBackBundle:Ingredient',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $repository) { 
            return $repository->createQueryBuilder('u')->orderBy('u.libelle', 'ASC');
        },
                    'property' => 'libelle'))
                ->add("ajouter", "submit");
        return $form;
    }

    public function recetteForm($liste) {
        $form = $this->createFormBuilder($liste)
                ->add("titre", "text")
                ->add("recette", "textarea")
                ->add("ajouter", "submit");
        return $form;
    }

}
