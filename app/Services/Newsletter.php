<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter {

    public function subscribe(string $email) {

        $mainchimp = new ApiClient();

        $mainchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21',
        ]);

        return $mainchimp->lists->addListMember("76cf69a4f6", [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
}
