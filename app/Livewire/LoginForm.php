<?php

namespace App\Livewire;

use App\Cart;
use App\Livewire\Forms\LoginForm as Form;
use App\PageRole;
use App\Services\UrlService;
use App\Toast;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class LoginForm extends Component
{
	use Toast;

	public bool $redirectToCart = false;

	public Form $form;

    public function render(UrlService $urlService): View
    {
		if (Auth::guard('storefront')->check())
			$this->redirectRoute('customer.profile');

		$passwordRecoveryLink = $urlService->fromPageRole(PageRole::PasswordRecovery);

		$data = compact('passwordRecoveryLink');
        return view('livewire.login-form', $data);
    }

	public function login(): void
	{
		if ($this->form->login())
		{
			if ($this->redirectToCart)
			{
				// Force cart to reload personal info
				if (Cart::getStep() > 1)
				{
					Cart::setStep(1);
					Cart::setStep(2);
				}

				$this->redirectRoute('cart.personal-info');
			}
			else
				$this->redirectRoute('home');
		}
		else
			$this->toast('Correo electrónico o contraseña incorrectos');
	}
}
