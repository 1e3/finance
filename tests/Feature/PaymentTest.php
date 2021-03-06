<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentTest extends TestCase
{
    use DatabaseTransactions,DatabaseMigrations;

    protected $users;
    protected $invoices;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->seed(\DatabaseSeeder::class);
        $content = $this->signUp();
        //$content = $this->signIn();
        $this->assertObjectHasAttribute('access_token', $content);
        $this->token = $content->access_token;

        $this->users = \App\Domains\Users\User::all();
        $this->invoices = \App\Domains\Invoices\Invoice::all();

    }

    public function testCreate()
    {
        $headers['Authorization'] = 'Bearer '. $this->token;
        $response = $this->json('POST','api/payments',[
            'price' => '65.02',
            'user_id' => 1,
            'invoice_id' => 4,
            'status'  => 0
        ],$headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' =>[
                    'id',
                    'price',
                    'status',
                    'user_id',
                    'invoice_id',
                    'paid_at',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }


    public function testCreateFailed()
    {
        //TODO: create test to api token
        //$headers['Authorization'] = 'Bearer '. $this->token;
        //$this->json('POST','api/payments',['name'=>'comida'])
        //   ->assertStatus(401)
        //   ->assertSee('Token not provided');

        $headers['Authorization'] = 'Bearer '. $this->token;
        $response = $this->json('POST','api/payments',['price'=>'co'],$headers)
            ->assertStatus(422)
            ->assertSee('price format is invalid');
    }

    public function testGetAll()
    {
        $headers['Authorization'] = 'Bearer '. $this->token;
        $response = $this->json('GET','api/payments',[],$headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*'=>[
                        'id',
                        'price',
                        'status',
                        'user_id',
                        'invoice_id',
                        'paid_at',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function testDelete()
    {
        $headers['Authorization'] = 'Bearer '. $this->token;
        $this->json('DELETE','api/payments/1',[],$headers)
            ->assertStatus(200)
            ->assertJson(['message'=>'Successful']);
    }
    public function testUpdate()
    {
        $headers['Authorization'] = 'Bearer '. $this->token;
        $this->json('PATCH','api/payments/3',['status'=>1],$headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' =>[
                    'id',
                    'price',
                    'status',
                    'user_id',
                    'invoice_id',
                    'paid_at',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testUpdateFailed()
    {
        $headers['Authorization'] = 'Bearer '. $this->token;
        $this->json('PATCH','api/payments/3',['status'=>-1],$headers)
            ->assertStatus(422)
            ->assertSee('The status must be at least 0');
    }

}
