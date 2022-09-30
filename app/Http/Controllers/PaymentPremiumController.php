<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PaymentPremiumController extends Controller
{
    public function processPaymentPremiumStripe(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        $user->premium = true;
        $user->save();
        $status = 'El pago fue ejecutado correctamente, ahora es un usuario Premium';
        return redirect(route('ServiciosOfrecidos'))->with('statusPaymentSuccess',$status);
    }
}
