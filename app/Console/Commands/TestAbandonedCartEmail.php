<?php

namespace App\Console\Commands;

use App\Mail\AbandonedCart;
use App\Mail\OrderConfirmed;
use App\Mail\OrderCreated;
use App\Mail\OrderDelivered;
use App\Mail\OrderDelivering;
use App\Models\Customer;
use App\Models\Order;
use App\OrderStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Send an "abandoned cart" test mail notification using a random books list.
 */
class TestAbandonedCartEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-cart-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test abandoned-cart email (use with MailTrap only)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
		$customer = Customer::query()
			->where('email', 'daniloquispe@gmail.com')
			->first();

		$sentMessage = Mail::to('dql@daniloquispe.dev')->queue(new AbandonedCart($customer));
		dump($sentMessage);

		$this->newLine();
		$this->info('Done');
		return 0;
    }
}
