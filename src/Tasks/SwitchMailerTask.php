<?php

namespace Placetopay\Cerberus\Tasks;

use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

class SwitchMailerTask implements SwitchTenantTask
{
    private string $originalDrive;

    public function __construct()
    {
        $this->originalDrive ??= config('mail.default');
    }

    public function makeCurrent(Tenant $tenant): void
    {
        $currentDrive = config('cache.default');

        app('mail.manager')->forgetMailers()->mailer($currentDrive);
    }

    public function forgetCurrent(): void
    {
        app('mail.manager')->forgetMailers()->mailer($this->originalDrive);
    }
}