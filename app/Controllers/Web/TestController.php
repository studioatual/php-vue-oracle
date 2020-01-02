<?php

namespace App\Controllers\Web;

use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TestController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $this->mailer->send('emails/test.html', [], function ($message) {
            $message->subject('Test de E-mail');
            $message->from(['test@test.com' => 'test']);
            $message->to(['admin@test.com' => 'admin']);
        });
        $response->getBody()->write('test');
        return $response;
    }
}
