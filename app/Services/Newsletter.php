<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter {

    public function subscribe(string $email, $list = null) {

        $list ??= config('services.mailchimp.lists.subscribers');

        $mainchimp = new ApiClient();

        $mainchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21',
        ]);

        return $mainchimp->lists->addListMember( $list , [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
}
