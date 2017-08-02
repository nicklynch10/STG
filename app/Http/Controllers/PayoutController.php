<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use App\Payout;
use App\Payment;
use Auth;
use App\User;
use App\Notifications\PayoutSent;
class PayoutController extends Controller
{
	protected $access_token = false;

  //not live below (sandbox)

	protected $client_id = 'AeBCDo5WCXGyzlFdgz3VA0WvLyOgEoOKUZ3pnaiz3i_AAqo9uUqiSGuzGPldP4exwDVXBs-Z6k8XwdSf';
  protected $secret_id = 'EC8Zx3KNh9mbdnnrMQ3K_pYaCDDqw8HYjDbRiHQo41l69n397R6WoBY8360F5ZPPBu9P2gzqDtqlRqrN';
  protected $connect_endpoint = 'https://api.sandbox.paypal.com/v1/oauth2/token';
    protected $payout_endpoint = 'https://api.sandbox.paypal.com/v1/payments/payouts?sync_mode=true';
  protected $payment_endpoint = 'https://api.sandbox.paypal.com/v1/payments/payment';
  protected $is_live = false;

    //account
    //Swingtipsgolf-facilitator@gmail.com
    //client id
    //AeBCDo5WCXGyzlFdgz3VA0WvLyOgEoOKUZ3pnaiz3i_AAqo9uUqiSGuzGPldP4exwDVXBs-Z6k8XwdSf
    //secret 
    //EC8Zx3KNh9mbdnnrMQ3K_pYaCDDqw8HYjDbRiHQo41l69n397R6WoBY8360F5ZPPBu9P2gzqDtqlRqrN
    //?????? might be wrong below
    //"access_token$sandbox$8byvcxt6qn549m9s$c539989d6ed080e137b4c3be67207cfb"

///////////////////////////////////////////////////////////
    ////////////////////////////////////////////
    //THIS IS LIVE
    //protected $client_id = 'AX07mZJ5xBN2AKkkJYE0_BjP1PtAbfP0j6HEcSSxYUS7SbYTfiOC3S_-HcGPOMPbj30lC44u7sYBXC3M';
    //protected $secret_id = 'EKNxVhY7HQ3dszINkV9qPTsQDDW17Nh116IZmZSq2pTcXnN82Fvcf3ZHfk6fT4r4fRMnuP2_gJg-50Vl';

    //remember there are at least 3 sandbox links, also need to change the email from the users paypal email (for a payout)
    public function __construct()
    {

      //this runs so if the env is not dev it converts it to live.
       if(env('DB_CONNECTION') != 'dev'){
        $this->client_id = 'AX07mZJ5xBN2AKkkJYE0_BjP1PtAbfP0j6HEcSSxYUS7SbYTfiOC3S_-HcGPOMPbj30lC44u7sYBXC3M';
        $this->secret_id = 'EKNxVhY7HQ3dszINkV9qPTsQDDW17Nh116IZmZSq2pTcXnN82Fvcf3ZHfk6fT4r4fRMnuP2_gJg-50Vl';
        ///////////////////////////
        $this->connect_endpoint = 'https://api.paypal.com/v1/oauth2/token';
        $this->payout_endpoint = 'https://api.paypal.com/v1/payments/payouts?sync_mode=true';
        $this->payment_endpoint = 'https://api.paypal.com/v1/payments/payment';
        $this->is_live = true;
      }
    	$client = new Client();
      //was 'https://api.sandbox.paypal.com/v1/oauth2/token'
      //note that there is another request below
	$res = $client->request('POST', $this->connect_endpoint, [
	'headers' => ['Accept' => 'application/json','Accept-Language'=>'en_US'],
    'auth' => [$this->client_id,$this->secret_id],
    'body' => 'grant_type=client_credentials',
]);
       $response = $res->getBody();
       $response = json_decode($response);
       $this->access_token = $response->access_token;
    }



    public function payout(){
    	$client = new Client();
    	$user = Auth::user();
      if(!$user || !$user->paypal_email)return view('home.message',['message'=>"You must have a paypal email to continue. Please create a paypal if you do not have one and input your email in you account information."]);

      //this was the test email
      if($this->is_live){
        $paypal_email = $user->paypal_email;
      }else{
        $paypal_email = 'Swingtipsgolf-buyer@gmail.com';
      }
      $balance = $user->balance;
      //to go live change this

     $body = '{
      "sender_batch_header":{
        "email_subject":"Swing Tips Golf Payment"
      },
      "items":[
        {
          "recipient_type":"EMAIL",
          "amount":{
            "value":'.$balance.',
            "currency":"USD"
          },
          "receiver":"'.$paypal_email.'",
          "note":"Payment from Swing Tips Golf",
          "sender_item_id":"1"
        }
      ]
    }';
// was 'https://api.sandbox.paypal.com/v1/payments/payouts?sync_mode=true'
	$res = $client->request('POST',  $this->payout_endpoint, [
	'headers' => ['Content-Type' => 'application/json',"Authorization"=>'Bearer '.$this->access_token],
    'body' => $body,
]);


		     $response = $res->getBody();
       	 $response = json_decode($response);
       	 $p = new Payout;
       	 if(isset($response->batch_header)){
       	 $p->batch_status = $response->batch_header->batch_status;
       	 $p->payout_batch_id = $response->batch_header->payout_batch_id;
       	 $p->time_created = $response->batch_header->time_created;
       	  	if(isset($response->batch_header->amount)){
       	 	$p->amount = round(floatval($response->batch_header->amount->value),2);
       	 	$p->currency = $response->batch_header->amount->currency;
       	 	}
       	 	if(isset($response->batch_header->fees)){
       	 	$p->fee = round(floatval($response->batch_header->fees->value),2);
       		 }
       	 }
       	 if(isset($response->items[0]) && isset($response->items[0]->payout_item)){
       	 	$p->note = $response->items[0]->payout_item->note;
       	 	$p->receiver_email = $response->items[0]->payout_item->receiver;
       	 if(isset($response->items[0]->errors)){
       	 	$p->errors = $response->items[0]->errors->name;
       	 }
       	 }
         $p->user()->associate($user);
       	 $p->save();
       	 $user->balance = 0;
       	 $user->save();
         

