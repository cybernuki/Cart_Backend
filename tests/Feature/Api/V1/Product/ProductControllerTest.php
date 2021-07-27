<?php

namespace Tests\Feature\Api\V1\Product;

use App\Model\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @group Api.V1.Product.ProductControllerTest
 */
class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @group Api.V1.Product.ProductControllerTest.testCreate
     */
    public function testCreate()
    {
        $response = $this->post('/api/v1/products', []);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/products', [
            'name' => 'test name',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/products', [
            'name' => 'test name',
            'price' => 123,
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/products', [
            'name' => 'test name',
            'price' => 123,
            'image_url' => 'nonanUrl',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/products', [
            'name' => 'test name',
            'price' => 123,
            'image_url' => 'nonanUrl',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/products', [
            'name' => 'test name',
            'description' => 'an incredible product',
            'price' => 123,
            'image_url' => 'testimage.com',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/products', [
            'name' => 'test name',
            'description' => 'an incredible product',
            'sku' => 'product 123',
            'price' => 123,
            'image_url' => 'testimage.com',
            'status' => 'non a enum',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/products', [
            'name' => 'test name',
            'description' => 'an incredible product',
            'sku' => 'product 123',
            'price' => 123,
            'image_url' => 'testimage.com',
            'status' => Product::STATUS_ENABLED,
        ]);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'uuid' => $response->json('data.uuid'),
                    'name' => 'test name',
                    'description' => 'an incredible product',
                    'sku' => 'product 123',
                    'price' => 123,
                    'image_url' => 'testimage.com',
                    'status' => Product::STATUS_ENABLED,
                ],
            ])
        ;

        $this->assertNotNull(Product::find($response->json('data.id')));
    }

    /**
     * @group Api.V1.Product.ProductControllerTest.testUpdate
     */
    public function testUpdate()
    {
        $product = factory(Product::class)->create();
        $response = $this->patch("/api/v1/products/{$product->id}", []);
        $response->assertStatus(200);

        $response = $this->patch("/api/v1/products/{$product->id}", [
            'name' => 'test name updated',
            'description' => 'an incredible product updated',
            'sku' => 'product 1234',
            'price' => 1234,
            'image_url' => 'testimage.com',
            'status' => 'non a enum',
        ]);
        $response->assertStatus(422);

        $response = $this->patch("/api/v1/products/{$product->id}", [
            'name' => 'test name updated',
            'description' => 'an incredible product updated',
            'sku' => 'product 1234',
            'price' => 1234,
            'image_url' => 'testimage.com',
            'status' => Product::STATUS_ENABLED,
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'test name updated',
                    'description' => 'an incredible product updated',
                    'sku' => 'product 1234',
                    'price' => 1234,
                    'image_url' => 'testimage.com',
                    'status' => Product::STATUS_ENABLED,
                ],
            ])
        ;
    }

    /**
     * @group Api.V1.Product.ProductControllerTest.testShow
     */
    public function testShow()
    {
        $product = factory(Product::class)->create();
        $response = $this->get("/api/v1/products/{$product->id}");
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $product->name,
                    'description' => $product->description,
                    'sku' => $product->sku,
                    'price' => $product->price,
                    'image_url' => $product->image_url,
                ],
            ])
        ;

        $response = $this->get('/api/v1/products/14123');
        $response->assertStatus(404);
    }

    /**
     * @group Api.V1.Product.ProductControllerTest.testIndex
     */
    public function testIndex()
    {
        factory(Product::class, 10)->create();
        $response = $this->get('/api/v1/products');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    0 => [
                        'name',
                        'description',
                        'sku',
                        'price',
                        'image_url',
                    ],
                ],
            ])
            ->assertJsonCount(10, 'data')
        ;
    }
}
