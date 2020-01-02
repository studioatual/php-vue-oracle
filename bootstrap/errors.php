<?php

use Psr\Http\Message\ServerRequestInterface;

$app->addRoutingMiddleware();

$customErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetais
    ) use ($app) {
        $container = $app->getContainer();
        $response = $app->getResponseFactory()->createResponse();

        if ($exception->getCode() == 404) {
            return $container->get('view')->render($response, '404.html', [
                    'title' => 'Error 404',
                    'text' => 'Page Not Found!'
                ]);
        }

        return $container->get('view')->render($response, '500.html', [
                'title' => 'Php Error',
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]);
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
