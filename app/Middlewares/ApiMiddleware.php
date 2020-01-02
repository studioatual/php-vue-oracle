<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class ApiMiddleware extends Middleware
{
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $response = new Response();

        $params = $request->getServerParams();
        $authorization = isset($params['HTTP_AUTHORIZATION']) ? $params['HTTP_AUTHORIZATION'] : null;

        if (!$authorization) {
            $response->getBody()
                ->write(json_encode([ 'erro' => 'no-authorization' ]));

            return $response->withStatus(401);
        }

        if (!$payload = $this->jwt->checkToken($authorization)) {
            $response->getBody()
                ->write(json_encode([ 'erro' => 'no-authorization' ]));

            return $response->withStatus(401);
        }

        $user = $this->auth->attemptAuthentication([
            'id' => intval($payload->id),
            'email' => $payload->email
        ]);

        if (!$user) {
            $response->getBody()
                ->write(json_encode([ 'erro' => 'no-authorization' ]));

            return $response->withStatus(401);
        }

        $request = $request->withAttribute('user', $user->toArray());

        return $handler->handle($request);
    }
}
