<?php

namespace App\Livewire;

use App\PageRole;
use App\Services\UrlService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginForm extends Component
{
	use \App\Toast;

	#[Validate('required|email')]
	public string $email = '';

	#[Validate('required')]
	public string $password = '';

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
		$this->validate();

		$credentials = ['email' => $this->email, 'password' => $this->password];

		if (Auth::guard('storefront')->attempt($credentials))
		{
			session()->regenerate();

			$this->redirectRoute('home');
		}
		else
			$this->toast('Correo electrónico o contraseña incorrectos');
	}
}
