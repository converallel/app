<?php

namespace App\Middleware;

use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * ApiLogging middleware
 */
class ApiLoggingMiddleware
{

    /**
     * Invoke method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Message\ResponseInterface $response The response.
     * @param callable $next Callback to invoke the next middleware.
     * @return \Psr\Http\Message\ResponseInterface A response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $response = $next($request, $response);

        $response_body = $request->getParsedBody() ?: null;
        $data = [
            'user_id' => Configure::read('user_id'),
            'ip_address' => $request->clientIp(),
            'request_method' => $request->getMethod(),
            'request_url' => $request->getRequestTarget(),
            'request_headers' => json_encode($request->getHeaders()),
            'request_body' => is_null($response_body) ? null : json_encode($response_body),
            'status_code' => $response->getStatusCode()
        ];
        $tableLocator = TableRegistry::getTableLocator();
        $apiLogs = $tableLocator->get('ApiLogs');
        $apiLog = $apiLogs->newEntity();
        $apiLog = $apiLogs->patchEntity($apiLog, $data);
        if (!$apiLogs->save($apiLog))
            Log::error('Log could not be saved', $apiLog->getErrors());

        return $response->withType('application/json');
    }
}
