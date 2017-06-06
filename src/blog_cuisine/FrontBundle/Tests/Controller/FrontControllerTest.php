<?php

namespace blog_cuisine\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

}
