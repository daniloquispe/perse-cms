<?php

namespace App\Livewire\Forms\Customer;

use App\Gender;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class ProfileForm extends Form
{
	#[Validate('required|max:100')]
	public string|null $first_name;

	#[Validate('required:max:100')]
	public string|null $last_name;

	#[Validate('required|email|max:150')]
	public string|null $email;

	#[Validate('required|max:50')]
	public string|null $phone;

	#[Validate('required|date')]
	public string|null $birthdate;

	#[Validate('required|max:11')]
	public string|null $id_document_number;

	#[Validate('required')]
	public Gender|null $gender;

	#[Validate('required|bool')]
	public bool $is_subscribed;

	public function __construct(Component $component, $propertyName)
	{
		parent::__construct($component, $propertyName);

		$user = Auth::user();

		$this->first_name = $user->first_name;
		$this->last_name = $user->last_name;
		$this->email = $user->email;
		$this->phone = $user->phone;
		$this->birthdate = $user->birthdate?->format("d-m-Y");
		$this->id_document_number = $user->id_document_number;
		$this->gender = $user->gender;
		$this->is_subscribed = $user->is_subscribed;
	}

	public function save(): bool
	{
		$this->validate();

		return Auth::guard('storefront')->user()->update($this->all());
	}
}
