<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/{lang?}', function ($lang = 'en') {

    App::setLocale($lang);
    $post = Post::first();
    return view('welcome', compact('post','lang'));
});

Route::post('/store', function (Request $request) {

    $lang = $request->get('lang') ;
    App::setLocale($lang);
    
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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
