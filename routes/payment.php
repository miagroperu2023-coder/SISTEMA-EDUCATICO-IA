<?php

use App\Http\Controllers\payment\PaymentController;
use App\Http\Controllers\payment\PaymentSixMonth;
use App\Http\Controllers\payment\PaymentSuscriptionController;
use App\Http\Controllers\payment\PaymentSuscriptionEscolarController;
use App\Http\Controllers\payment\PaymentSuscriptionWebHookController;
use App\Http\Controllers\payment\PaymentSuscriptionYear;
use App\Http\Controllers\payment\PayPlanController;
use Illuminate\Support\Facades\Route;


//RUTAS PARA PAGAR UN CURSO CON MERCADOPAGO
Route::get('/chekout/course/payment/{course:slug}', [PaymentController::class, 'index'])->name('checkout.course.index');
Route::post('/mercadopago/payment', [PaymentController::class, 'pay'])->name('mercadopago.checkout');
Route::get('/mercadopago/success/{course}', [PaymentController::class, 'success'])->name('mercadopago.success');
Route::get('/mercadopago/failure', [PaymentController::class, 'failure'])->name('mercadopago.failure');
Route::get('/mercadopago/pending', [PaymentController::class, 'pending'])->name('mercadopago.pending');



//RUTAS PARA SUSCRIPTION CON MERCADOPAGO PLAN PRE UNIVERSITARIO
Route::post('/mercadopago/suscription/academico-premium', [PaymentSuscriptionController::class, 'suscription'])->name('mercadopago.suscription.index');
Route::get('/mercadopago/suscription/academico-premium/success', [PaymentSuscriptionController::class, 'success'])->name('mercadopago.suscription.success');
Route::get('/mercadopago/suscription/academico-premium/failure', [PaymentSuscriptionController::class, 'failure'])->name('mercadopago.suscription.failure');
Route::get('/mercadopago/suscription/academico-premium/pending', [PaymentSuscriptionController::class, 'pending'])->name('mercadopago.suscription.pending');
Route::get('/mercadopago/subscribete/academico-premium', [PaymentSuscriptionController::class, 'subscribe'])->name('mercadopago.suscription.subscribe');
Route::post('/mercadopago/suscription/academico-premium/cancel', [PaymentSuscriptionController::class , 'cancel'])->name('mercadopago.suscription.cancel');


//PAGO POR 6 MESES PARA PREUNICURSOS
Route::post('/mercadopago/suscription/academico-premium/seis-meses', [PaymentSixMonth::class, 'suscription'])->name('mercadopago.suscription.six.index');
Route::get('/mercadopago/suscription/academico-premium/seis-meses/success', [PaymentSixMonth::class, 'success'])->name('mercadopago.suscription.six.success');
Route::get('/mercadopago/suscription/academico-premium/seis-meses/failure', [PaymentSixMonth::class, 'failure'])->name('mercadopago.suscription.six.failure');
Route::get('/mercadopago/suscription/academico-premium/seis-meses/pending', [PaymentSixMonth::class, 'pending'])->name('mercadopago.suscription.six.pending');

//PAGO POR 12 MESES PARA PREUNICURSOS
Route::post('/mercadopago/suscription/academico-premium/anual-meses', [PaymentSuscriptionYear::class, 'suscription'])->name('mercadopago.suscription.year.index');
Route::get('/mercadopago/suscription/academico-premium/anual-meses/success', [PaymentSuscriptionYear::class, 'success'])->name('mercadopago.suscription.year.success');
Route::get('/mercadopago/suscription/academico-premium/anual-meses/failure', [PaymentSuscriptionYear::class, 'failure'])->name('mercadopago.suscription.year.failure');
Route::get('/mercadopago/suscription/academico-premium/anual-meses/pending', [PaymentSuscriptionYear::class, 'pending'])->name('mercadopago.suscription.year.pending');

//PARA LOS DESCUENTOS 
Route::post('/mercadopago/descuento-anuel/academico-premiun/anual-meses/{plan}', [PayPlanController::class, 'descuentoPlanPreunicursos'])->name('mercadopago.descuento.suscription.year.index');

/*RUTAS PARA SUSCRIPTION CON MERCADOPAGO PLAN ESCOLAR
Route::post('/mercadopago/suscription/school/academico-premium', [PaymentSuscriptionEscolarController::class, 'school'])->name('mercadopago.suscription.school.index');
Route::get('/mercadopago/suscription/school/academico-premium/success', [PaymentSuscriptionEscolarController::class, 'success'])->name('mercadopago.suscription.school.success');
Route::get('/mercadopago/suscription/school/academico-premium/failure', [PaymentSuscriptionEscolarController::class, 'failure'])->name('mercadopago.suscription.school.failure');
Route::get('/mercadopago/suscription/school/academico-premium/pending', [PaymentSuscriptionEscolarController::class, 'pending'])->name('mercadopago.suscription.school.pending');
Route::get('/mercadopago/subscribete/school/academico-premium', [PaymentSuscriptionEscolarController::class, 'subscribe'])->name('mercadopago.suscription.school.subscribe');
Route::post('/mercadopago/suscription/school/academico-premium/cancel', [PaymentSuscriptionEscolarController::class, 'cancel'])->name('mercadopago.suscription.school.cancel');
*/

Route::post('/yape/payment/{course}', [PaymentController::class, 'yape'])->name('yape.index');


Route::post('/mercado/webhooks', [PaymentSuscriptionWebHookController::class, 'index'])->name('mercadopago.suscription.webhook.index');