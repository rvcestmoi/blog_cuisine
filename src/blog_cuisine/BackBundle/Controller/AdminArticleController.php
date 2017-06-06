<?php

namespace blog_cuisine\BackBundle\Controller;

use blog_cuisine\BackBundle\Entity\Article;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AdminArticleController extends Controller {

    public function listerAction() {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:Article');
        $articles = $rep->findBy(array(), array('dateAjout' => 'DESC'));
        return $this->render('blog_cuisineBackBundle:Admin:article_list.html.twig', array(
                    'articles' => $articles
        ));
    }

    public function supprimerArticleAction($id) {
        if (is_numeric($id)) {
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('blog_cuisineBackBundle:Article');
            $article = $rep->find($id);


            $em->remove($article);
            $em->flush();
            return $this->redirectToRoute('admin_article');
        }
    }

    public function nouveauArticleAction() {

        $em = $this->getDoctrine()->getManager();
        $article = new Article;
        
        $form = $this->articleForm($article)->getForm();
        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $recette = $form->get('recette')->getData();
            $article->setDateAjout(new DateTime);
            $article->setChemin("defaut.png");
            $em->persist($article);

            $em->flush();
            if (!empty($recette)) {
                $recetteArticle = $em->getRepository('blog_cuisineBackBundle:Recette')->find($recette);               
                $recetteArticle->setArticle($article);
                $em->persist($recetteArticle);
                $em->flush();
            }
            return $this->redirectToRoute('admin_article_ajouterImage', array('id' => $article->getId()));
        }
        return $this->render('blog_cuisineBackBundle:Admin:article_nouveau.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function ajouterImageArticleAction($id) {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository("blog_cuisineBackBundle:Article")->find($id);
        $form = $this->articleImageForm()->getForm();
        $form->handleRequest($this->get('request'));
        if ($form->isSubmitted()) {
            // var_dump($form);
            $fichier = $form->get('image')->getdata();
        }

        if ($form->isValid()) {

            $image = $form->get('image')->getData();
            if ($image == NULL) {
                $article->setChemin("defaut.png");
            } else {
                $ext = $image->guessExtension();
                $directory = __DIR__ . '/../../../../web/bundles/blogback/imgRecette/';
                $nomImage = sha1($article->getId()) . "." . $ext;
                $article->setChemin($nomImage);
                $fichier->move($directory, $nomImage);
                $article->setChemin($nomImage);
            }
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('admin_article');
        }

        return $this->render('blog_cuisineBackBundle:Admin:article_ajouterImage.html.twig', array(
                    'form' => $form->createView(),
                    'chemin' => $article->getChemin(),
                    'article' => $article
        ));
    }

    public function modifierArticleAction($id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('blog_cuisineBackBundle:Article')->find($id);

        $form = $this->articleForm($article)->getForm();
        $form->handleRequest($this->get('request'));
        if ($form->isValid()) {
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('admin_article');
        }

        return $this->render('blog_cuisineBackBundle:Admin:article_modifier.html.twig', array(
                    'form' => $form->createView(),
                    'article' => $article
        ));
    }

    public function articleForm($article) {
        $form = $this->createFormBuilder($article)
                ->add("titre", "text")
                ->add("description", "textarea", array('required' => false))
                ->add("enLigne", CheckboxType::class, array(
                    'label' => 'Mettre cet article en ligne?',
                    'required' => false))
                ->add("theme", "entity", array(
                    'class' => 'blog_cuisineBackBundle:Theme',
                    'property' => 'libelle',
                    'multiple' => true
                ))
                ->add("recette", "entity", array(
                    'class' => 'blog_cuisineBackBundle:Recette',
                    'property' => 'titre',
                    'required' => false
                ))
                ->add("valider", "submit");
        return $form;
    }

    public function articleImageForm() {
        $form = $this->createFormBuilder()
                ->add("image", "file", array("required" => false))
                ->add("valider", "submit");
        return $form;
    }

}
