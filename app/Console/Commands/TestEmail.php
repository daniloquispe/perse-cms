<?php

namespace App\Console\Commands;

use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Send an "order created" test mail notification using last order in database.
 */
class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email (use with MailTrap only)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
		$order = Order::latest()->first();

		$sentMessage = Mail::to($order->email)->queue(new OrderCreated($order));
		dump($sentMessage);

		$this->newLine();
		$this->info('Done');
		return 0;
    }
}
