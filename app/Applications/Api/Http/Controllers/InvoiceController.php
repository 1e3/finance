<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/31/17
 * Time: 3:58 PM
 */

namespace App\Applications\Api\Http\Controllers;


use App\Applications\Api\Http\Requests\InvoiceRequest;
use App\Domains\Invoices\Repositories\InvoiceRepository;
use App\Domains\Invoices\Services\InvoiceService;
use App\Domains\Invoices\Transformers\InvoiceItemTransformer;
use App\Domains\Invoices\Transformers\InvoiceTransformer;
use JWTAuth;

class InvoiceController extends BaseController
{
    private $service;
    private $repo;

    public function __construct(InvoiceService $service, InvoiceRepository $repo)
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
    }

    public function showByHouse($house)
    {
        $data = $this->repo->whereHouse($house);
        $invoices = fractal()->collection($data)->transformWith(new InvoiceItemTransformer())->toArray();
        return response()->json($invoices);
    }

    public function myInvoices()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $data = $this->repo->whereUser($user->id);
        $invoices = fractal()->collection($data)->transformWith(new InvoiceItemTransformer())->toArray();
        return response()->json($invoices);
    }

    public function associate()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $data = $this->repo->whereUserHasInvoices($user->id);
        $invoices = fractal()->collection($data)->transformWith(new InvoiceItemTransformer())->toArray();
        return response()->json($invoices);
    }



}