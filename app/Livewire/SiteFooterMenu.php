<?php

namespace App\Livewire;

use App\PageRole;
use App\Services\UrlService;
use Livewire\Component;

class SiteFooterMenu extends Component
{
    public function render(UrlService $urlService)
    {
		$aboutUsUrl = $urlService->fromPageRole(PageRole::AboutUs);
		$contactUrl = $urlService->fromPageRole(PageRole::Contact);
		$subscribeUrl = $urlService->fromPageRole(PageRole::Subscribe);
		$loginUrl = $urlService->fromPageRole(PageRole::Login);
		$registerUrl = $urlService->fromPageRole(PageRole::Register);
		$deliveryPolicyUrl = $urlService->fromPageRole(PageRole::DeliveryPolitics);
		$privacyPolicyUrl = $urlService->fromPageRole(PageRole::PrivacyPolitics);
		$cookiesPolicyUrl = $urlService->fromPageRole(PageRole::CookiesPolitics);
		$returnPolicyUrl = $urlService->fromPageRole(PageRole::ReturningPolitics);
		$termsUrl = $urlService->fromPageRole(PageRole::Terms);
		$complaintsBookUrl = $urlService->fromPageRole(PageRole::ComplaintsBook);

		$data = compact('aboutUsUrl', 'contactUrl', 'subscribeUrl', 'loginUrl', 'registerUrl', 'deliveryPolicyUrl', 'privacyPolicyUrl', 'cookiesPolicyUrl', 'returnPolicyUrl', 'termsUrl', 'complaintsBookUrl');

        return view('livewire.site-footer-menu', $data);
    }
}
