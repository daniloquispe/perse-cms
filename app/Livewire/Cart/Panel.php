<?php

namespace App\Livewire\Cart;

use App\Cart;
use App\Livewire\Forms\Cart\ApplyCouponForm;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\PaymentMethodType;
use App\Services\ErpServiceInterface;
use App\Toast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Panel extends Component
{
	use Toast;

	public ApplyCouponForm $couponForm;

	public Coupon|null $coupon;

	public int|null $deliveryPrice;

	public float $total;

	#[Computed]
	public function showCouponForm(): bool
	{
		return !Cart::getCoupon();
	}

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
		$this->deliveryPrice = Cart::getDeliveryPrice();
		$this->total = Cart::getTotal() + Cart::getTotalDiscountFromItems();
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

		$this->redirectRoute('cart.thanks');
	}

	private function generateOrder(): void
	{
		$erpService = app(ErpServiceInterface::class);
		$order = new Order();

		$order->customer_id = Auth::guard('storefront')->id();
		$order->number = $erpService->getOrderNumber();

		$order->email = Cart::getEmail();
		$order->first_name = Cart::getFirstName();
		$order->last_name = Cart::getLastName();
		$order->id_document_number = Cart::getIdentityDocumentNumber();
		$order->phone = Cart::getPhone();
		$order->invoice_type = Cart::getInvoiceType();
		$order->ruc = Cart::getRuc();
		$order->business_name = Cart::getBusinessName();

		$order->department_id = Cart::getDepartmentId();
		$order->department_name = Cart::getDepartmentName();
		$order->province_id = Cart::getProvinceId();
		$order->province_name = Cart::getProvinceName();
		$order->district_id = Cart::getDistrictId();
		$order->district_name = Cart::getDistrictName();
		$order->address = Cart::getAddress();
		$order->location_number = Cart::getLocationNumber();
		$order->reference = Cart::getReference();
		$order->recipient_name = Cart::getRecipientName();
		$order->delivery_date = Cart::getDeliveryDate();
		$order->delivery_price = Cart::getDeliveryPrice();

		$order->payment_method_type = PaymentMethodType::QrCode;
		$order->payment_method_info = [];

		if ($order->save())
		{
			foreach (Cart::getItems() as $id => $cartItem)
			{
				$orderItem = new OrderItem();

				$orderItem->book_id = $id;
				$orderItem->quantity = $cartItem['quantity'];
				$orderItem->gross_price = $cartItem['book']['price'];
				$orderItem->discounted_price = $cartItem['book']['discounted_price'];

				$order->items()->save($orderItem);
			}

			Session::put('orderEmail', $order->email);

			Cart::empty();
		}
	}

	#[On('cart-updated')]
	public function reloadData(): void
	{
		$this->loadData();
	}
}
