<?php

namespace App\Livewire;

use App\Livewire\Forms\CommentForm as Form;
use App\PageRole;
use App\Services\UrlService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentForm extends Component
{
	use \App\Toast;

	public Form $form;

	public int $bookId;

	public bool $show = false;

	public function mount(): void
	{
		if (Auth::guard('storefront')->check())
		{
			$customer = Auth::guard('storefront')->user();

			$this->form->name = $customer->full_name;
			$this->form->email = $customer->email;
		}
	}

	public function toggleForm(UrlService $urlService): void
	{
		if (Auth::guard('storefront')->check())
			$this->show = !$this->show;
		else
			$this->toast('Necesitas iniciar sesión antes de enviar un comentario', link: $urlService->fromPageRole(PageRole::Login), linkText: 'Iniciar sesión');
	}

	public function submit(): void
	{
		if (!Auth::guard('storefront')->check())
			return;

		if ($this->form->save($this->bookId, Auth::guard('storefront')->id()))
		{
			$this->toast('¡Gracias por comentar!', 'Revisaremos tu comentario y lo publicaremos a la brevedad');
			$this->form->reset();
		}
		else
			$this->toast('No se pudo enviar el comentario', 'Por favor, inténtalo de nuevo');
	}
}
