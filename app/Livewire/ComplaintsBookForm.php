<?php

namespace App\Livewire;

use App\Livewire\Forms\ComplaintsBookForm as Form;
use App\PageRole;
use App\Services\UrlService;
use Illuminate\View\View;
use Livewire\Component;

class ComplaintsBookForm extends Component
{
	public Form $form;

    public function render(UrlService $urlService): View
    {
		$privacyPolicyUrl = $urlService->fromPageRole(PageRole::PrivacyPolicy);

		$data = compact('privacyPolicyUrl');
        return view('livewire.complaints-book-form', $data);
    }

	public function submitForm(): void
	{
		;
	}
}
