<?php

namespace App\Controllers\Web;

use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, 'index.html');
    }
}
