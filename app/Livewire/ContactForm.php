<?php

namespace App\Livewire;

use App\Livewire\Forms\ContactForm as Form;
use App\PageRole;
use App\Services\UrlService;
use App\Toast;
use Illuminate\View\View;
use Livewire\Component;

class ContactForm extends Component
{
	use Toast;

	public Form $form;

    public function render(UrlService $urlService): View
    {
		$privacyPolicyUrl = $urlService->fromPageRole(PageRole::PrivacyPolicy);

		$data = compact('privacyPolicyUrl');
        return view('livewire.contact-form', $data);
    }

	public function submit(): void
	{
		if ($this->form->submit())
			$this->toast('Mensaje enviado');
		else
			$this->toast('No se pudo enviar el mensaje', 'Por favor, vuelve a intentarlo');
	}
}
