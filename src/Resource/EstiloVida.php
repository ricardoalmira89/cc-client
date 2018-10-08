<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

class EstiloVida extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("estilos-vida", $authManager);
    }

}