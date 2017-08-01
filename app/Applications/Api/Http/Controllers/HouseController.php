<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/31/17
 * Time: 3:58 PM
 */

namespace App\Applications\Api\Http\Controllers;


use App\Applications\Api\Http\Requests\HouseRequest;
use App\Domains\Categories\Services\HouseService;

class HouseController extends BaseController
{
    private $service;

    public function __construct(HouseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->findAll();
        if ($data->isEmpty()){
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json(compact('data'));
    }

    public function show($id)
    {
        $data = $this->service->findBy('id',$id);
        if ($data)
            return response()->json(compact('data'));

        return response()->json([
            'message'=> 'Records not found'
        ],404);
    }

    public function store(HouseRequest $request)
    {
        $data = $this->service->save($request->all());
        return response()->json(compact('data'));
    }

    public function update(HouseRequest $request, $id)
    {
        $data = $this->service->update($id, $request->all());
        return response()->json(compact('data'));
    }

    public function destroy(HouseRequest $request,$id)
    {
        $this->service->delete($id);
        return response()->json([
            'message' => 'Successfull'
        ],200);
    }




}