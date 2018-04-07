<?php

namespace Amira\EventsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BoEventsControllerControllerTest extends WebTestCase
{
    public function testAjouter()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Ajouter');
    }

    public function testModifier()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Modifier');
    }

    public function testListing()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Listing');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Delete');
    }

}
