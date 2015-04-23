<?php
/**
 * Created by PhpStorm.
 * User: manugarcia
 * Date: 23/4/15
 * Time: 22:26
 */

namespace ApiBundle\DependencyInjection;


class DateTime extends \DateTime{

    public function __toString() {
        return $this->format('U');
    }
} 