<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/{lang?}', function ($lang = 'en') {

    set_locale($lang);
    $post = Post::first();
    return view('welcome', compact('post','lang'));
});

Route::post('/store', function (Request $request) {

    $lang = $request->get('lang') ;
    set_locale($lang);

    $postData = [
        'title' => $request->title,
        'body' => $request->body,
    ];
    if(Post::first()){
        $post = Post::first();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
    }
    else{
        Post::create($postData);
    }
    return back();
})->name('store');

 function set_locale($lang){
    App::setLocale($lang);
}


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
