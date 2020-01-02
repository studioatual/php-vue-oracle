<?php

namespace App\Controllers\Api;

use PDO;
use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $result = $request->getAttribute('user');

        $result['token'] = $this->jwt->generateToken([
            'id' => $result['id'],
            'email' => $result['email'],
        ]);

        $response->getBody()
            ->write(json_encode($result));

        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    public function getLogin(Request $request, Response $response)
    {
        $params = $request->getParsedBody();

        $validation = $this->validateParams($params);

        if ($validation->failed()) {
            $response->getBody()
                ->write(json_encode($validation->getErrors()));
            return $response->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }

        $user = $this->auth->attemptAuthentication($params);
        if (!$user) {
            $response->getBody()
                ->write(json_encode(['message' => 'Usuário ou Senha Inválido!']));
            return $response->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }

        $result = $user->toArray();
        $result['token'] = $this->jwt->generateToken([
            'id' => $result['id'],
            'email' => $result['email'],
        ]);

        $response->getBody()
            ->write(json_encode($result));
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    private function validateParams($params)
    {
        $rules = [
            'username' => v::notEmpty()->setName('Usuário'),
            'password' => v::notEmpty()->setName('Senha'),
        ];

        return $this->validator->validate($params, $rules);
    }
}
