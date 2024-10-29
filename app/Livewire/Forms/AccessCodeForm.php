<?php

namespace App\Livewire\Forms;

use App\Mail\AccessCodeRequested;
use App\Models\AccessCode;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AccessCodeForm extends Form
{
	#[Validate('required', message: 'Debe ingresar un correo electrónico')]
	#[Validate('email', message: 'Este correo electrónico no es válido')]
	public string $email = '';

	public function submit(): bool
	{
		$this->validate();

		$accessCode = AccessCode::find($this->email);
		if ($accessCode)
			$accessCode->access_code = rand(100000, 999999);
		else
			$accessCode = new AccessCode(['email' => $this->email, 'access_code' => rand(100000, 999999)]);

		if ($accessCode->save())
		{
			$this->sendEmail($accessCode->access_code);
			return true;
		}

		return false;
	}

	private function sendEmail(string|int $accessCode): void
	{
		Mail::to($this->email)->send(new AccessCodeRequested($accessCode, $this->email));
	}
}
