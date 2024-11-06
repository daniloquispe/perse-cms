<?php

namespace App\Console\Commands;

use App\Mail\OrderConfirmed;
use App\Mail\OrderCreated;
use App\Mail\OrderDelivering;
use App\Models\Order;
use App\OrderStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Send an "order created" test mail notification using last order in database.
 */
class TestOrderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-order-email {status : Order status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test order email (use with MailTrap only)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
		$order = Order::latest()->first();

		$statusParam = (int)$this->argument('status');
		$status = OrderStatus::tryFrom($statusParam);

		if (!$status)
		{
			$this->error('Unrecognized status value status ' . $statusParam);
			return 1;
		}

		$this->info('Status: ' . $status->getLabel());

		$statusMailClass = match ($status)
		{
			OrderStatus::Created => OrderCreated::class,
			OrderStatus::Confirmed => OrderConfirmed::class,
			OrderStatus::Delivering => OrderDelivering::class,
			default => null,
		};

		if (!$statusMailClass)
		{
			$this->error('Mail message not found for status ' . $statusParam);
			return 1;
		}

		$this->info('Mail class: ' . $statusMailClass);

		$sentMessage = Mail::to($order->email)->queue(new $statusMailClass($order));
		dump($sentMessage);

		$this->newLine();
		$this->info('Done');
		return 0;
    }

	protected function promptForMissingArgumentsUsing(): array
	{
		return [
			'status' => 'Which order status? (1..4)',
		];
	}
}
