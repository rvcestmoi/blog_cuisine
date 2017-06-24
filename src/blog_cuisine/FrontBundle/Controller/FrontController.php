<?php

namespace blog_cuisine\FrontBundle\Controller;

use blog_cuisine\BackBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller {

    public function homePageAction() {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository("blog_cuisineBackBundle:Article");
        $articles = $rep->rechercherDernier(9)->getResult();
        //var_dump($articles);
        return $this->render('blog_cuisineFrontBundle:Front:home.html.twig', array(
                    'articles' => $articles
        ));
    }

    public function rechercheAction($recherche) {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository("blog_cuisineBackBundle:Article");
        $rec = $em->getRepository("blog_cuisineBackBundle:Recette");
        //Récuperation du get de la barre de navigation
        $request = Request::createFromGlobals()->query->get('recherche');
        //$recherche = Request::createFromGlobals();
        //$recherche->query->get('recherche');
        //var_dump($request);
        $recettes = $rec->rechercherBarre(10, $request);
        $articles = $rep->rechercherBarre(10, $request);


        return $this->render('blog_cuisineFrontBundle:Front:recherche.html.twig', array(
                    'articles' => $articles,
                    'recettes' => $recettes
        ));
    }

    public function afficherThemeAction($id) {
        $em = $this->getDoctrine()->getManager();
        //$rep2 =$rep = $em->getRepository("blog_cuisineBackBundle:Theme")->find(7);
        $rep = $em->getRepository("blog_cuisineBackBundle:Article");

        // $articles = $rep->findBy(array('theme'=> array('id'=>$id)));
        $articles = $rep->rechercherTheme(10, $id)->getResult();
        //var_dump($articles);
        return $this->render('blog_cuisineFrontBundle:Front:theme.html.twig', array(
                    'articles' => $articles
        ));
    }

//$questionsTirees = $em->getRepository('QCMBackBundle:QuestionTirage')->findBy(array('sessions' => array(
    //              'id' => $session)));

    public function afficherArticleAction($id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository("blog_cuisineBackBundle:Article")->find($id);
        $ingredients = $em->getRepository("blog_cuisineBackBundle:RecetteIngredients")->rechercherIngredients($article->getRecette())->getResult();
        $recette = $article->getREcette();

        $calorie = $this->calculerCalorie($ingredients);
        $proteine = $this->calculerProteine($ingredients);
        $glucide = $this->calculerGlucide($ingredients);
        $lipide = $this->calculerLipide($ingredients);
        $sel = $this->calculerSel($ingredients);
        $nutrition = ['calorie' => $calorie, 'proteine' => $proteine, 'glucide' => $glucide, 'sel' => $sel, 'lipide' => $lipide];
        //partie creation d'un commentaire
        $commentaire = new Commentaire;

        $form = $this->commentaireForm($commentaire)->getForm();

        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $commentaire->setDateAjout(new \DateTime);
            $commentaire->setArticle($article);
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('article', array('id' => $id));
        }
        // var_dump($ingredients);
        if (empty($ingredients)) {
            $info = 'article';
        } else {
            $info = 'recette';
        }
        //var_dump($ingredients);
        if ($info == 'recette') {
            return $this->render('blog_cuisineFrontBundle:Front:recette.html.twig', array(
                        'article' => $article,
                        'recette' => $recette,
                        'ingredients' => $ingredients,
                        'nutrition' => $nutrition,
                        'form' => $form->createView()
            ));
        } else
            return $this->render('blog_cuisineFrontBundle:Front:article.html.twig', array(
                        'article' => $article,
            ));
    }

    public function calculerCalorie($ingredients) {
        $calorieIngredients = 0.0;
        $masseTotal = 0.0;
        foreach ($ingredients as $ingredient) {
            if ($ingredient->getIngredients()->getUnite() !== 'portion') {
                $calorieIngredients += ($ingredient->getIngredients()->getCalorie()) / 100 * ($ingredient->getQuantite());
                $masseTotal += $ingredient->getQuantite();
            } else {
                $calorieIngredients += ($ingredient->getIngredients()->getCalorie()) * ($ingredient->getQuantite()) * $ingredient->getIngredients()->getDefaut() / 100;
                $masseTotal += ($ingredient->getQuantite()) * ($ingredient->getIngredients()->getDefaut());
                //var_dump($masseTotal);
            }
        }
        if ($masseTotal == 0) {
            $calorie = "";
        } else {
            $calorie = intval($calorieIngredients * 100 / $masseTotal);
            // var_dump($calorie);
        }
        return $calorie;
    }

    public function calculerProteine($ingredients) {
        $proteineIngredients = 0.0;
        $masseTotal = 0.0;
        foreach ($ingredients as $ingredient) {
            if ($ingredient->getIngredients()->getUnite() !== 'portion') {
                $proteineIngredients += ($ingredient->getIngredients()->getProteine()) / 100 * ($ingredient->getQuantite());
                $masseTotal += $ingredient->getQuantite();
            } else {
                $proteineIngredients += ($ingredient->getIngredients()->getProteine()) * ($ingredient->getQuantite()) * $ingredient->getIngredients()->getDefaut() / 100;
                $masseTotal += ($ingredient->getQuantite()) * ($ingredient->getIngredients()->getDefaut());
            }
        }
        if ($masseTotal == 0) {
            $proteine = "";
        } else {
            $proteine = intval($proteineIngredients * 100 / $masseTotal);
        }

        return $proteine;
    }

    public function calculerGlucide($ingredients) {
        $glucideIngredients = 0.0;
        $masseTotal = 0.0;
        foreach ($ingredients as $ingredient) {
            if ($ingredient->getIngredients()->getUnite() !== 'portion') {
                $glucideIngredients += ($ingredient->getIngredients()->getGlucide()) / 100 * ($ingredient->getQuantite());
                $masseTotal += $ingredient->getQuantite();
            } else {
                $glucideIngredients += ($ingredient->getIngredients()->getGlucide()) * ($ingredient->getQuantite()) * $ingredient->getIngredients()->getDefaut() / 100;
                $masseTotal += ($ingredient->getQuantite()) * ($ingredient->getIngredients()->getDefaut());
            }
        }
        if ($masseTotal == 0) {
            $glucide = "";
        } else {
            $glucide = intval($glucideIngredients * 100 / $masseTotal);
        }

        return $glucide;
    }

    public function calculerLipide($ingredients) {
        $lipideIngredients = 0.0;
        $masseTotal = 0.0;
        foreach ($ingredients as $ingredient) {
            if ($ingredient->getIngredients()->getUnite() !== 'portion') {
                $lipideIngredients += ($ingredient->getIngredients()->getLipide()) / 100 * ($ingredient->getQuantite());
                $masseTotal += $ingredient->getQuantite();
            } else {
                $lipideIngredients += ($ingredient->getIngredients()->getLipide()) * ($ingredient->getQuantite()) * $ingredient->getIngredients()->getDefaut() / 100;
                $masseTotal += ($ingredient->getQuantite()) * ($ingredient->getIngredients()->getDefaut());
            }
        }
        if ($masseTotal == 0) {
            $lipide = "";
        } else {
            $lipide = intval($lipideIngredients * 100 / $masseTotal);
        }
        return $lipide;
    }

    public function calculerSel($ingredients) {
        $selIngredients = 0.0;
        $masseTotal = 0.0;
        foreach ($ingredients as $ingredient) {
            if ($ingredient->getIngredients()->getUnite() !== 'portion') {
                $selIngredients += ($ingredient->getIngredients()->getSel()) / 100 * ($ingredient->getQuantite());
                $masseTotal += $ingredient->getQuantite();
            } else {
                $selIngredients += ($ingredient->getIngredients()->getSel()) * ($ingredient->getQuantite()) * $ingredient->getIngredients()->getDefaut() / 100;
                $masseTotal += ($ingredient->getQuantite()) * ($ingredient->getIngredients()->getDefaut());
            }
        }
        if ($masseTotal == 0) {
            $sel = "";
        } else {
            $sel = intval($selIngredients * 100 / $masseTotal);
        }
        return $sel;
    }

    public function commentaireForm($commentaire) {
        return $form = $this->createFormBuilder($commentaire)
                ->add('nom', 'text', array('label' => 'Votre Nom: '))
                ->add('commentaire', 'textarea', array('label' => 'Votre Commentaire: '))
                ->add("valider", "submit");
    }

    public function contactAction() {
        
    }

}
