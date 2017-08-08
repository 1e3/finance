<?php
namespace App\Applications\Api\Http\Controllers;


use App\Applications\Api\Http\Requests\PaymentRequest;
use App\Domains\Payments\Services\PaymentService;

class PaymentController extends BaseController
{
    private $service;

    public function __construct(PaymentService $service)
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

    public function store(PaymentRequest $request)
    {
        $data = $this->service->save($request->all());
        return response()->json(compact('data'));
    }

    public function update(PaymentRequest $request, $id)
    {
        $data = $this->service->update($id, $request->all());
        return response()->json(compact('data'));
    }

    public function destroy(PaymentRequest $request,$id)
    {
        $this->service->delete($id);
        return response()->json([
            'message' => 'Successfull'
        ],200);
    }




}