          $user->notify(new PayoutSent($p));
       	 return redirect('/locker');
    } //this should work

      public function payment(){
      $client = new Client();
      $user = Auth::user();
      $total = 0;
      $fee = 0;
      $squaredfee = 0;
      $contains_swingtip = false;
      $p = new Payment;
      $p->save();
      foreach($user->carts->where('paid',"0")->where('active',"1") as $c){
        $fee += $c->price*$c->percentfee + $c->flatfee;
        $total += $c->price;
        $squaredfee = $c->squaredfee;
        if($c->find_type() == 'hire')$contains_swingtip = true;
        $c->payment()->associate($p);
        $c->save();
      }
      if($total == 0) return back();
      $fee = (($total)*($total)*($squaredfee)) + $fee;
      $fee = round($fee,2);

      if($contains_swingtip && $fee<5.00)$fee = 5.00;
      // if($total>750.00)$fee = $total*.06;
      $total = round($total+ $fee,2);
      $p->payment_amount = $total;
      $p->payment_status = 'initiated';
      $p->user()->associate($user);
      $p->save();

     $body = '{
  "intent": "sale",
  "payer": {
    "payment_method": "paypal"
  },
  "transactions": [
    {
      "amount": {
        "total": "'.$total.'",
        "currency": "USD"
      },
      "description": "Swing Tips Golf uses PayPal to provide secure transactions.",
      "custom": "'.$p->id.'",
      "payment_options": {
        "allowed_payment_method": "INSTANT_FUNDING_SOURCE"
      },
      "item_list": {
        "items": [';
        $num_carts = count($p->carts);
        foreach ($p->carts as $key => $c) {
        $body .= '{
            "name": "'.$c->title.'",
            "description": "'.$c->description.'",
            "quantity": "1",
            "price": "'.($c->price).'",
            "currency": "USD"
          },';
        }
        $body .= '{
            "name": "Service Fee",
            "description": "Swing Tips Golf Fee",
            "quantity": "1",
            "price": "'.($fee).'",
            "currency": "USD"
          }';

     $body .= '],
      "shipping_address": {
          "recipient_name": "'.$user->morphname().'",
          "line1": "'.$user->address.'",
          "city": "'.$user->city.'",
          "state": "'.$user->state.'",
          "postal_code": "'.$user->zip.'",
          "country_code": "US"
        }
      }
    }
  ],
  "note_to_payer": "Contact us for any questions on your order.",
  "redirect_urls": {
    "return_url": "'.url("/proceed/".$user->id."/".$p->id).'",
    "cancel_url": "'.url('/cart').'"
  }
}';
//was 'https://api.sandbox.paypal.com/v1/payments/payment'
  $res = $client->request('POST', $this->payment_endpoint, [
  'headers' => ['Content-Type' => 'application/json',"Authorization"=>'Bearer '.$this->access_token],
    'body' => $body,
]);

         $response = $res->getBody();
         $response = json_decode($response);
         if($p->id != (int)$response->transactions[0]->custom && (float)$total != (float)$response->transactions[0]->amount->total)return 'verification failed';
         $p->pay_id = $response->id;
         $p->payment_status = $response->state;
         $p->get_link = $response->links[0]->href;
         $p->pay_link = $response->links[1]->href;
         $p->execute_link = $response->links[2]->href;
         $p->save();
         return redirect($p->pay_link);
      }

      public function proceed(User $user, Payment $p, Request $r){
        if((int)$user->id != (int)Auth::user()->id) return 'Payment was not completed, your account was not charged';
        $p_same = false;
        foreach ($user->payments->where('completed',0) as $payment) {
          if((int)$p->id == (int)$payment->id)$p_same = true;
        }
        if(!$p_same)return 'Payment was not completed, your account was not charged';
        if($r->paymentId != $p->pay_id)return 'Payment was not completed, your account was not charged';
        $client = new Client();
        $p->payer_id = $r->PayerID;
        $p->payment_status = 'allowed';
        $p->save();

  $body = '{ "payer_id" : "'.$p->payer_id.'" }';
  $res = $client->request('POST', $p->execute_link, [
  'headers' => ['Content-Type' => 'application/json',"Authorization"=>'Bearer '.$this->access_token],
    'body' => $body,
  ]);

  $response = $res->getBody();
  $response = json_decode($response);
  $p->payment_status = $response->state;
  $p->completed = 1;
  if(isset($response->payer->payer_info))$p->email = $response->payer->payer_info->email;
  $p->save();
  $p->set();
  return redirect('/paid/'.$p->id);

      }
      public function paid(Payment $p){
        if((int)Auth::user()->id != (int)$p->user->id)return redirect('/locker');
        return view('cart.purchased',['user'=>Auth::user(),'p'=>$p]);
      }
}



//curl https://api.sandbox.paypal.com/v1/payments/payment/PAY-6RV70583SB702805EKEYSZ6Y/execute/ \
  // -v \
  // -H 'Content-Type: application/json' \
  // -H 'Authorization: Bearer Access-Token' \
  // -d '{ "payer_id" : "7E7MGXCWTTKK2" }'