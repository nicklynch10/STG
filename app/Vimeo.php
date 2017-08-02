<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use GuzzleHttp\Client as Client3;

class Vimeo extends Model
{

	protected $auth_key = '44f10dd8ae006a99b148227b97752204';

    public function user(){
    	return $this->belongsTo("App\User");
    }
    public function playlist(){
    	return $this->belongsTo("App\Playlist");
    }
    public function hire(){
    	return $this->belongsTo("App\Hire");
    }

    public function response(){
      return $this->hasOne("App\Hire");
    }

    public function pro(){
    	return $this->belongsTo("App\User", 'pro_id');
    }
    public function student(){
    	return $this->belongsTo("App\User", 'student_id');
    }
////////////////////////////////////////////////////////
    public function set($redirect = "/locker"){//calls a query to set up a new vid
     if(env('DB_CONNECTION') != 'dev'){
    $body = '{
     "redirect_url":"swingtipsgolf.com/video_processed"
    }';
    }else{
      $body = '{
     "redirect_url":"dev.swingtipsgolf.com/video_processed"
    }';
    }
    
    $client = new Client3();
	$res = $client->request('POST', 'https://api.vimeo.com/me/videos', [
	'headers' => ['Content-Type' => 'application/json',"Authorization"=>'Bearer '.$this->auth_key],
	'body'=>$body
	]);
       $response = $res->getBody();
       $response = json_decode($response);
       $this->upload_link = $response->upload_link_secure;
       $this->ticket_id = $response->ticket_id;
       $this->redirect = $redirect;
       $this->user()->associate(Auth::user());
       $this->save();
    }
    public function play(){
    $client = new Client3();
    $res = $client->request('GET', 'https://api.vimeo.com/videos/'.$this->vim_id, [
    'headers' => ['Content-Type' => 'application/json',"Authorization"=>'Bearer '.$this->auth_key]
    ]);
      $response = $res->getBody();
      $response = json_decode($response);
      if(isset($response)&&isset($response->files) && $response&&$response->files&&$response->files){
        if(isset($response->files[0])&&$response->files[0] &&isset($response->files[0]->link)&&$response->files[0]->link)$this->download_link_hd = $response->files[0]->link;
        if(isset($response->files[1])&&$response->files[1] &&isset($response->files[1]->link)&&$response->files[1]->link)$this->download_link_sd = $response->files[1]->link;
        $this->save();
      }
    return "all set";
    }
}
