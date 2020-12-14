<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\{BasicRequest};
use App\Ussd\{UssdMenu};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::any('/', function(Request $request) {

	$ussd = new UssdMenu($request);

	//dd($ussd->getMenu());
	try {
		return view($ussd->getMenu());
	} catch (\InvalidArgumentException $e) {
		return view('errors.index');
	}

   	
});


