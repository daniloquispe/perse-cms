<?php

namespace App\Livewire\Forms;

use App\Models\BookCategory;
use App\Models\Page;
use App\Models\SeoTags;
use App\Models\Subscriber;
use App\PageRole;
use App\Toast;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubscriptionForm extends Component
{
	use Toast;

	public bool $showBookCategoriesList = false;

	public string $bookCategorySearch = '';

	public Collection $bookCategories;

	#[Validate('required')]
	public string $name;

	#[Validate('required')]
	#[Validate('email', message: 'Este no es un correo electrónico válido')]
	#[Validate('unique:App\Models\Subscriber,email', message: 'Este correo electrónico ya se encuentra registrado')]
	public string $email;

	#[Validate('required')]
	public string $phone;

	#[Validate('required')]
	public int $category_id_1;

	#[Validate('required')]
	public int $category_id_2;

	#[Validate('required')]
	public int $category_id_3;

	#[Validate('accepted')]
	public bool $accept;

	#[Validate('accepted')]
	public bool $accept_ads;

    public function render(): View
    {
		$topCategories = BookCategory::query()
			->where('is_visible', true)
			->whereNull('parent_id')
			->orderBy('order')
			->pluck('name', 'id')
			->toArray();

		$privacyPolicySlug = SeoTags::query()
			->where('owner_id', PageRole::PrivacyPolitics->value)
			->where('owner_type', Page::class)
			->value('slug');

		$privacyPolicyUrl = url($privacyPolicySlug);

		$data = compact('topCategories', 'privacyPolicyUrl');
        return view('livewire.forms.subscription-form', $data);
    }

	public function subscribe(): void
	{
		$this->validate();

		$subscriber = new Subscriber($this->all());

		if ($subscriber->save())
			$this->toast('¡Gracias por suscribirte!');
		else
			$this->toast('Hubo un problema con tu suscripción, por favor inténtalo de nuevo');
	}

	public function search(): void
	{
		if (empty($this->bookCategorySearch))
			$this->showBookCategoriesList = false;
		else
		{
			$this->bookCategories = BookCategory::query()
				->select(['id', 'parent_id', 'name'])
				->where('name', 'like', "%{$this->bookCategorySearch}%")
				->where('is_visible', true)
				->whereHas('books')
				->get();

			$this->showBookCategoriesList = true;
		}
	}

	public function getBookCategory(int $id): void
	{
		$name = BookCategory::whereKey($id)->value('name');

		$this->category_id_3 = $id;
		$this->bookCategorySearch = $name;
		$this->showBookCategoriesList = false;
	}
}
