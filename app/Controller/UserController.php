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
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\Middleware;
use App\Middleware\Auth\UserTokenMiddleware;

/**
 * @Controller()
 */
class UserController extends AbstractController
{
    public $user;

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
     * @RequestMapping(path="work", methods="get")
     */
    public function work(RequestInterface $request)
    {
        
        // for ($j=0; $j < 10; $j++) {
        //     $result  = [];
        //     for ($i=0; $i < 10000; $i++) { 
        //         # code...
        //         // $user = new User();
        //         // $user->username = '萧峰'.$i;
        //         // $user->save();
        //         $result[] = [
        //             'username' => md5(mt_rand().mt_rand()),
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s')
        //         ];
        //     }
        //     $user = User::insert($result);
        // }
        $data = User::where('updated_at', '<>', NULL)->orderBy('created_at')->first();
        // $data = User::where('id', 402056)->first();

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
        if (empty($data['token'])) {
            $token = genToken();
            $data->token = $token;
            $data->save();
        }
        $result = [
            'token' => $data->token
        ];
        
        return $this->success($result);
    }

    /**
     * @RequestMapping(path="info", methods="post")
     * @Middlewares({
     *     @Middleware(UserTokenMiddleware::class)
     * })
     */
    public function info()
    {
        $data = [
            $this->request->getAttribute('user')
        ];
        return $this->success($data);
    }



}
