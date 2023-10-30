    <?php

    use App\Http\Controllers\PostCommentController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\SessionController;
    use Illuminate\Support\Facades\Route;
    use MailchimpMarketing\ApiClient;
use PhpParser\Node\Stmt\TryCatch;

    Route::post('/newsletter', function () {

        request()->validate([
            'email' => 'required|email'
        ]);

        $mainchimp = new ApiClient();
        $mainchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21',
        ]);

        try {

            $mainchimp->lists->addListMember("76cf69a4f6", [
                'email_address' => request('email'),
                'status' => 'subscribed'
            ]);

           return redirect('/')->with('success', 'You are now signed up for our newsletter!');

        } catch(\Exception $error) {

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
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
