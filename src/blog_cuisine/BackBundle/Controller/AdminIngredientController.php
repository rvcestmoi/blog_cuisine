<?php

namespace blog_cuisine\BackBundle\Controller;

use blog_cuisine\BackBundle\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AdminIngredientController extends Controller {

    public function indexAction() {
        return $this->render('blog_cuisineBackBundle:Admin:index.html.twig', array(
                        // ...
        ));
    }

    public function ListerIngredientAction() {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:Ingredient');
        $ingredients = $rep->findAll();
        return $this->render('blog_cuisineBackBundle:Admin:ingredient_list.html.twig', array(
                    'ingredients' => $ingredients
        ));
    }

    public function ModifierIngredientAction($id) {
        if (is_numeric($id)) {
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('blog_cuisineBackBundle:Ingredient');
            $ingredient = $rep->find($id);

            $form = $this->ingredientForm($ingredient)->getForm();

            $form->handleRequest($this->get('request'));

            if ($form->isValid()) {
                $em->persist($ingredient);
                $em->flush();
                return $this->redirectToRoute('admin_ingredient');
            }
            return $this->render('blog_cuisineBackBundle:Admin:ingredient_modifier.html.twig', array(
                        'form' => $form->createView()
            ));
        }
    }

    public function supprimerIngredientAction($id) {
        if (is_numeric($id)) {
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('blog_cuisineBackBundle:Ingredient');
            $ingredient = $rep->find($id);


            $em->remove($ingredient);
            $em->flush();
            return $this->redirectToRoute('admin_ingredient');
        }
    }

    public function nouveauIngredientAction() {
        $em = $this->getDoctrine()->getManager();
        $ingredient = new Ingredient;


        $form = $this->ingredientForm($ingredient)->getForm();

        $form->handleRequest($this->get('request'));
        if ($form->isValid()) {
            $em->persist($ingredient);
            $em->flush();
            return $this->redirectToRoute('admin_ingredient');
        }

        return $this->render('blog_cuisineBackBundle:Admin:ingredient_modifier.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function ingredientForm($ingredient) {
        $form = $this->createFormBuilder($ingredient)
                ->add("libelle", "text")
                ->add("unite", "choice", array(
                    'choices' => array('portion' => 'portion',
                        'g' => 'g',
                        'ml' => 'ml'
            )))
                ->add("defaut", NumberType::class, array('data' => 100, 'label'=>'Poids par défault'))
                ->add("calorie", NumberType::class)
                ->add("proteine", NumberType::class)
                ->add("glucide", NumberType::class)
                ->add("lipide", NumberType::class)
                ->add("sel", NumberType::class,array('label'=>'Sodium'))
                ->add("valider", "submit");
        return $form;
    }

}
