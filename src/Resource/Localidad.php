<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

/**
 * Created by PhpStorm.
 * User: ralmira
 * Date: 8/10/2018
 * Time: 8:38 AM
 */
class Localidad extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("localidades", $authManager);
    }

}