<?php

namespace ApiBundle\Tests\Controller;

use ApiBundle\Interfaces\RestApi;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/customer', array('id' => '1000', 'name' => 'Juan Garcia'));

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

        $crawler = $client->request('GET', '/customer/1000');

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

        $crawler = $client->request('PUT', '/customer/1000', array('name' => 'Another Name'));

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

        $crawler = $client->request('DELETE', '/customer/1000');

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
