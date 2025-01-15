<?php

namespace App\Listeners;

use App\Events\CompanyCreatedEvent;
use App\Mail\CompanyCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCompanyCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreatedEvent $event): void
    {
        Mail::to(env('MAIL_RECIPIENT'))->send(new CompanyCreatedMail($event->company));
    }
}
