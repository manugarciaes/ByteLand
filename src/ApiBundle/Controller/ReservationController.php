<?php

namespace ApiBundle\Controller;

use ApiBundle\DependencyInjection\DateTime;
use ApiBundle\Entity\Reservation;
use ApiBundle\Interfaces\RestApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller implements RestApi
{
    /**
     * @param Request $request
     * @param $reservation_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function viewAction ( Request $request, $reservation_id  ) {

        $response = new JsonResponse();

        try {

            $repository = $this->getDoctrine()
                ->getRepository('ApiBundle:Reservation');

            if (! $reservation = $repository->findOneById( $reservation_id )) {
                throw new Exception();
            }

            $response->setStatusCode(Response::HTTP_FOUND);
            $response->setData( array (
                    'message' => 'Reservation: '.$reservation_id,
                    'reservation' => array(
                        'id'        => $reservation->getId(),
                        'date'      => $reservation->getDate()
                    ) )
            );

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->setData(array(
                'message' => 'Error: Reservation not found'
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


        //try {

            $customerId = $request->request->getInt('customerId');
            $restaurantId = $request->request->get('restaurantId');
            $date = $request->request->get('date');

            $date = new DateTime( $date );

            if ( empty ( $restaurantId ) OR empty( $customerId ) ) {
                throw new \Exception();
            }

            $reservation = new Reservation();

            $reservation->setCustomerId( $customerId );
            $reservation->setDate( $date );
            $reservation->setRestaurantId( $restaurantId );

            $em = $this->getDoctrine()->getManager();

            $em->persist( $reservation );
            $em->flush();

            $response->setStatusCode(Response::HTTP_CREATED);
            $response->setData(array(
                'message' => 'Reservation created '.$date
            ));

        /*} catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: reservation not created',
                'exception' => $exception
            ));
        }*/


        return $response;

    }

    /**
     * @param Request $request
     * @param $reservation_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteAction ( Request $request, $reservation_id ) {

        $response = new JsonResponse();

        try {

            $manager = $this->getDoctrine()->getManager();

            $repository = $manager->getRepository('ApiBundle:Restaurant');

            if ( !$reservation = $repository->findOneById( $reservation_id ) ) {
                throw new \Exception();
            }

            $manager->remove( $reservation_id );
            $manager->flush();

            $response->setStatusCode(Response::HTTP_ACCEPTED);
            $response->setData(array(
                'message' => 'Reservation deleted'
            ));


        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: reservation not delete'
            ));

        }

        return $response;

    }

    /**
     * @param Request $request
     * @param $reservation_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function editAction ( Request $request, $reservation_id ) {

        $response = new JsonResponse();

        try {

            $repository = $this->getDoctrine()
                ->getRepository('ApiBundle:Restaurant');

            if (!$reservation = $repository->findOneById( $reservation_id ) ) {
                throw new \Exception();
            }

            $date = $request->request->get('date');

            if ( !empty ( $name ) ) {
                $reservation->setDate( $date );
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist( $reservation );
            $em->flush();

            $response->setStatusCode(Response::HTTP_CREATED);
            $response->setData(array(
                'message' => 'Reservation modified'
            ));

        } catch ( \Exception $exception ) {

            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData(array(
                'message' => 'Error: reservation not modified'
            ));
        }


        return $response;

    }
}
