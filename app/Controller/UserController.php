<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use App\Model\User;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * @Controller()
 */
class UserController extends AbstractController
{

    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

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

        return $this->success($data);
    }

    /**
     * @RequestMapping(path="login", methods="post")
     */
    public function login()
    {
        $param = $this->request->all();

        $validator = $this->validationFactory->make(
            $param,
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'username is required',
                'password.required' => 'password is required',
            ]
        );

        if ($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return $this->fail($errorMessage, 40001, $param);
        }
        $data = User::where('username', $param['username'])->first();
        if (empty($data)) {
            return $this->fail('用户不存在', 40004);
        }
        
        
        return $this->success($data);
    }

}
