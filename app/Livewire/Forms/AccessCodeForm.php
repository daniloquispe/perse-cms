<?php

namespace App\Livewire\Forms;

use App\Models\AccessCode;
use App\Notifications\AccessCodeRequested;
use Illuminate\Support\Facades\Notification;
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
			$this->sendNotification($accessCode->access_code);
			return true;
		}

		return false;
	}

	private function sendNotification(string|int $accessCode): void
	{
		Notification::route('mail', $this->email)->notify(new AccessCodeRequested($accessCode));
	}
}
