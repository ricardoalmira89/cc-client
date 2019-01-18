<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

class InmuebleRelacionado extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("inmuebles-relacionados", $authManager);
    }

}