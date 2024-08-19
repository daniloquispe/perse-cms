<?php

namespace App\Livewire;

use App\Livewire\Forms\AccessCodeForm;
use App\Models\AccessCode;
use App\Models\Customer;
use App\PageRole;
use App\Services\UrlService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistrationForm extends Component
{
	use \App\Toast;

	public int $step = 1;

	public string $email;

	public AccessCodeForm $accessCodeForm;

	public \App\Livewire\Forms\RegistrationForm $registrationForm;

    public function render(UrlService $urlService)
    {
		$loginUrl = $urlService->fromPageRole(PageRole::Login);
		$privacyPolicyUrl = $urlService->fromPageRole(PageRole::PrivacyPolitics);
		$termsUrl = $urlService->fromPageRole(PageRole::Terms);

		$data = compact('loginUrl', 'privacyPolicyUrl', 'termsUrl');
        return view('livewire.registration-form', $data);
    }

	public function submit(UrlService $urlService): void
	{
		if ($this->step == 1)
			$this->sendEmailCode();
		else
			$this->createUser($urlService);
	}

	private function sendEmailCode(): void
	{
		if ($this->accessCodeForm->submit())
		{
			$this->email = $this->accessCodeForm->email;
			$this->step = 2;

			$this->toast('Código enviado', 'Revisa tu correo electrónico');
		}
		else
			$this->toast('No se pudo enviar el código', 'Por favor, intenta nuevamente');
	}

	private function createUser(UrlService $urlService): void
	{
		if ($this->accessCodeIsInvalid())
		{
			$this->toast('Código de acceso no válido', 'Revisa que esté bien escrito, o bien solicita un nuevo código de acceso');
			return;
		}

		if ($this->emailExists())
		{
			$loginUrl = $urlService->fromPageRole(PageRole::Login);

			$this->toast('Correo electrónico ya registrado', 'Puedes iniciar sesión con este correo, o bien registrarte con uno diferente', link: $loginUrl, linkText: 'Iniciar sesión');
			return;
		}

		$user = $this->registrationForm->submit($this->accessCodeForm->email);

		if ($user)
		{
			Auth::guard('storefront')->login($user);

			$this->redirectRoute('home');
		}
		else
			$this->toast('Hubo un error en el registro', 'Por favor inténtalo más tarde');
	}

	private function accessCodeIsInvalid(): bool
	{
		return AccessCode::query()
			->where('access_code', $this->registrationForm->access_code)
			->where('email', $this->accessCodeForm->email)
			->doesntExist();
	}

	private function emailExists(): bool
	{
		return Customer::where('email', $this->accessCodeForm->email)->exists();
	}

	public function goBack(): void
	{
		$this->step = 1;
		$this->email = '';
	}
}
