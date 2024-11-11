<?php

namespace App\Livewire;

use App\Livewire\Forms\FooterSubscriptionForm;
use App\PageRole;
use App\Services\UrlService;
use App\Toast;
use Illuminate\View\View;
use Livewire\Component;

class SiteFooter extends Component
{
	use Toast;

	public FooterSubscriptionForm $subscriptionForm;

    public function render(UrlService $urlService): View
    {
		$termsUrl = $urlService->fromPageRole(PageRole::Terms);
		$privacyPolicy = $urlService->fromPageRole(PageRole::PrivacyPolicy);

		$data = compact('termsUrl', 'privacyPolicy');
        return view('livewire.site-footer', $data);
    }

	public function subscribe(): void
	{
		if ($this->subscriptionForm->submit())
		{
			$this->toast('¡Gracias por suscribirte!');
			$this->subscriptionForm->reset();
		}
		else
			$this->toast('No hemos podido suscribirte', 'Por favor, vuelve a intentarlo');
	}
}
