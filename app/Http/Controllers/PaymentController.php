<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Payment;
use GuzzleHttp\Client;

class PaymentController extends Controller
{//////out of date!!!!! now in payout controller
    
    public function pay(Request $r){
    	$seth = User::all()->where('firstname','Seth')->first();
    	if(Auth::check())$user = Auth::user();
    	else $user = false;

$paypal_email = 'Swingtipsgolf-facilitator@gmail.com';
$return_url = url('/cart');
$cancel_url = url('/cart');
$notify_url = url("/return");

$item_name = $user->morphname()."'s Cart";
$item_amount = $user->get_cart_amount();


// Check if paypal request or response//check removed
//!isset($r->txn_id) && !isset($r->txn_type)
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	
	$querystring .= "amount=".urlencode($item_amount)."&";
	$querystring .= "item_name=".urlencode($item_name)."&";
	
	
	//loop for posted values and append to querystring
	foreach($r->all() as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	$querystring .= "&custom=".$user->id;

	// Redirect to paypal IPN
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit();

}//end func

protected function check_txnid($tnxid){
	return true;
	// $valid_txnid = true;
	// //get result set
	// $sql = mysql_query("SELECT * FROM `payments` WHERE txnid = '$tnxid'", $link);
	// if ($row = mysql_fetch_array($sql)) {
	// 	$valid_txnid = false;
	// }
	// return $valid_txnid;
}
protected function check_price($price, $id){
return true;
}
////////////////////////////////////////////
protected function updatePayments($data){
		$p = new Payment;
		$p->txnid = (string)$data["txn_id"];
		$p->payment_amount = (string)$data["payment_amount"];
		$p->payment_status = (string)$data["payment_status"];
		$p->itemid = (string)$data["item_number"];
		$p->createdtime = date("Y-m-d H:i:s");
		$p->save();
		$user = User::find((int)$data['custom']);
		if($user)$p->user()->associate($user);
		$p->save();
		return $p->id;
}
public function return(Request $r){
	// Response from Paypal
	 //$seth = User::all()->where('firstname','Seth')->first();
	 //response does get here
	 //$seth->bio = $r;
	 //$seth->save();
	//if(!$r->txn_id && !$r->txn_type)return "no access";

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($r->all() as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	$p = new Payment;
	$p->txnid = $r->txn_id;
	$p->payment_amount = $r->mc_gross;
	$p->payment_status = $r->payment_status;
	$p->itemid = $r->item_number;
	$p->createdtime = date("Y-m-d H:i:s");
	$temp_user = User::find((int)$r->custom);
	$p->user()->associate($temp_user);
	$user = $temp_user;

	// assign posted variables to local variables
	// $data['item_name']			= $r->item_name;
	// $data['item_number'] 		= $r->item_number;
	// $data['payment_status'] 	= $r->payment_status;
	// $data['payment_amount'] 	= $r->mc_gross;
	// $data['payment_currency']	= $r->mc_currency;
	// $data['txn_id']				= $r->txn_id;
	// $data['receiver_email'] 	= $r->receiver_email;
	// $data['payer_email'] 		= $r->payer_email;
	// $data['custom'] 			= $r->custom;

	// post back to PayPal system to validate
// $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
// $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
// //$header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; change with the line below
// $header .= "Content-Length: " . strlen($req) . "\r\n";
// $header .= "Host: www.sandbox.paypal.com\r\n"; //and add this line

$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Host: www.sandbox.paypal.com\r\n";  
// www.paypal.com for a live site
$header .= "Content-Length: " . strlen($req) . "\r\n";
$header .= "Connection: close\r\n\r\n";

	$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
	if (!$fp) {
		// HTTP ERROR
					
	} else {
	

		fputs($fp, $header . $req);

		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			
			if (strcmp(trim($res), "VERIFIED") == 0 || strtoupper(trim($res)) == "VERIFIED") {
				
				
				// Used for debugging
				// mail('nmlynch10@gmail', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
				// Validate payment (Check unique txnid & correct price)
				$valid_txnid = $this->check_txnid($p->txnid);
				$valid_price = $this->check_price($p->payment_amount, $p->item_number);
				// PAYMENT VALIDATED & VERIFIED!
				if ($valid_txnid && $valid_price) {
					$p->save();
					//$p->set();

					foreach ($user->carts->where('paid',"0")->where('active',"1") as $c) {
			    		$c->payment()->associate($p);
			            $c->paid = 1;
			    		$c->save();
			    		$type = $c->find_type();
			    	try {
   						 $c->$type->send();
					} catch (\Exception $e) {
    					$er = new Error;
    					$er->type = 'cart';
    					$er->type_id = $c->id;
    					$er->description = $e->getMessage();
    					$er->user()->associate(Auth::user());
    					$er->save();
					}
				      	
			    		
			    	}

					
					if ($orderid) {
						// Payment has been made & successfully inserted into the Database
					} else {
						// Error inserting into DB
						// E-mail admin or alert user
						// mail('user@domain.com', 'PAYPAL POST - INSERT INTO DB WENT WRONG', print_r($data, true));
					}
				} else {

					// Payment made but data has been changed
					// E-mail admin or alert user
				}
			
			} else if (strcmp (strtoupper(trim($res)), "INVALID") == 0) {

				// PAYMENT INVALID & INVESTIGATE MANUALY!
				// E-mail admin or alert user
				// $seth = User::all()->where('firstname','Seth')->first();
				// 	$seth->bio = 'Invalid!!';
				// 	$seth->save();
				// Used for debugging
				//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}
		}
	fclose ($fp);
	}

}
public function test(){
	$p = new Payment;
	$p->txnid = "some tnxid";
	$p->payment_amount = 10.00;
	$p->payment_status = "Completed";
	$p->itemid = "1";
	$p->createdtime = date("Y-m-d H:i:s");
	$temp_user = Auth::user();
	$p->user()->associate($temp_user);
	$p->save();
	$p->set();
	return redirect('/cart');
}
/////////////////////////////////////
//Below is PayOuts
//////////////////////////////////////
// public function sendPayout(){
//  $client = new Client();
//     $res = $client->request('POST', 'https://api.sandbox.paypal.com/v1/payments/payouts', [
//         'form_params' => [
//             'client_id' => 'test_id',
//             'secret' => 'test_secret',
//         ]
//     ]);

//     $result= $res->getBody();
//     dd($result);
// }


public function help(){
	$p = new Payment;
	$p->txnid = "80L86481U71920151";
    $p->payment_amount = "15.00";
    $p->payment_status = "Completed";
    $p->itemid = "1";
    $p->createdtime = "2016-10-17 13:31:19";
    $p->user_id = 3;
    $p->save();
return $p;
}
}//end class


