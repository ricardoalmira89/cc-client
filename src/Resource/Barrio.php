<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

/**
 * Created by PhpStorm.
 * User: ralmira
 * Date: 8/10/2018
 * Time: 8:38 AM
 */
class Barrio extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("barrios", $authManager);
    }

    /**
     * Mueve inmuebles de un barrio a otro.
     *
     * @param $id_barrio_destino
     * @param $inmobiliarias
     * @return mixed
     */
    public function moverImuebles($id_barrio_destino, $inmobiliarias){

        $options = [];
        $this->authorizeRequest($options);
        $options['headers']['Content-Type'] = "application/json";
        $options['body'] = json_encode(['inmuebles' => $inmobiliarias]);

        $res = $this->client->put($this->endpoint."/".$id_barrio_destino."/inmuebles", $options);
        return json_decode($res->getBody()->getContents());

    }

}