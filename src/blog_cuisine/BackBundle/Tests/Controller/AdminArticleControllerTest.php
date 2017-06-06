<?php

namespace blog_cuisine\BackBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminArticleControllerTest extends WebTestCase
{
    public function testLister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article');
    }

}
