# Laravel Mailchimp Integration README

Welcome to the **Laravel Mailchimp Integration** project! This repository contains a Laravel application that interacts with the Mailchimp API for email marketing purposes.

## Project Overview

This project is designed to provide an interface between your Laravel application and the Mailchimp email marketing platform. It allows you to integrate Mailchimp functionality into your application and manage your email marketing campaigns seamlessly.

## Getting Started

To use this project, follow these steps:

1. **Clone the GitHub Repository**:

    - Clone this repository to your local development environment:

    ```
    git clone https://github.com/victor90braz/11-section.git
    ```

2. **Obtain Your Mailchimp API Key**:

    - Visit the following link and obtain your Mailchimp API key:

    [Mailchimp API Key](https://us21.admin.mailchimp.com/account/api/)

3. **Set Up Laravel Environment Variables**:

    - In your Laravel environment file (`.env`), update the `MAILCHIMP_KEY` value with your API key:

    ```dotenv
    MAILCHIMP_KEY=cdb9d6462fd76f4dda9277ad935134a4-us21
    ```

4. **Configure Laravel Services**:

    - In your Laravel `config/services.php` file, ensure that the Mailchimp configuration is set up correctly:

    ```php
    'mailchimp' => [
        'key' => env('MAILCHIMP_KEY')
    ]
    ```

5. **Verify Configuration**:

    - Verify that your Mailchimp configuration is correctly loaded by running the following command in the Laravel Tinker:

    ```shell
    php artisan tinker
    > config('services.mailchimp')
    ```

6. **Install Mailchimp Marketing Library**:

    - Install the Mailchimp Marketing library using Composer:

    ```shell
    composer require mailchimp/marketing
    ```

7. **Next Steps**:

    - Follow the [Mailchimp Quick Start Guide](https://mailchimp.com/developer/marketing/guides/quick-start/) to make your first API call and explore more features.

# Additional Documentation and Examples

-   Mailchimp API Documentation:

    -   [Account Exports](https://mailchimp.com/developer/marketing/api/account-exports/)
    -   [Lists](https://mailchimp.com/developer/marketing/api/lists/)

-   Sample API Calls:

    -   Add a member to a list:

    ```php
    $response = $client->lists->addListMember("76cf69a4f6", [
        'email_address' => 'maria@gmail.com',
        'status' => 'subscribed'
    ]);
    dd($response);
    ```

    -   Get information about list members:

    ```php
    $response = $client->lists->getListMembersInfo("76cf69a4f6");
    dd($response);
    ```

    -   Get information about a specific list:

    ```php
    $response = $client->lists->getList("76cf69a4f6");
    dd($response);
    ```

    -   Get information about all lists:

    ```php
    $response = $client->lists->getAllLists();
    dd($response);
    ```
