<?php
/**
 * Created by PhpStorm.
 * User: ralmira
 * Date: 8/10/2018
 * Time: 11:29 AM
 */

namespace Ciencuadras;

use Ciencuadras\Resource\BaseResource;
use Ciencuadras\Resource\DistribucionEspacio;
use Ciencuadras\Resource\EstiloVida;
use Ciencuadras\Util\AlmArray;
use Ciencuadras\Util\AlmValidator;

class Client
{

    public $authManager;
    public $recursos;

    public function __construct($options = [])
    {
        AlmValidator::validate($options, array(
            'api' => 'req'
        ));

        $this->authManager = new AuthManager($options);

        $this->recursos = array(
            'distribucionEspacio' => new DistribucionEspacio($this->authManager),
            'estiloVida' => new EstiloVida($this->authManager)
        );
    }

    /**
     * Obtiene un recurso
     *
     * @param $resourceName
     * @return BaseResource
     */
    public function getRecurso($resourceName){
        return AlmArray::get($this->recursos, $resourceName);
    }

}