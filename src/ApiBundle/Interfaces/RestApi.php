<?php
/**
 * Created by PhpStorm.
 * User: manugarcia
 * Date: 23/4/15
 * Time: 19:04
 */

namespace ApiBundle\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface RestApi {

    public function viewAction ( Request $request,  $id );
    public function newAction ( Request $request);
    public function deleteAction ( Request $request, $id );
    public function editAction ( Request $request, $id );
} 