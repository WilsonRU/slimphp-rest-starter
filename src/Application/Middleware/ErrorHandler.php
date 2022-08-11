<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use DomainException;
use Exception;
use InvalidArgumentException;
use Slim\Http\Request;
use Slim\Http\Response;
use Throwable;

class ErrorHandler
{
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        try {
            $response = $next($request, $response);
        } catch (InvalidArgumentException $e) {
            $response = $response
                ->withStatus(400)
                ->withJson([
                    'status_code' => 400,
                    'type'        => 'InvalidParameter',
                    'messages'    => [$e->getMessage()],
                ]);
        } catch (DomainException $e) {
            $response = $response
                ->withStatus(409)
                ->withJson([
                    'status_code' => 409,
                    'type'        => 'BusinessLogic',
                    'messages'    => [$e->getMessage()],
                ]);
        } catch (Throwable | Exception $e) {
            $response = $response
                ->withStatus(500)
                ->withJson([
                    'status_code' => 500,
                    'type'        => 'InternalError',
                    'message'     => [$e->getMessage()],
                ]);
        }

        return $response;
    }
}
