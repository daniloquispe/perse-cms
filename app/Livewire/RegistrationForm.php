<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RegistrationForm extends Component
{
	public string $email = '';

	public string $password = '';

	public bool $success = false;

	public bool $error = false;

	public function createUser(): void
	{
		$this->success = false;
		$this->error = false;

		$data = [
			'email' => $this->email,
			'password' => bcrypt($this->password),
			'is_customer' => 1,
		];

		$user = new User($data);

		if ($user->save())
			$this->success = true;
		else
			$this->error = true;
	}

    public function render()
    {
        return view('livewire.registration-form');
    }
}
