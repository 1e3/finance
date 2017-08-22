<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/31/17
 * Time: 3:58 PM
 */

namespace App\Applications\Api\Http\Controllers;

use App\Applications\Api\Http\Requests\RolePermsRequest;
use App\Applications\Api\Http\Requests\RoleRequest;
use App\Domains\Roles\Repositories\RoleRepository;
use App\Domains\Roles\Services\RoleService;

class RoleController extends BaseController
{
    private $service;
    private $repo;
    public function __construct(RoleService $service, RoleRepository $repo)
    {
        $this->service = $service;
        $this->repo = $repo;
    }

    public function index()
    {
        $data = $this->repo->getAll();
        if ($data->isEmpty()){
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json(compact('data'));
    }

    public function show($id)
    {
        $data = $this->repo->findById($id);
        if ($data)
            return response()->json(compact('data'));

        return response()->json([
            'message'=> 'Records not found'
        ],404);
    }

    public function store(RoleRequest $request)
    {
        $data = $this->service->save($request->all());
        return response()->json(compact('data'));
    }

    public function update(RoleRequest $request, $id)
    {
        $data = $this->service->update($id, $request->all());
        return response()->json(compact('data'));
    }

    public function destroy(RoleRequest $request,$id)
    {
        $this->service->delete($id);
        return response()->json([
            'message' => 'Successful'
        ],200);
    }

    public function attach(RolePermsRequest $request, $role)
    {
        $this->service->attachPerms($role, $request->get('perms'));
        return response()->json([
            'message' => 'Successful'
        ],200);
    }

    public function detach(RolePermsRequest $request, $role)
    {
        $this->service->detachPerms($role, $request->get('perms'));
        return response()->json([
            'message'   =>  'Successful'
        ],200);

    }


}