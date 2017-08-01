<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/31/17
 * Time: 3:58 PM
 */

namespace App\Applications\Api\Http\Controllers;


use App\Applications\Api\Http\Requests\CategoryRequest;
use App\Domains\Categories\Services\CategoryService;

class CategoryController extends BaseController
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->findAll();
        if ($categories->isEmpty()){
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json(compact('categories'));
    }

    public function show($id)
    {
        $category = $this->service->findBy('id',$id);
        if ($category)
            return response()->json(compact('category'));

        return response()->json([
            'message'=> 'Record not found'
        ],404);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->service->save($request->all());
        return response()->json(compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->service->update($id, $request->all());
        return response()->json(compact('category'));
    }

    public function destroy(CategoryRequest $request,$id)
    {
        $this->service->delete($id);
        return response()->json([true]);
    }




}