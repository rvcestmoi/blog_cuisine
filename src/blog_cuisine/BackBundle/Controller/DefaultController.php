<?php

namespace blog_cuisine\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('blog_cuisineBackBundle:Default:index.html.twig');
    }
}
