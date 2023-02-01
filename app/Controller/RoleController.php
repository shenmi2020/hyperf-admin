<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Role;
use App\Request\RoleRequest;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * @Controller()
 */
class RoleController extends AbstractController
{

    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    /**
     * @RequestMapping(path="index", methods="get")
     * 角色列表
     */
    public function index(RequestInterface $request)
    {
        $pageIndex = $request->input('pageIndex', 1);
        $pageSize  = $request->input('pageSize', 10);
    
        $data = Role::query()->offset(($pageIndex - 1) * $pageSize)->limit($pageSize)->orderBy('id', 'desc')->get();
        
        return $this->success($data);
    }

    /**
     * 添加角色
     * @RequestMapping(path="add", methods="post")
     */
    public function add()
    {
        $request = $this->container->get(RoleRequest::class);
        $request->scene('add')->validateResolved();
        $param = $request->validated();
       
        $role = new Role();
        $role->name = $param['name'];
        $role->unit_id = $param['unit_id'];
        $role->save();

        return $this->success();
    }

    /**
     * 编辑角色
     * @RequestMapping(path="edit", methods="post")
     */
    public function edit()
    {
        $request = $this->container->get(RoleRequest::class);
        $request->scene('edit')->validateResolved();
        $param = $request->validated();
       
        $role = Role::find($param['id']);
        if (empty($role)) {
            return $this->fail('角色不存在', 40400);
        }
        $role->name = $param['name'];
        $role->unit_id = $param['unit_id'];
        $role->save();

        return $this->success();
    }

    /**
     * 删除角色
     * @RequestMapping(path="delete", methods="post")
     */
    public function delete()
    {
        $request = $this->container->get(RoleRequest::class);
        $request->scene('delete')->validateResolved();
        $param = $request->validated();

        $role = Role::find($param['id']);
        if (empty($role)) {
            return $this->fail('角色不存在', 40400);
        }
        $role->delete();

        return $this->success();
    }

    /**
     * 设置权限
     */
    public function access()
    {

    }

}
