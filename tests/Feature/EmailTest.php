<?php

namespace Tests\Feature;

use App\Mail\AbandonedCart;
use App\Mail\AccessCodeRequested;
use App\Mail\OrderConfirmed;
use App\Mail\OrderCreated;
use App\Mail\OrderDelivered;
use App\Mail\OrderDelivering;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

class EmailTest extends TestCase
{
	use WithFaker;

	#[Group('email')]
	#[Group('order')]
	public function test_send_access_code_email(): void
	{
		Mail::fake();

		$accessCode = rand(100000, 999999);
		$email = $this->faker->email;

		Mail::to($email)->send(new AccessCodeRequested($accessCode, $email));

		Mail::assertSent(AccessCodeRequested::class);
	}

    #[Group('email')]
	#[Group('order')]
    public function test_queue_order_created_email(): void
    {
		Mail::fake();

		$order = Order::latest()->first();

		$this->assertTrue($order instanceof Order);
		$this->assertNotEmpty($order->email);

		Mail::to($order->email)->queue(new OrderCreated($order));

		Mail::assertQueued(OrderCreated::class);
    }

	#[Group('email')]
	#[Group('order')]
	public function test_queue_order_confirmed_email(): void
	{
		Mail::fake();

		$order = Order::latest()->first();

		$this->assertTrue($order instanceof Order);
		$this->assertNotEmpty($order->email);

		Mail::to($order->email)->queue(new OrderConfirmed($order));

		Mail::assertQueued(OrderConfirmed::class);
	}

	#[Group('email')]
	#[Group('order')]
	public function test_queue_order_delivering_today_email(): void
	{
		Mail::fake();

		$order = Order::latest()->first();

		$this->assertTrue($order instanceof Order);
		$this->assertNotEmpty($order->email);

		Mail::to($order->email)->queue(new OrderDelivering($order));

		Mail::assertQueued(OrderDelivering::class);
	}

	#[Group('email')]
	#[Group('order')]
	public function test_queue_order_delivered_email(): void
	{
		Mail::fake();

		$order = Order::latest()->first();

		$this->assertTrue($order instanceof Order);
		$this->assertNotEmpty($order->email);

		Mail::to($order->email)->queue(new OrderDelivered($order));

		Mail::assertQueued(OrderDelivered::class);
	}

	#[Group('email')]
	#[Group('cart')]
	public function test_queue_abandoned_cart_email(): void
	{
		Mail::fake();

		Mail::to('dql@daniloquispe.dev')->queue(new AbandonedCart());

		Mail::assertQueued(AbandonedCart::class);
	}
}