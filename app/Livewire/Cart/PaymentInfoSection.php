<?php

namespace App\Livewire\Cart;

use App\Cart;
//use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\Cart\DeliveryInfoForm;
use App\PaymentMethodType;
use App\Toast;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class PaymentInfoSection extends Component
{
	use Toast;

	public int $paymentMethod = 1;

	public bool $showQrCodePaymentMethodOptions = false;

	public bool $showBankTransferPaymentMethodOptions = false;

	public function render(): View
    {
		$email = Cart::getEmail();
		$firstName = Cart::getFirstName();
		$lastName = Cart::getLastName();
		$identityDocumentNumber = Cart::getIdentityDocumentNumber();
		$phone = Cart::getPhone();
		$invoiceType = Cart::getInvoiceType();
		$ruc = Cart::getRuc();
		$businessName = Cart::getBusinessName();

		$departmentName = Cart::getDepartmentName();
		$provinceName = Cart::getProvinceName();
		$districtName = Cart::getDistrictName();
		$address = Cart::getAddress();
		$locationNumber = Cart::getLocationNumber();
		$reference = Cart::getReference();
		$recipientName = Cart::getRecipientName();
		$deliveryDate = Cart::getDeliveryDate();

		$data = compact('email', 'firstName', 'lastName', 'identityDocumentNumber', 'phone', 'invoiceType', 'ruc', 'businessName', 'departmentName', 'provinceName', 'districtName', 'address', 'locationNumber', 'reference', 'recipientName', 'deliveryDate');
		return view('livewire.cart.payment-info-section', $data);
    }

	public function goToPersonalInfo(): void
	{
		Cart::setStep(2);

		$this->redirectRoute('cart.personal-info');
	}

	public function goToDeliveryInfo(): void
	{
		Cart::setStep(3);

		$this->redirectRoute('cart.delivery');
	}

	/*public function toggleQrCodePaymentMethodOptions(): void
	{
		$this->showQrCodePaymentMethodOptions = $this->paymentMethod == PaymentMethodType::QrCode->value;
	}

	public function toggleBankTransferPaymentMethodOptions(): void
	{
		$this->showBankTransferPaymentMethodOptions = $this->paymentMethod == PaymentMethodType::QrCode->value;
	}*/

	public function togglePaymentMethodOptions(): void
	{
		$this->showQrCodePaymentMethodOptions = $this->paymentMethod == PaymentMethodType::QrCode->value;
		$this->showBankTransferPaymentMethodOptions = $this->paymentMethod == PaymentMethodType::BankTransfer->value;
	}
}
