    <?php

    use App\Http\Controllers\PostCommentController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\SessionController;
    use Illuminate\Support\Facades\Route;
    use MailchimpMarketing\ApiClient;

    Route::get('/ping', function () {
        // Create an instance of the Mailchimp API client
        $client = new ApiClient();
        $client->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21',
        ]);

        try {
            // Call the method to retrieve all lists
            $response = $client->lists->getAllLists();
            dd($response);

            // Return the response as JSON
            return response()->json($response);
        } catch (\Exception $e) {
            // Handle any errors and return an error response
            return response('Error: ' . $e->getMessage(), 500); // You can change the status code as needed
        }
    });

    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::get('posts/{post:slug}', [PostController::class, 'show']);

    Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store']);

    Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
    Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

    Route::get('login', [SessionController::class, 'create'])->middleware('guest');
    Route::post('login', [SessionController::class, 'store'])->middleware('guest');

    Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');
