### Project Overview

This Laravel project is designed for integrating with the Mailchimp API for email marketing purposes. It provides a seamless interface for managing email marketing campaigns in your Laravel application.

### Getting Started

#### Step 1: Clone the Repository

```shell
git clone https://github.com/victor90braz/11-section.git
```

#### Step 2: Obtain Your Mailchimp API Key

Obtain your Mailchimp API key from the [Mailchimp API Key page](https://us21.admin.mailchimp.com/account/api/).

#### Step 3: Configure Laravel Environment Variables

Add your Mailchimp API key as an environment variable in your Laravel `.env` file:

```dotenv
MAILCHIMP_KEY=cdb9d6462fd76f4dda9277ad935134a4-us21
```

#### Step 4: Configure Laravel Services

In your Laravel `config/services.php` file, ensure that the Mailchimp configuration is set up correctly:

```php
'mailchimp' => [
    'key' => env('MAILCHIMP_KEY')
]
```

#### Step 5: Verify Configuration

To verify that your Mailchimp configuration is correctly loaded, run the following command in the Laravel Tinker:

```shell
php artisan tinker
> config('services.mailchimp')
```

#### Step 6: Install the Mailchimp Marketing Library

Install the Mailchimp Marketing library using Composer:

```shell
composer require mailchimp/marketing
```

#### Step 7: Next Steps

Follow the [Mailchimp Quick Start Guide](https://mailchimp.com/developer/marketing/guides/quick-start/) to make your first API call and explore more Mailchimp features.

### Additional Documentation and Examples

-   [Mailchimp API Documentation](https://mailchimp.com/developer/marketing/api/account-exports/)
-   [Mailchimp Lists API Documentation](https://mailchimp.com/developer/marketing/api/lists/)

### Sample API Calls

Here are some sample API calls demonstrating how to use the Mailchimp API in your Laravel application.

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

# README for the `Newsletter` Class

```php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter {

    public function subscribe(string $email, $list = null) {

        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client()->lists->addListMember( $list , [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    protected function client() {

        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21',
        ]);
    }
}

```

## Using Dependency Injection

Alternatively, you can utilize dependency injection to make your code more elegant and maintainable. Here's how to use the `Newsletter` class with dependency injection:

```php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
    }
}

```

## Integration in Laravel Routes

To implement the `Newsletter` functionality in your Laravel routes, you can add the following route definition in your `routes/web.php` or `routes/api.php` file:

```php
Route::post('/newsletter', (NewsletterController::class));
```
