<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;

use App\Events\Message;
use App\Events\MessageSent;
use App\Http\Controllers\PaymentStripeController;
use App\Http\Controllers\PaymentPremiumController;
use App\Http\Controllers\PerfilController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\VideoController;

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
Route::get('/mandarina/{dni}',[HomeController::class,'mandarina'])->name("mandarina");
Route::get('/',[HomeController::class,'showOccupationService'])->name('ServiciosOfrecidos');
Route::get('/talentService',[HomeController::class,'showTalentService'])->name('showTalentService');
Route::get('/occupationService',[HomeController::class,'showOccupationService'])->name('showOccupationService');
Route::get('/retoService',[HomeController::class,'showRetoService'])->name('showRetoService');
Route::get('/changeService',[HomeController::class,'changeAllShow'])->name('showChangeService');
Route::get('/profileServiceTalent/{id}',[HomeController::class,'showProfileServiceTalent'])->name('showProfileServiceTalent');
Route::get('/profileServiceOccupation/{id}',[HomeController::class,'showProfileServiceOccupation'])->name('showProfileServiceOccupation');
Route::get('/profileServiceRetos/{id}',[HomeController::class,'showProfileServiceRetos'])->name('showProfileServiceRetos');

Route::post('/comment','PostCommentController@newComment')->name('registrarComent');
Route::post('/commentLike',[PostCommentController::class,'proccessLikeComment'])->name('likeComment');
Route::post('/commentDislike',[PostCommentController::class,'proccessDislikeComment'])->name('dislikeComment');

Route::post('/question','PostCommentController@newQuestion')->name('registrarPreg');
Route::post('/answer','PostCommentController@newAnswer')->name('registrarComentR');
Route::post('/score','PostScoreController@newScore')->name('registrarScore');
// Aleatorio

Route::get('/random',[HomeController::class,'showServicesRandom'])->name('aleatorio');


Route::middleware(['auth'])->group(function () {
    // Ruta para video
    Route::post('/uploadVideo',[VideoController::class,'videoUpload'])->name('upload.video.25.percentaje');

    // Carrito
    Route::post('/checkout/serviceProccess',[ContractController::class,'validationFieldDescriptionContract'])->name('contractDetailsData');
    Route::delete('/cart/destroy/{idUser}',[ContractController::class,'clearCart'])->name('cart.destroy');
    Route::get('/checkout/service',[ContractController::class,'checkoutPaymentView'])->name('index.checkout');

    // Pago con paypal
    Route::post('/paypal/payService', [ContractController::class,'processPaymentServiceContract'])->name('continuePaymentPaypal');
    Route::get('/paypal/status', [ContractController::class,'payPalStatus'])->name('paypal.status.now');
    Route::get('/paypal/cancel',[ContractController::class,'cancelPaypal'])->name('cancelValue');

    // Pago con stripe
    Route::post('/stripe/process',[ContractController::class,'processPaymentStripe'])->name('proccessPaymentStripe');

    //Pago stripe premium
    Route::post('/stripe/premium',[PaymentPremiumController::class,'processPaymentPremiumStripe'])->name('proccessPaymentPremiumStripe');

    Route::post('/stripe/process2',[ContractController::class,'processPaymentStripe'])->name('proccessPaymentStripe2');
    
    Route::post('/proccessContract',[ContractController::class,'contractProcess'])->name('iPContract');
    Route::post('/registroServTecnico',[ServiceController::class,'registroTecnico'])->name('servicio.tecnico');
    Route::post('/registroServTalento',[ServiceController::class,'registroTalento'])->name('servicio.talento');
    Route::post('/registroServReto',[ServiceController::class,'registroReto'])->name('servicio.reto');
    Route::get('/perfil/{id}',[PerfilController::class,'index'])->name('perfil');
    Route::get('/perfil/{id}/H',[PerfilController::class,'index'])->name('perfilH');
    Route::patch('/perfil/{id}',[PerfilController::class,'update'])->name('update.user');
    Route::get('/estadoContratoT-{id}', [ContractController::class,'contractStateTalent'])->name('estadoContratoTal');
    Route::get('/estadoContratoO-{id}', [ContractController::class,'contractStateOcupation'])->name('estadoContratoOcu');
    Route::post('/finalizarContr',[ContractController::class,'finishContract'])->name('end.contract');
    Route::post('/ejecutarContr',[ContractController::class,'ejectContract'])->name('eject.contract');
    Route::post('/tablonServicio',[HomeController::class,'solicitarServicio'])->name('tablon.servicio');

    Route::delete('/tablonServicios/{id}',[HomeController::class,'eliminarServicio'])->name('servicio.destroy');

    Route::get('/tablonServicios', [HomeController::class,'TablonServicios'])->name('tablonservicios');
    
});


Auth::routes();

Route::get('nuevo',function(){
    return view('nuevo');
});

Route::get('bandeja',function(){
    return view('bandejamensajes');
})->middleware('auth')->name('bandeja');

Route::get('template',function(){
    return view('template');
});

Route::get('login',function(){
    return view('login');
})->name('login');


Route::get('registro',function(){
    return view('registro');
})->name('registrouser');

Route::get('servicio',function(){
    return view('servicio');
});
Route::get('informa',function(){
    return view('nada');
});
Route::get('serviciopremium',function(){
    return view('premium');
})->name('premium');

Route::post('/registrar',[HomeController::class,'nuevoRegistro'])->name('registrarUsuario');

Route::get('/categorias',function(){
    return view('categoria/filtroServicio');
})->name('categorias');

Route::get('/servicio',function(){
    return view('servicio');
});

Route::get('/servicio',function(){
    return view('servicio');
});
Route::get('registroServicio',[ServiceController::class, 'registro'])->name('offerMyService');
Route::get('registroServicioUs',[ServiceController::class, 'registro'])->name('offerMyServiceChange');

Route::get('/talento',function(){
    return view('talento');
});

Route::get('/estadoContrato',function(){
    return view('estadoContrato');
});


Route::get('/chatNuevo',function(){
    return view('chatNuevo');
});

Route::post('/send-message',function(Request $request){
    event(
        new Message(
            $request->input('username'),
            $request->input('message')));

    return ["success"=>true];
});

Broadcast::channel('chat', function () {
    return Auth::check();
});



