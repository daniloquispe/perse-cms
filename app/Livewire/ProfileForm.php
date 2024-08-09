<?php

namespace App\Livewire;

use App\Gender;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProfileForm extends Component
{
	public bool $isEditable;

	public string|null $error;

	#[Validate('required|max:100')]
	public string|null $firstName;

	#[Validate('required:max:100')]
	public string|null $lastName;

	#[Validate('required|email|max:150')]
	public string|null $email;

	#[Validate('required|max:50')]
	public string|null $phone;

	#[Validate('required|date')]
	public string|null $birthdate;

	#[Validate('required|max:11')]
	public string|null $idDocumentNumber;

	#[Validate('required')]
	public Gender|null $gender;

	#[Validate('required|bool')]
	public bool $isSubscribed;

	public function mount(): void
	{
		$user = Auth::guard('storefront')->user();

		$this->firstName = $user->first_name;
		$this->lastName = $user->last_name;
		$this->email = $user->email;
		$this->phone = $user->phone;
		$this->birthdate = $user->birthdate?->format("d-m-Y");
		$this->idDocumentNumber = $user->id_document_number;
		$this->gender = $user->gender;
		$this->isSubscribed = $user->is_subscribed;

		$this->error = null;
	}

	public function render()
    {
        return view('livewire.profile-form');
    }

	public function makeEditable(): void
	{
		$this->isEditable = true;
	}

	public function saveForm(): void
	{
		if (!$this->isEditable)
			return;

		$this->validate();

		$data = [
			'first_name' => $this->firstName,
			'last_name' => $this->lastName,
			'email' => $this->email,
			'phone' => $this->phone,
			'birthdate' => $this->birthdate,
			'id_document_number' => $this->idDocumentNumber,
			'gender' => $this->gender,
			'is_subscribed' => $this->isSubscribed,
		];

		if (Auth::guard('storefront')->user()->update($data))
			$this->isEditable = false;
	}
}
