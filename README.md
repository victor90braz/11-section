# Laravel Database Interaction README

Welcome to the **Laravel Database Interaction** project! This repository contains a Laravel application that interacts with the Mailchimp API for email marketing purposes.

## Project Overview

This project is designed to provide an interface between your Laravel application and the Mailchimp email marketing platform. It allows you to integrate Mailchimp functionality into your application and manage your email marketing campaigns seamlessly.

## Getting Started

To use this project, follow these steps:

1. Clone the GitHub repository:

    [11-section Repository](https://github.com/victor90braz/11-section.git)

2. Set up your Mailchimp API key by visiting the following link and obtaining your API key:

    [Mailchimp API Key](https://us21.admin.mailchimp.com/account/api/)

3. Add your Mailchimp API key to your Laravel environment file (`.env`). Update the `MAILCHIMP_KEY` value with your API key:

    ```dotenv
    MAILCHIMP_KEY=cdb9d6462fd76f4dda9277ad935134a4-us21
    ```

4. In your Laravel `config/services.php` file, ensure that the Mailchimp configuration is set up correctly:

    ```php
    'mailchimp' => [
        'key' => env('MAILCHIMP_KEY')
    ]
    ```

5. Verify that your Mailchimp configuration is correctly loaded by running the following command in the Laravel Tinker:

    ```php tinker
    > config('services.mailchimp')
    ```

    The output should resemble the following:

    ```php
    [
        "key" => "cdb9d6462fd76f4dda9277ad935134a4-us21"
    ]
    ```

composer require mailchimp/marketing

-   next steps

-   link -> mailchimp.com/developer/marketing/guides/quick-start/
-   Make your first API call

            require_once('/path/to/MailchimpMarketing/vendor/autoload.php');

            $mailchimp = new \MailchimpMarketing\ApiClient();

            $mailchimp->setConfig([
            'apiKey' => 'YOUR_API_KEY',
            'server' => 'YOUR_SERVER_PREFIX'
            ]);

            $response = $mailchimp->ping->get();
            print_r($response);
