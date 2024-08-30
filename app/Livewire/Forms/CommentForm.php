<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
	#[Validate('required', message: 'Ingresa su nombre')]
	#[Validate('max:150')]
	public string $name;

	#[Validate('required', message: 'Ingrese su correo electrónico')]
	#[Validate('email', message: 'Ingrese un correo electrónico válido')]
	#[Validate('max:150')]
	public string $email;

	#[Validate('in:[1,2,3,4,5]', message: 'La calificación debe ser entre 1 y 5')]
	public int $rate;

	#[Validate('required', message: 'Ingrese su comentario')]
	public string $comment;

	public function save(int $bookId, int $customerId): bool
	{
		$this->validate();

		$data = [
			'book_id' => $bookId,
			'customer_id' => $customerId,
			'name' => $this->name,
			'email' => $this->email,
			'rate' => $this->rate,
			'comment' => $this->comment,
		];

		$comment = new Comment($data);

		return $comment->save();
	}
}
