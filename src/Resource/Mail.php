<?php

namespace Ciencuadras\Resource;

use Ciencuadras\AuthManager;

class Mail extends BaseResource
{

    public function __construct(AuthManager $authManager)
    {
        parent::__construct("emails", $authManager);
    }

    public function update($id, $data = [])
    {
        throw new \Exception('Not Implemented');
    }

    public function show($id, $options = [])
    {
        throw new \Exception('Not Implemented');
    }

    public function index($options = [])
    {
        throw new \Exception('Not Implemented');
    }

    public function delete($id, $options = [])
    {
        throw new \Exception('Not Implemented');
    }

}