<?php
/**
 * Created by PhpStorm.
 * User: dvelop
 * Date: 05/10/2016
 * Time: 18:03
 */

namespace Ciencuadras\Util;


/**
 * Helper de manejo de fechas
 * Class AlmDate
 * @package AppBundle\Util
 */
class AlmDate
{

    /**
     * Devuelve una fecha de expiracion a partir de ahora dado una cantidad de segundos
     *
     * @param $timestamp
     * @return \DateTime
     */
    public static function expiresAt($timestamp){
        $expires = new \DateTime('now');
        $expires->modify(sprintf("+%s hours", (($timestamp / 60) / 60 )));

        return $expires;
    }

}