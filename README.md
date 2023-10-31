# Laravel Mailchimp Integration

Welcome to the **Laravel Mailchimp Integration** project! This repository contains a Laravel application that seamlessly interacts with the Mailchimp API for email marketing purposes.

## Project Overview

This project is designed to provide an interface between your Laravel application and the Mailchimp email marketing platform. It enables you to effortlessly integrate Mailchimp's powerful email marketing functionality into your Laravel project, allowing you to manage email marketing campaigns with ease.

## Getting Started

Follow these steps to get started with the Laravel Mailchimp Integration project:

### 1. Clone the GitHub Repository

Clone this repository to your local development environment using the following command:

```shell
git clone https://github.com/victor90braz/11-section.git
```

### 2. Obtain Your Mailchimp API Key

Visit the [Mailchimp API Key](https://us21.admin.mailchimp.com/account/api/) page to obtain your Mailchimp API key.

### 3. Configure Laravel Environment Variables

Update your Laravel environment file (`.env`) by adding your Mailchimp API key as an environment variable:

```dotenv
MAILCHIMP_KEY=cdb9d6462fd76f4dda9277ad935134a4-us21
```

### 4. Configure Laravel Services

In your Laravel `config/services.php` file, ensure that the Mailchimp configuration is set up correctly:

```php
'mailchimp' => [
    'key' => env('MAILCHIMP_KEY')
]
```

### 5. Verify Configuration

To verify that your Mailchimp configuration is correctly loaded, run the following command in the Laravel Tinker:

```shell
php artisan tinker
> config('services.mailchimp')
```

The output should resemble the following:

```php
[
    "key" => "cdb9d6462fd76f4dda9277ad935134a4-us21"
]
```

### 6. Install the Mailchimp Marketing Library

Install the Mailchimp Marketing library using Composer:

```shell
composer require mailchimp/marketing
```

### 7. Next Steps

Follow the [Mailchimp Quick Start Guide](https://mailchimp.com/developer/marketing/guides/quick-start/) to make your first API call and explore more Mailchimp features.

## Additional Documentation and Examples

-   [Mailchimp API Documentation](https://mailchimp.com/developer/marketing/api/account-exports/)

-   [Mailchimp Lists API Documentation](https://mailchimp.com/developer/marketing/api/lists/)

### Sample API Calls

Here are some sample API calls that demonstrate how to use the Mailchimp API in your Laravel application:

1. Add a member to a list:

```php
$response = $client->lists->addListMember("76cf69a4f6", [
    'email_address' => 'maria@gmail.com',
    'status' => 'subscribed'
]);
dd($response);
```

2. Get information about list members:

```php
$response = $client->lists->getListMembersInfo("76cf69a4f6");
dd($response);
```

3. Get information about a specific list:

```php
$response = $client->lists->getList("76cf69a4f6");
dd($response);
```

4. Get information about all lists:

```php
$response = $client->lists->getAllLists();
dd($response);
```

## Using the `Newsletter` Class

You can interact with the Mailchimp API in two ways within your Laravel application:

### Using the `Newsletter` Class Directly

```php
Route::post('/newsletter', function () {
    request()->validate([
        'email' => 'required|email'
    ]);

    try {
        (new Newsletter())->subscribe(request('email'));
    } catch (\Exception $error) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

    return redirect('/')->with('success', 'You are now signed up for our newsletter!');
});
```

### Using Dependency Injection

```php
Route::post('/newsletter', function (Newsletter $newsletter) {
    request()->validate([
        'email' => 'required|email'
    });

    try {
        $newsletter->subscribe(request('email'));
    } catch (\Exception $error) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

    return redirect('/')->with('success', 'You are now signed up for our newsletter!');
});
```

Feel free to choose the method that suits your needs and preferences for interacting with the `Newsletter` class.

For more details on using the Mailchimp API and Laravel integration, refer to the official [Mailchimp Developer Documentation](https://mailchimp.com/developer/marketing/).
