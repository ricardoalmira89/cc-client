<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

class Inmueble extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("estilos-vida", $authManager);
    }

}