<?php

namespace Domains\Users\Listeners;

use Domains\Users\Events\UserRegistered;
use Services\Telesing\TelesignService;

class SendVerificationCode
{
    public function __construct(
        protected TelesignService $telesignService
    ){
    }

    public function handle($event): void
    {
        $response = $this->telesignService->sendVerificationCode(
            phoneNumber : $event->user->full_phone_number,
            verifyCode  : $event->code
        );

        $event->user->code_verification = $response['reference_id'];
        $event->user->save();
    }
}
