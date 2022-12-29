<?php

declare(strict_types=1);

namespace App\Middleware\Auth;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use App\Model\User;

class UserTokenMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var HttpResponse
     */
    protected $response;

    public function __construct(ContainerInterface $container, HttpResponse $response)
    {
        $this->container = $container;
        $this->response = $response;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (empty($token = $request->getHeader('access-token')) || empty($token[0])) {
            return $this->response->json(
                [
                    'code' => 403,
                    'msg' => '身份验证失败'
                ]
            );
        }
        $user = User::where('token', $token[0])->first();
        if (empty($user)) {
            return $this->response->json(
                [
                    'code' => 403,
                    'msg' => '身份验证失败'
                ]
            );
        }
        $request = $request->withAttribute("user", $user);
        
        return $handler->handle($request);
    }
}