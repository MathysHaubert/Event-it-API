<?php

namespace App\Controllers\NotFoundController;

use App\Controllers\AbstractController;

class NotFoundController extends AbstractController
{
    public function notFound()
    {
        return json_encode(array("status" => "404"));
    }
}