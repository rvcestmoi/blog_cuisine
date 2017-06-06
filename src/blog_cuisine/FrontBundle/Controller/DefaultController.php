<?php

namespace blog_cuisine\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('blog_cuisineFrontBundle:Default:index.html.twig');
    }
}
