<?php

namespace Tests\Feature;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;
use Tests\TestCase;

class BugsnagTest extends TestCase
{
	/**
	 * @link https://docs.bugsnag.com/platforms/php/laravel/ BugSnag documentation
	 */
	public function test_bugsnag_is_installed_and_configured(): void
    {
		Bugsnag::notifyException(new RuntimeException("Test error"));
    }
}
