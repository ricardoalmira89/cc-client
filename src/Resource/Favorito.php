<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

class Favorito extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("favoritos", $authManager);
    }

}