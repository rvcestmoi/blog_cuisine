<?php

namespace blog_cuisine\BackBundle\Controller;

use blog_cuisine\BackBundle\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('blog_cuisineBackBundle:Admin:index.html.twig', array(
            // ...
        ));
    }
    public function ListerThemeAction()
                        
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:Theme');
        $themes = $rep->findAll();
        return $this->render('blog_cuisineBackBundle:Admin:theme_list.html.twig', array(
            'themes'=>$themes
        ));
    }
    public function ModifierThemeAction($id)
                        
    {
        if (is_numeric($id)){
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:Theme');
        $theme = $rep->find($id);
        
        $form = $this->createFormBuilder($theme)
             ->add("libelle","text")
             ->add("valider","submit")
             ->getForm();   
        
        $form->handleRequest($this->get('request'));
        
        if ($form->isValid()) {
            $em->persist($theme);
            $em->flush();
            return $this->redirectToRoute('admin_theme');
        }
        return $this->render('blog_cuisineBackBundle:Admin:theme_modifier.html.twig', array(
            'theme'=>$theme,
            'form' => $form->createView()    
        ));
        }
    }
    
    public function supprimerThemeAction($id)
                        
    {
        if (is_numeric($id)){
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('blog_cuisineBackBundle:Theme');
        $theme = $rep->find($id);
        
        
            $em->remove($theme);
            $em->flush();
            return $this->redirectToRoute('admin_theme');
        
        
        }
    }
    
    public function nouveauThemeAction(){
        $em = $this->getDoctrine()->getManager();
        $theme = new Theme;
        $form = $this->createFormBuilder($theme)
             ->add("libelle","text")
             ->add("valider","submit")
             ->getForm();   
        
        $form->handleRequest($this->get('request'));
         if ($form->isValid()) {
            $em->persist($theme);
            $em->flush();
             return $this->redirectToRoute('admin_theme');
        }
        
        return $this->render('blog_cuisineBackBundle:Admin:theme_modifier.html.twig', array(
            'theme'=>$theme,
            'form' => $form->createView()    
        ));
        
        
}

}
