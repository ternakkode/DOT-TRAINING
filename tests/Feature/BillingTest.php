<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Billing\Entities\Billing;

class BillingTest extends TestCase
{

    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_berhasil_generate_billing()
    {
        $response = $this->post(route('generate-billing'), [
            'email'         => 'muhammadfirhan@student.ub.ac.id',
            'product'       => [1,2],
            'quantity'      => [5,10],
            'total_price'   => 1000000,
            'discount'      => 1000,
            'due_date'      => '2020/10/10 11:11:11',

        ]);
        $response->dump();
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_berhasil_pay_billing()
    {

        $billing = Billing::where('status', 'PENDING')->first();
        $response = $this->get(route('pay-billing').'?billing_number='.$billing->billing_number);

        $response->dump();
        $response->assertStatus(200);
    }

    public function test_berhasil_cancel_billing()
    {

        $billing = Billing::where('status', 'PENDING')->first();
        $response = $this->get(route('cancel-billing').'?billing_number='.$billing->billing_number);

        $response->dump();
        $response->assertStatus(200);
    }
}
