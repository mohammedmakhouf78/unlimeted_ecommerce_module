<?php

namespace Tests\Controller;

use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testCreateBuyOrderFailsWithoutParameters()
    {
        $response = $this->call('POST',route('admin.order.createBuyOrder'));
        $response->assertSessionHasErrors();
    }

    public function testCreateBuyOrderFailsWithoutSupplierId()
    {
        $response = $this->call(
            'POST',
            route('admin.order.createBuyOrder'),
            [
                'order_total' => 100,
                'order_discount' => 3,
                'order_total_after_discount' => 97,
                'paid' => 50,
                'left' => 40,
                'product_detail_id' => [1,2,3],
                'quantity' => [5,6,7],
                'buy_price' => [100,200,400],
                'total' => [100,200,400],
                'discount' => [1,23,33],
                'total_after_discount' => [1,2,3]
            ]
        );
        $response->assertSessionHasErrors();
    }

    public function testCreateBuyOrderFailsIfSupplierIdNotExist()
    {
        $response = $this->call(
            'POST',
            route('admin.order.createBuyOrder'),
            [
                'supplier_id' => 10000,
                'order_total' => 100,
                'order_discount' => 3,
                'order_total_after_discount' => 97,
                'paid' => 50,
                'left' => 40,
                'product_detail_id' => [1,2,3],
                'quantity' => [5,6,7],
                'buy_price' => [100,200,400],
                'total' => [100,200,400],
                'discount' => [1,23,33],
                'total_after_discount' => [1,2,3]
            ]
        );
        $response->assertSessionHasErrors();
    }

    
}