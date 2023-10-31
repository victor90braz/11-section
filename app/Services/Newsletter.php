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

        return $mainchimp->lists->addListMember(config('services.mailchimp.lists.subscribers'), [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
}
