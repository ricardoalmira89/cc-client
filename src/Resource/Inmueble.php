<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

class Inmueble extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("inmuebles", $authManager);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function cambiarEstado($id, $data = []){
        $options = [];
        $this->authorizeRequest($options);
        $options['headers']['Content-Type'] = "application/json";
        $options['body'] = json_encode($data);

        $res = $this->client->put($this->endpoint."/".$id."/estado", $options);
        return json_decode($res->getBody()->getContents());
    }

}