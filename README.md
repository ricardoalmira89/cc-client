Ciencuadras / Rest Client
===========================

License
===========================
This library is released under the [MIT license](LICENSE).

Instalacion
===========================
composer require "ciencuadras/rest-client @dev"

Uso
===========================
<?php

use Ciencuadras\Client;
require_once 'vendor/autoload.php';

$parameters = array(
    'api' => "http://api-rest.ciencuadras.com",
    'client_id' => "your client id",
    'client_secret' => "your client secret",
    'username' => "your username",
    'password' => "your password"
);

$client = new Client($parameters);

// Obtener un listado de inmuebles
$response = $client->get('inmueble')->index();
