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
        $multipart[] = ['name' => 'espacio_fisico', 'contents' => AlmArray::get($data, 'espacio_fisico')];
        $multipart[] = ['name' => 'migrar_s3', 'contents' => AlmArray::get($data, 'migrar_s3', 0) ];

        return $multipart;
    }

    /**
     * Sube la imagen a s3 si se especifica 'migrar_s3=1', pero ademas la almacena
     * en db como un recurso inm_media.
     *
     * @param array $data
     * @return mixed
     */
    public function create($data = []){
        $options = [];

        $options['multipart'] = $this->buildMultipart($data);
        $this->authorizeRequest($options);

        $res = $this->client->post($this->endpoint."/", $options);
        return json_decode($res->getBody()->getContents());
    }

    /**
     * Sube la imagen soloa s3, no la almacena en db
     * @param array $data
     * @return mixed
     */
    public function creates3($data = []){
        $options = [];

        $options['multipart'] = $this->buildMultipart($data);
        $this->authorizeRequest($options);

        $res = $this->client->post($this->endpoint."/s3", $options);
        return json_decode($res->getBody()->getContents());
    }
}