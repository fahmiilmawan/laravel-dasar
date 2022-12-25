<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 Route::get('/pzn', function (){
     return "Hallo Programmer";
 });
 Route::redirect('/youtube','/pzn');

 Route::fallback(function(){
     return "404 By Programmer";
 });

 Route::view('/hello','hello',['name' => 'Fahmi Ilmawan']);

Route::get('/hello',function (){
       return view('hello',['name'=>'Fahmi Ilmawan']);
});

Route::get('/hello-world',function (){
    return view('hello.world',['name'=>'Fahmi Ilmawan']);
});

Route::get('/product/{id}',function ($productId){
    return "product $productId";
})->name('product.detail');

Route::get('/product/{product}/item/{item}', function ($productId,$itemId){
    return "product $productId dan item $itemId";
})->where('product','[0-9]+')->where('item','[0-9]+')->name('product.item.detail');

Route::get('/user/{id?}',function ($userId = 'fahmi'){
        return "user $userId";
});

Route::get('/produk/{id}',function ($id){
    $link = route('product.detail',['id'=> $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id){
    return redirect()->route('product.detail',['id'=>$id]);
});
Route::get('/controller/hello/request',[\App\Http\Controllers\HelloController::class,'request']);
Route::get('/controller/hello/{name}',[\App\Http\Controllers\HelloController::class]);

Route::get('/input/hello',[\App\Http\Controllers\InputController::class,'hello']);
Route::post('/input/hello',[\App\Http\Controllers\InputController::class,'hello']);
Route::post('/input/hello/first',[\App\Http\Controllers\InputController::class,'helloFirstName']);
Route::post('/input/hello/input',[\App\Http\Controllers\InputController::class,'helloInput']);
Route::post('/input/hello/array',[\App\Http\Controllers\InputController::class,'helloArray']);
Route::post('/input/type',[\App\Http\Controllers\InputController::class,'inputType']);
Route::post('/input/filter/only',[\App\Http\Controllers\InputController::class,'filterOnly']);
Route::post('/input/filter/except',[\App\Http\Controllers\InputController::class,'filterExcept']);
Route::post('input/filter/merge',[\App\Http\Controllers\InputController::class,'filterMerge']);

Route::post('/file/upload',[\App\Http\Controllers\FileController::class,'upload'])
->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

Route::get('/hello/response',[\App\Http\Controllers\ResponseController::class,'response']);
Route::get('/hello/response/header',[\App\Http\Controllers\ResponseController::class,'header']);

Route::prefix('type/response')->group(function (){
Route::get('/view',[\App\Http\Controllers\ResponseController::class,'responseView']);
Route::get('/json',[\App\Http\Controllers\ResponseController::class,'responseJson']);
Route::get('/file',[\App\Http\Controllers\ResponseController::class,'responseFile']);
Route::get('/download',[\App\Http\Controllers\ResponseController::class,'responseDownload']);
});

Route::controller(\App\Http\Controllers\CookieController::class)->group(function (){
Route::get('/cookie/set','createCookie');
Route::get('/cookie/get','getCookie');
Route::get('/cookie/clear','clearCookie');
});

Route::get('/redirect/from',[\App\Http\Controllers\RedirectController::class,'redirectFrom']);
Route::get('/redirect/to',[\App\Http\Controllers\RedirectController::class,'redirectTo']);
Route::get('/redirect/name',[\App\Http\Controllers\RedirectController::class,'redirectName']);
Route::get('/redirect/name/{name}',[\App\Http\Controllers\RedirectController::class,'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/action',[\App\Http\Controllers\RedirectController::class,'redirectAction']);
Route::get('/redirect/away',[\App\Http\Controllers\RedirectController::class,'redirectAway']);
Route::get('redirect/named',function (){
   // return route('redirect-hello',['name'=>'Fahmi']);
    //return url()->route('redirect-hello',['name'=>'Fahmi']);
    return \Illuminate\Support\Facades\URL::route('redirect-hello',['name'=>'Fahmi']);
});

Route::middleware('contoh:PZN,401')->prefix('/middleware')->group(function (){
Route::get('/api', function (){
    return "OK";
    });
    Route::get('/group', function (){
    return "GROUP";
    });
});
Route::get('/url/action',function (){
    //return action([\App\Http\Controllers\FormController::class,'form']);
   // return url()->action([\App\Http\Controllers\FormController::class,'form']);
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class,'form']);
});
Route::get('/form',[\App\Http\Controllers\FormController::class,'form']);
Route::post('/form',[\App\Http\Controllers\FormController::class,'submitForm']);

Route::get('/url/current',function (){
    return Illuminate\Support\Facades\URL::full();
});

Route::get('/create/session',[\App\Http\Controllers\SessionController::class,'createSession']);
Route::get('/session/get',[\App\Http\Controllers\SessionController::class,'getSession']);

Route::get('/error/sample',function (){
    throw new Exception("Sample Error");
});

Route::get('/error/manual',function (){
    report(new Exception('Sample Error'));
    return "OK";
});
Route::get('/error/validation', function (){
    throw new \App\Exceptions\ValidationException("Validation Error");
});

Route::get('/abort/400', function (){
    abort(400);
});
Route::get('/abort/401', function (){
    abort(401);
});
Route::get('/abort/500', function (){
    abort(500);
});
