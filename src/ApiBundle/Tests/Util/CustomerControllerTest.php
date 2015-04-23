<?php

namespace ApiBundle\Tests\Util;

use ApiBundle\Controller\CustomerController;
use Symfony\Component\HttpFoundation\Request;

class CustomerControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testview()
    {
        $request = new Request();
        $controller = new CustomerController();

        $customerId = 1;

        $response = $this->getMock("Symfony\Component\HttpFoundation\JsonResponse");

        $this->assertEquals($response, $controller->viewAction( $request, $customerId ));
    }
}
