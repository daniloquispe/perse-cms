<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Panel extends Component
{
	public array $menuRoutes = [
		[
			'name' => 'Perfil',
			'route' => 'customer.profile',
		],
		[
			'name' => 'Direcciones',
			'route' => 'customer.addresses',
		],
		[
			'name' => 'Pedidos',
			'route' => 'customer.orders',
		],
		[
			'name' => 'Mis Favoritos',
			'route' => 'customer.favorites',
		],
	];

    /*public function render()
    {
        return view('livewire.customer.panel');
    }*/

	public function logout(): void
	{
		Auth::guard('storefront')->logout();

		session()->invalidate();
		session()->regenerateToken();

		$this->redirectRoute('home');
	}
}
