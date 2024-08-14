<?php

namespace App\Livewire;

use App\PageRole;
use App\Services\UrlService;
use Livewire\Component;

class SiteHeader extends Component
{
    public function render(UrlService $urlService)
    {
		$loginUrl = $urlService->fromPageRole(PageRole::Login);

		$data = compact('loginUrl');
        return view('livewire.site-header', $data);
    }
}
