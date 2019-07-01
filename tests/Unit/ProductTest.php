<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function testCreateProduct()
    {
        $data = [
                        'name' => "New Product",
                        'description' => "This is a product",
                        'price' => 10,
                    ];
            
            if(NameUniqueCheck){
                $response = $this->json('POST', '/api/products',$data);
                $response->assertStatus(401);
                $response->assertJson(['message' => "Product name must be unique."]);
            }else{
                $user = factory(\App\User::class)->create();
                $response = $this->actingAs($user, 'api')->json('POST', '/api/product',$data);
                $response->assertStatus(200);
                $response->assertJson(['status' => true]);
                $response->assertJson(['message' => "Product Created!"]);
                $response->assertJson(['data' => $data]);
            }
      }
}
