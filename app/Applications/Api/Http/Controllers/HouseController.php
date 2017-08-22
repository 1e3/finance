<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/31/17
 * Time: 3:58 PM
 */

namespace App\Applications\Api\Http\Controllers;


use App\Applications\Api\Http\Requests\HouseRequest;
use App\Domains\Houses\Repositories\HouseRepository;
use App\Domains\Houses\Services\HouseService;

class HouseController extends BaseController
{
    private $service;
    private $repo;
    public function __construct(HouseService $service, HouseRepository $repo)
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
            'message' => 'Successful'
        ],200);
    }




}