<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\{BasicRequest};

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

	

Route::any('menu', function(Request $request) {

	$view = view('ussd.menu', [
		'telephone' => $request->has('msisdn') ? $request->msisdn:"Telephone invalide",
		'session' => $request->has('sessionid') ? $request->sessionid:"Session invalide"
	]);

	if ($request->has('input')) {
		switch ($request->input) {
			case '1':
				$view = view('ussd.prenatal.menu');
				break;
			case '2':
				$view = view('ussd.cycle.menu');
				break;
			default:
				# code...
				break;
		}
	}

	return $view;
});

Route::any('suvi-prenatal', function(Request $request) {

	$view = view('ussd.prenatal.menu');

	if ($request->has('input')) {
		switch ($request->input) {
			case '1':
				$view = view('ussd.prenatal.souscrire.1');
				break;
			case '2':
				$view = view('ussd.prenatal.consultation.1');
				break;
			case '3':
				$view = view('ussd.prenatal.accouchement.1');
				break;
			default:
				# code...
				break;
		}
	}

	return $view;
});

Route::any('suvi-cycle', function(Request $request) {

	$view = view('ussd.cycle.menu');

	if ($request->has('input')) {
		switch ($request->input) {
			case '1':
				$view = view('ussd.cycle.souscrire.1');
				break;
			case '2':
				$view = view('ussd.cycle.regle.1');
				break;
			case '3':
				$view = view('ussd.cycle.ovulation.1');
				break;
			default:
				# code...
				break;
		}
	}

	return $view;
	
});


