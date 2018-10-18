<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;
use Ciencuadras\Util\AlmArray;

class Media extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("medias", $authManager);
    }

    private function buildMultipart($data){

        if (AlmArray::get($data, 'url'))
            $multipart[] = ['name' => 'url', 'contents' => AlmArray::get($data, 'url')];
        elseif(AlmArray::get($data, 'archivo'))
            $multipart[] = ['name' => 'archivo', 'contents' => fopen(AlmArray::get($data, 'archivo'), 'r')];

        $multipart[] = ['name' => 'id_inmueble', 'contents' => AlmArray::get($data, 'id_inmueble')];
        $multipart[] = ['name' => 'id_espacio_fisico', 'contents' => AlmArray::get($data, 'id_espacio_fisico')];

        /**
         * Por defecto NO se migra a s3
         */
        $multipart[] = ['name' => 'migrar_s3', 'contents' => 0 ];

        return $multipart;
    }

    public function create($data = []){
        $options = [];
        $this->authorizeRequest($options);
        $options['headers']['Content-Type'] = "multipart/form-data";

        //todo: el multipart no funciona bien, buscar como arreglarlo
        $options['multipart'] = $this->buildMultipart($data);
//        dump($options);die();

        $res = $this->client->post($this->endpoint."/", $options);
        return json_decode($res->getBody()->getContents());
    }
}