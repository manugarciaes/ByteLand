<?php

namespace ApiBundle\Tests\Controller;

use ApiBundle\Interfaces\RestApi;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/reservation', array('id'=> '1000', 'name' => 'Juan Garcia'));

        // check json response
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reservation/1000');

        // check json response
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        // Assert that the response status code is 202
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('PUT', '/reservation/1000', array('name' => 'Another Name'));

        // check json response
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('DELETE', '/reservation/1000');

        // check json response
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}
