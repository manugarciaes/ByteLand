<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Restaurant;
use ApiBundle\Interfaces\RestApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantController extends Controller implements RestApi
{
    /**
     * @param Request $request
     * @param $restaurant_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function viewAction ( Request $request, $restaurant_id  ) {

        $response = new JsonResponse();

        try {

            $repository = $this->getDoctrine()
                ->getRepository('ApiBundle:Restaurant');

            if (! $restaurant = $repository->findOneById( $restaurant_id )) {
                throw new Exception();
            }

            $reservations = array();
            foreach ( $restaurant->getReservations() as $reservation ) {
                $reservations[] = array(
                    'date' => $reservation->getDate(),
                    'peoples' => count( $reservation->getCustomers() )
                );
            }

            $response->setStatusCode(Response::HTTP_FOUND);
            $response->setData( array (
                    'message' => 'Restaurant: '.$restaurant_id,
                    'restaurant' => array(
                        'id'        => $restaurant->getId(),
                        'name'      => $restaurant->getName(),
                        'maxPeople' => $restaurant->getMaxPeople(),
                        'reservations' => $reservations
                    ) )
            );

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->setData(array(
                'message' => 'Error: Restaurant not found'
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
            $maxPeople = $request->request->getInt('maxPeople');

            if ( empty ( $name ) OR empty( $maxPeople ) ) {
                throw new \Exception();
            }

            $restaurant = new Restaurant();
            $restaurant->setName( $name );
            $restaurant->setMaxPeople( $maxPeople );

            $em = $this->getDoctrine()->getManager();

            $em->persist( $restaurant );
            $em->flush();

            $response->setStatusCode(Response::HTTP_CREATED);
            $response->setData(array(
                'message' => 'Restaurant created'
            ));

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: restaurant not created',
                'exception' => $exception
            ));
        }


        return $response;

    }

    /**
     * @param Request $request
     * @param $restaurant_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteAction ( Request $request, $restaurant_id ) {

        $response = new JsonResponse();

        try {

            $manager = $this->getDoctrine()->getManager();

            $repository = $manager->getRepository('ApiBundle:Restaurant');

            if ( !$restaurant = $repository->findOneById( $restaurant_id ) ) {
                throw new \Exception();
            }

            $manager->remove( $restaurant );
            $manager->flush();

            $response->setStatusCode(Response::HTTP_ACCEPTED);
            $response->setData(array(
                'message' => 'Customer deleted'
            ));


        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: restaurant not delete'
            ));

        }

        return $response;

    }

    /**
     * @param Request $request
     * @param $restaurant_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function editAction ( Request $request, $restaurant_id ) {

        $response = new JsonResponse();

        try {

            $repository = $this->getDoctrine()
                ->getRepository('ApiBundle:Restaurant');

            if (!$restaurant = $repository->findOneById( $restaurant_id ) ) {
                throw new \Exception();
            }

            $name = $request->request->get('name');

            if ( !empty ( $name ) ) {
                $restaurant->setName( $name );
            }

            $maxPeople = $request->request->get('maxPeople');

            if ( !empty ( $maxPeople ) ) {
                $restaurant->setMaxPeople( $maxPeople );
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist( $restaurant );
            $em->flush();

            $response->setStatusCode(Response::HTTP_CREATED);
            $response->setData(array(
                'message' => 'Restaurant modified'
            ));

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: restaurant not created'
            ));
        }


        return $response;

    }
}
