<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginForm extends Component
{
	#[Validate('required|email')]
	public string $email = '';

	#[Validate('required')]
	public string $password = '';

	public bool $success = false;

	public bool $error = false;

	private bool $authenticated = false;

    public function render()
    {
		if ($this->authenticated)
			$this->redirectRoute('home');

        return view('livewire.login-form');
    }

	public function __old_login(): void
	{
		$this->success = false;
		$this->error = false;

		$this->validate();

		$data = ['email' => $this->email, 'password' => $this->password];

		$response = Http::post(route('api.login'), $data);

		if ($response->ok())
			$this->authenticated = true;
	}

	public function login(): void
	{
		$this->success = false;
		$this->error = false;

		$this->validate();

		$credentials = ['email' => $this->email, 'password' => $this->password, 'is_customer' => 1];

		if (Auth::attempt($credentials))
		{
			$this->success = true;

			session()->regenerate();

			$this->redirectRoute('home');
		}
		else
			$this->error = true;
	}
}
