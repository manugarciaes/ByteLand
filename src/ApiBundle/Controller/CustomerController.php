<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Customer;
use ApiBundle\Interfaces\RestApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CustomerController
 * @package ApiBundle\Controller
 */
class CustomerController extends Controller implements RestApi
{

    /**
     * @param Request $request
     * @param $customer_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function viewAction ( Request $request, $customer_id  ) {

        $response = new JsonResponse();

        try {

            $repository = $this->getDoctrine()
                ->getRepository('ApiBundle:Customer');

            if (! $customer = $repository->findOneById( $customer_id )) {
                throw new Exception();
            }

            $response->setStatusCode(Response::HTTP_FOUND);
            $response->setData( array (
                'message' => 'Customer: '.$customer_id,
                'customer' => array(
                    'id' => $customer->getId(),
                    'name' => $customer->getName()
                ) )
            );

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->setData(array(
                'message' => 'Error: Customer not found'
            ));

        }

        return $response;

    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function newAction( Request $request ) {

        $response = new JsonResponse();

        try {

            $name = $request->request->get('name');

            if ( empty ( $name ) ) {
                throw new \Exception();
            }

            $customer = new Customer();
            $customer->setName( $name );

            $em = $this->getDoctrine()->getManager();

            $em->persist($customer);
            $em->flush();

            $response->setStatusCode(Response::HTTP_CREATED);
            $response->setData(array(
                'message' => 'Customer created'
            ));

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: customer not created'
            ));
        }


        return $response;

    }

    /**
     * @param Request $request
     * @param $customer_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteAction ( Request $request, $customer_id ) {

        $response = new JsonResponse();

        try {

            $manager = $this->getDoctrine()->getManager();

            $repository = $manager->getRepository('ApiBundle:Customer');

            if ( !$customer = $repository->findOneById( $customer_id )) {
                throw new \Exception();
            }

            $manager->remove( $customer );
            $manager->flush();

            $response->setStatusCode(Response::HTTP_ACCEPTED);
            $response->setData(array(
                'message' => 'Customer deleted'
            ));


        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: customer not delete'
            ));

        }

        return $response;

    }

    /**
     * @param Request $request
     * @param $customer_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function editAction ( Request $request, $customer_id ) {

        $response = new JsonResponse();

        try {

            $repository = $this->getDoctrine()
                ->getRepository('ApiBundle:Customer');

            $name = $request->request->get('name');

            if (! $customer = $repository->findOneById( $customer_id )) {
                throw new \Exception();
            }

            if ( !empty ( $name ) ) {
                $customer->setName( $name );
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($customer);
            $em->flush();

            $response->setStatusCode(Response::HTTP_CREATED);
            $response->setData(array(
                'message' => 'Customer modified'
            ));

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: customer not created'
            ));
        }


        return $response;

    }
}
