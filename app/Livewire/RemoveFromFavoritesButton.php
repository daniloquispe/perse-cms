<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RemoveFromFavoritesButton extends Component
{
	use \App\Toast;

	public int $bookId;

    public function render()
    {
        return view('livewire.remove-from-favorites-button');
    }

	public function removeFromFavorites(): void
	{
		if (Auth::guard('storefront')->user()->favorites()->detach($this->bookId))
		{
			$this->toast('Eliminado de tus Favoritos');
			$this->dispatch('favorites-updated');
		}
		else
			$this->toast('No se pudo eliminar de tus Favoritos', 'Por favor, vuelve a intentarlo');
	}
}
