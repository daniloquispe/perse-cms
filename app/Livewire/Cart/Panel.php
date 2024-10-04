<?php

namespace App\Livewire\Cart;

use App\Cart;
use App\Livewire\Forms\Cart\ApplyCouponForm;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Toast;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Panel extends Component
{
	use Toast;

	public ApplyCouponForm $couponForm;

	public Coupon|null $coupon;

	public float $total;

    public function render(): View
    {
		$step = Cart::getStep();
		$items = Cart::getItems();
		$this->loadData();

		$data = compact('step', 'items'/*, 'total'*/);
        return view('livewire.cart.panel', $data);
    }

	public function loadData(): void
	{
		$this->coupon = Cart::getCoupon();
		$this->total = Cart::getTotal();
	}

	public function applyCoupon(): void
	{
		if (Cart::getTotalDiscountFromItems() > 0)
		{
			$this->toast('Cupón no aplicable', 'No se puede aplicar cupones a un pedido con al menos 1 libro con descuento');
			return;
		}

		if ($this->couponForm->apply())
			$this->toast('Cupón aplicado', $this->couponForm->code);
		else
			$this->toast('Cupón no válido', 'No se encontró el cupón "' . $this->couponForm->code . '"');
	}

	public function nextStep(): void
	{
		$currentStep = Cart::getStep();

		if ($currentStep == 4)
			$this->processCart();
		else
			$this->goToStep($currentStep + 1);
	}

	public function goToStep(int $step): void
	{
		if ($step > 1 && Cart::getItemsCount() == 0)
		{
			$this->toast('Carrito vacío', 'Agrega unos cuantos libros para continuar con tu compra');
			return;
		}

		Cart::setStep($step);

		$routeName = match ($step)
		{
			1 => 'cart.list',
			2 => 'cart.delivery',
			3 => 'home',
		};
		$this->redirectRoute($routeName);
	}

	private function processCart(): void
	{
		$this->generateOrder();
	}

	private function generateOrder(): void
	{
		$order = new Order();

		$order->customer_id = Auth::guard('storefront')->id();

		$order->email = Cart::getEmail();
		$order->first_name = Cart::getFirstName();
		$order->last_name = Cart::getLastName();
		$order->id_document_number = Cart::getIdentityDocumentNumber();
		$order->phone = Cart::getPhone();
		$order->invoice_type = Cart::getInvoiceType();
		$order->ruc = Cart::getRuc();
		$order->business_name = Cart::getBusinessName();

		$order->department_id = Cart::getDepartmentId();
		$order->province_id = Cart::getProvinceId();
		$order->district_id = Cart::getDistrictId();
		$order->address = Cart::getAddress();
		$order->locationNumber = Cart::getLocationNumber();
		$order->reference = Cart::getReference();
		$order->recipient_name = Cart::getRecipientName();
		$order->delivery_date = Cart::getDeliveryDate();

		if ($order->save())
		{
			foreach (Cart::getItems() as $id => $cartItem)
			{
				$orderItem = new OrderItem();

				$orderItem->book_id = $id;
				$orderItem->quantity = $cartItem['quantity'];
				$orderItem->price = $cartItem['discounted_price'] ?? $cartItem['price'];

				$order->items()->save($orderItem);
			}

			Cart::empty();
		}
	}

	#[On('cart-updated')]
	public function reloadData(): void
	{
		$this->loadData();
	}
}
