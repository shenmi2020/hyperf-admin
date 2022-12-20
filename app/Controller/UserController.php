<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use App\Model\User;

/**
 * @Controller()
 */
class UserController extends AbstractController
{

    /**
     * @RequestMapping(path="index", methods="get")
     * 
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $pageIndex = $request->input('pageIndex', 1);
        $pageSize  = $request->input('pageSize', 10);

        $data = User::query()->offset(($pageIndex - 1) * $pageSize)->limit($pageSize)->orderBy('id', 'desc')->get();
        // $param = $this->request->all();

        return $this->success('fail', $data);
    }
}
