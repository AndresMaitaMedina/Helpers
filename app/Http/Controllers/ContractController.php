<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;
class ContractController extends Controller
{

    const ERRORREASON = "No se pudo ejecutar el contrato por las siguientes razones : ";


    private $apiContext;
    public function constructPayment(){
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );
        $this->apiContext->setConfig($payPalConfig['settings']);

    }

    // Limpia 1 elemento y todos del carrito
    public function clearCart($userId){
        \Cart::session(auth()->user()->id)->clearItemConditions($userId);
        \Cart::session(auth()->user()->id)->remove($userId);        
        \Cart::session(auth()->user()->id)->clear();
        \Cart::session(auth()->user()->id)->clearCartConditions();
        return back();
    }    

    // Limpia todos los elementos del carrito

    public function clearAllCart(){
        \Cart::session(auth()->user()->id)->clear();
        \Cart::session(auth()->user()->id)->clearCartConditions();
    }

    
    public function validationFieldDescriptionContract(Request $request){
        $validationConfirm = $this->validationRegisterContract($request);
        if($validationConfirm->fails()){
            $errorRegisterFailed = self::ERRORREASON; 
            return back()->withErrors($validationConfirm,'contractProccessForm')->with('contractFailed',$errorRegisterFailed)->withInput();
        }else{
            $this->clearAllCart();
            \Cart::session(auth()->user()->id)->add(array(
                'id' => $request->serviceOffer, // inique row ID
                'name' => $request->serviceName,
                'price' =>$request->priceOffer,
                'quantity' =>1,            
                'attributes' => array(
                    'userOffer' => $request->userOffer,
                    'dateForm'=>$request->dateForm,
                    'hourForm'=>$request->hourForm,
                    'addressForm'=>$request->addressForm,
                    'descriptionForm'=>$request->descriptionForm,
                    'typeOfJob'=>$request->typeOfJob,
                    'img1'=>$request->img1,
                    'statusInitial'=>$request->statusInitial,
                    'userNameProvider'=>$request->userNameProvider

                ),
            ));                     
            return redirect()->route('index.checkout');
        }

    }

    public function checkoutPaymentView(){
        return view('checkoutPayment');
    }

    public function contractProcess(Request $request){
        $validationConfirm = $this->validationRegisterContract($request);
        $this->redirectInCaseErrorValidation($validationConfirm);
        // 1 : Para oficios
        // 2 : Para talentos
        $this->contractCreate($request);
    }

    public function contractCreate(Request $request){
        $message='';
        switch($request->typeOfJob){
            case 1:
                $message = "Contratado el oficio correctamente";
                Contract::create([
                    'con_contract_date'=>$request->dateForm,
                    'con_hour'=>$request->hourForm,
                    'con_address'=>$request->addressForm,
                    'con_description'=>$request->descriptionForm,
                    'con_price'=>$request->priceOffer,
                    'con_initial'=>Carbon::now(),
                    'use_offer'=>$request->userOffer,
                    'use_receive'=>auth()->user()->id,
                    'use_occ_id'=>$request->serviceOffer,
                    'con_status'=>1,
                ]);
                break;
            case 2:
                $message = "Contratado el talento correctamente";
                Contract::create([
                    'con_contract_date'=>$request->dateForm,
                    'con_hour'=>$request->hourForm,
                    'con_address'=>$request->addressForm,
                    'con_description'=>$request->descriptionForm,
                    'con_price'=>$request->priceOffer,
                    'con_initial'=>Carbon::now(),
                    'use_offer'=>$request->userOffer,
                    'use_receive'=>auth()->user()->id,
                    'use_tal_id'=>$request->serviceOffer,
                    'con_status'=>1,
                ]);

                break;
            default:
                $message = "Error no se pudo crear el contrato";
                break;
        }
        return $message;
    }

    public function validationRegisterContract(Request $request){
        $dateNow = Carbon::now();
        $dateLimit = Carbon::now()->addMonth(1); 
        // dd($request->all());
        $fieldCreate= [
            'userOffer'=>'required|integer|min:0',
            'priceOffer'=>'required|numeric|between:0,9999.99',
            'dateForm'=>'required|date|after_or_equal:'.$dateNow.'|before:'.$dateLimit,
            'hourForm'=>'required',
            'addressForm'=>'required|string',
            'descriptionForm'=>'required|string',
            'serviceOffer'=>'required'
        ];
        $messageError=[
            'required' =>'Este campo ":attribute" es obligatorio',
            'integer'=>'":attribute" Debe ser numero entero',
            'between:0,9999.99'=>'":attribute" Fuera del rango',
            'numeric'=>'":attribute" Debe ser numerico',
            'min:0'=>'":attribute" Minimo es 0',
            'string'=>'":attribute" Debe ser texto',
            'before'=>'":attribute" debe ser anterior a :date'
        ];
        $validacion = Validator::make($request->all(),$fieldCreate,$messageError);
        return $validacion;        
    }

    public function redirectInCaseErrorValidation($validation){
        if($validation->fails()){
            $errorRegisterFailed = self::ERRORREASON; 
            return back()->withErrors($validation,'contractProccessForm')->with('contractFailed',$errorRegisterFailed)->withInput();
        }
    }

    public function processPaymentServiceContract()
    {
        
        $this->constructPayment();
        
        
        // Validacion de contrato
        $algo = "";   
        $algo = $this->getOneItemFromCart();     
        $requestItems = $this->generateRequestFromArray($algo);       
        $validationConfirm = $this->validationRegisterContract($requestItems);
        $this->redirectInCaseErrorValidation($validationConfirm);
        // Fin de validacion de contrato
        $payer = new Payer(); //Usuario que paga
        $payer->setPaymentMethod('paypal');

        $amount = new Amount(); // Total a pagar
        $amount->setTotal($requestItems->priceOffer);
        $amount->setCurrency('USD');

        $transaction = new Transaction(); //Crea transaccion
        $transaction->setAmount($amount);
        $transaction->setDescription($requestItems->descriptionForm);

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl) // En caso de que el usuario no page o page
            ->setCancelUrl($callbackUrl); //Presiono cancelar

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        //Aca se procesa el pago
        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }


    public function payPalStatus(Request $request)
    {
        $this->constructPayment();

        // Validacion de datos
        $requestItems = new Request([]);
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect(route('index.checkout'))->with('paymentFailedOrCancel',$status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Ejecutar pago **/
        $result = $payment->execute($execution, $this->apiContext);
        if ($result->getState() === 'approved') {
            $status = 'El pago fue ejecutado correctamente, y el contrato se realizo de manera satisfactoria';

            //  Se registra el contrato
            $algo = "";   
            $algo = $this->getOneItemFromCart();      
            $requestItems = $this->generateRequestFromArray($algo);       
            $this->contractProcess($requestItems);
            $this->clearAllCart();
            // Fin de registro de contrato
            if($requestItems->typeOfJob == 1){
                return redirect(route('showProfileServiceOccupation',$requestItems->serviceOffer))->with('statusPaymentSuccess',$status);
            }
            if($requestItems->typeOfJob == 2){
                return redirect(route('showProfileServiceTalent',$requestItems->serviceOffer))->with('statusPaymentSuccess',$status);

            }

        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        if($requestItems->typeOfJob == 1){
            return redirect(route('showProfileServiceOccupation',$requestItems->serviceOffer))->with('statusPaymentFailed',$status);
        }
        if($requestItems->typeOfJob == 2){
            return redirect(route('showProfileServiceTalent',$requestItems->serviceOffer))->with('statusPaymentFailed',$status);

        }


    }    
    // Pagos grupales
    // Stripe

    // Pago con stripe
    public function processPaymentStripe(Request $request){
        $algo = "";   
        if(Route::currentRouteName() == 'proccessPaymentStripe2'){
            $status = 'El pago fue ejecutado correctamente. ';
            $requestItems = new Request([
                'serviceOffer'=>$request->serviceOffer,                
                'typeOfJob'=>3
            ]);
            $valorMaximo=  $request->cantidadMeta - $request->cantidadActual; 
            $request->validate([
                'serviceOffer' => 'required|numeric|min:0',
                'cantidadDonacion' => 'required|lte:cantidadMeta|numeric|min:1|max:'.$valorMaximo.''
            ]);
    
            // Actualiza reto
            DB::transaction(function () use($request) {
                $change = use_occ::find($request->serviceOffer);
                $change->increment('precio_actual',$request->cantidadDonacion);
                $change->IntermediateChange()->increment('cha_count',1);
                //  Desctiva en caso de que llegue al tope 
                $change2 = use_occ::find($request->serviceOffer);
                if($change2->precio<=$change2->precio_actual){
                    $change2->IntermediateChange->update([
                            'cha_active'=>false
                    ]);    
                }
    
            });
        }else{
            //  Se registra el contrato
            $algo = $this->getOneItemFromCart();      
            $requestItems = $this->generateRequestFromArray($algo);       
            $this->contractProcess($requestItems);
            $this->clearAllCart();
            $status = 'El pago fue ejecutado correctamente, y el contrato se realizo de manera satisfactoria';
        }
        // Fin de registro de contrato
        switch ($requestItems->typeOfJob) {
            case 1:
                return redirect(route('showProfileServiceOccupation',$requestItems->serviceOffer))->with('statusPaymentSuccess',$status);
                break;
            case 2:
                return redirect(route('showProfileServiceTalent',$requestItems->serviceOffer))->with('statusPaymentSuccess',$status);
                break;
                
            default:
                return redirect(route('showProfileServiceRetos',$requestItems->serviceOffer))->with('statusPaymentSuccess',$status);
                break;
        }
    }

    // Ayudantes
    public function getOneItemFromCart(){
        $itemOne="";
        foreach (\Cart::session(auth()->user()->id)->getContent() as $itemD) {
            $itemOne=$itemD;
            break;
        }
        return $itemOne;
        
    }
    public function generateRequestFromArray($arrayToRequest){

        
        $requestItems = new Request([
            'dateForm'=>$arrayToRequest->attributes->dateForm,
            'hourForm'=>$arrayToRequest->attributes->hourForm,
            'addressForm'=>$arrayToRequest->attributes->addressForm,
            'descriptionForm'=>$arrayToRequest->attributes->descriptionForm,
            'priceOffer'=>$arrayToRequest->price,
            'userOffer'=>$arrayToRequest->attributes->userOffer,
            'serviceOffer'=>$arrayToRequest->id,
            'typeOfJob'=>$arrayToRequest->attributes->typeOfJob,
            'statusInitial'=>$arrayToRequest->attributes->statusInitial
        ]);
        return $requestItems;

    }

    public function contractStateTalent($id){
        $contr = Contract::findOrFail($id);
        $userOff = User::findOrFail($contr->use_offer);
        $dataTal = use_tal::findOrFail($contr->use_tal_id);
        $servTalen = ServiceTalent::findOrFail($dataTal->ser_tal_id);
        return view('estadoContratoTal',compact('id','contr','servTalen','userOff','dataTal'));
    }

    public function contractStateOcupation($id){
        $contr = Contract::findOrFail($id);
        $userOff = User::findOrFail($contr->use_offer);
        $dataOcup = use_occ::findOrFail($contr->use_occ_id);
        $servOcupp = ServiceOccupation::findOrFail($dataOcup->ser_occ_id);
        return view('estadoContratoOcu',compact('id','contr','servOcupp','userOff','dataOcup'));
    }

    public function ejectContract(Request $request){
        $request->validate([
            'contractId' => 'required'
        ]);
        $contr = Contract::findOrFail($request->contractId);
        $contr->con_status = 2;
        $contr->save();
        $messageCon = "El contrato entró en ejecución";
        return back()->with('serviceMessage',$messageCon);
    }

    public function finishContract(Request $request){
        $request->validate([
            'contractId' => 'required|integer'
        ]);
        $contr = Contract::findOrFail($request->contractId);
        $contr->con_status = 3;
        $contr->save();
        $message = "Su contrato ha sido finalizado";
        return back()->with('serviceMessage',$message);
    }


}
