<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/31/17
 * Time: 3:58 PM
 */

namespace App\Applications\Api\Http\Controllers;


use App\Applications\Api\Http\Requests\InvoiceRequest;
use App\Domains\Invoices\Services\InvoiceService;
use App\Domains\Invoices\Transformers\InvoiceTransformer;

class InvoiceController extends BaseController
{
    private $service;

    public function __construct(InvoiceService $service)
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

    public function store(InvoiceRequest $request)
    {
        $data = $this->service->save($request->all());
        return response()->json(compact('data'));
    }

    public function update(InvoiceRequest $request, $id)
    {
        $data = $this->service->update($id, $request->all());
        return response()->json(compact('data'));
    }

    public function destroy(InvoiceRequest $request,$id)
    {
        $this->service->delete($id);
        return response()->json([
            'message' => 'Successfull'
        ],200);
    }

    public function resume($id)
    {
        $data = $this->service->resume($id);
        $invoice = fractal($data, new InvoiceTransformer())->toArray();

        return response()->json($invoice);
//        if ($data)
//            return response()->json(compact('data'));
//
//        return response()->json([
//            'message'=> 'Records not found'
//        ],404);
    }




}