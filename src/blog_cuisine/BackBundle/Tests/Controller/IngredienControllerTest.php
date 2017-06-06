<?php

namespace blog_cuisine\BackBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IngredienControllerTest extends WebTestCase
{
    public function testLister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lister');
    }

}
