<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/31/17
 * Time: 3:58 PM
 */

namespace App\Applications\Api\Http\Controllers;


use App\Applications\Api\Http\Requests\CategoryRequest;
use App\Domains\Categories\Repositories\CategoryRepository;
use App\Domains\Categories\Services\CategoryService;

class CategoryController extends BaseController
{
    private $service;
    private $repo;
    public function __construct(CategoryService $service, CategoryRepository $repo)
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

    public function store(CategoryRequest $request)
    {
        $data = $this->service->save($request->all());
        return response()->json(compact('data'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $this->service->update($id, $request->all());
        return response()->json(compact('data'));
    }

    public function destroy(CategoryRequest $request,$id)
    {
        $this->service->delete($id);
        return response()->json(['message'=>'Successful'],200);
    }




}