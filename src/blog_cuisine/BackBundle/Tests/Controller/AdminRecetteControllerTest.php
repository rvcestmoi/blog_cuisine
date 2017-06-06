<?php

namespace blog_cuisine\BackBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminRecetteControllerTest extends WebTestCase
{
    public function testListerrecette()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Recette');
    }

    public function testModifierrecette()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifierRecette');
    }

}
