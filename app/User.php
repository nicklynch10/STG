<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'email', 'password', 'bio', 'address','rate','lesson_price','personal_lessons','monday','monday_start','monday_finish','tuesday','tuesday_start','tuesday_finish','wednesday','wednesday_start','wednesday_finish','thursday','thursday_start','thursday_finish','friday','friday_start','friday_finish','saturday','saturday_start','saturday_finish','sunday','sunday_start','sunday_finish'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function videos(){
        return $this->hasMany('App\Video');
    }
    public function watches(){//as a pro rturned is users
        return $this->hasMany('App\Watch');
    }
    public function watches_user(){//as a user rturned are pros
        return $this->hasMany('App\Watch');
    }
    public function hires(){
        return $this->hasMany('App\Hire');
    }
    public function hires_pro(){
        return $this->hasMany('App\Hire', 'pro_id');
    }
    public function ratings(){
        return $this->hasMany('App\Rating');
    }
     public function ratings_pro(){
        return $this->hasMany('App\Rating', 'pro_id');
    }
    public function clients(){
        return $this->hasMany('App\Client');
    }
    public function clients_pro(){
        return $this->hasMany('App\Client', 'pro_id');
    }
    public function pros(){//pros as a client
        return $this->hasMany('App\Client', 'pro_id');
    }
     public function playlists(){
        return $this->hasMany('App\Playlist');
    }
    public function playlist_owners(){
        return $this->hasMany('App\Playlist_owner', 'user_id');
    }
    public function testimonials(){
        return $this->hasMany('App\Testimonial');
    }
     public function testimonials_pro(){//as a pro rcieved are testimonials written about you
        return $this->hasMany('App\Testimonial', 'pro_id');
    }
     public function events(){
        return $this->hasMany('App\Event');
    }
    public function events_pro(){
        return $this->hasMany('App\Event', 'pro_id');
    }
    public function options(){
        return $this->hasMany('App\Option');
    }
    public function carts(){
        return $this->hasMany('App\Cart');
    }
    public function carts_pro(){
        return $this->hasMany('App\Cart','pro_id');
    }
    public function references(){
        return $this->hasMany('App\User', 'reference_id');
    }
     public function reference(){
        return $this->belongsTo('App\User', 'reference_id');
    }
    public function academies(){
        return $this->belongsToMany('App\Academy');
    }
    public function unavailable(){
        return $this->hasOne('App\Unavailable');
    }
    public function course(){
        return $this->belongsTo('App\Academy', 'course_id');
    }
    public function payments(){
        return $this->hasMany('App\Payment');
    }
    public function payouts(){
        return $this->hasMany('App\Payouts');
    }
    public function credits(){
        return $this->hasMany("App\Credit");
    }
    public function credits_pro(){
        return $this->hasMany("App\Credit",'pro_id');
    }
    public function vimeos(){
        return $this->hasMany('App\Vimeo');
    }
    public function vimeos_student(){
        return $this->hasMany('App\Vimeo','student_id');
    }
     public function vimeos_pro(){
        return $this->hasMany('App\Vimeo','pro_id');
    }
    public function fv(){
        return $this->belongsTo('App\Vimeo', 'fv_id');
    }
    public function dtl(){
        return $this->belongsTo('App\Vimeo', 'dtl_id');
    }
    public function camps(){
        return $this->hasMany('App\Camp');
    }
    ///helpers...
    public function proper_time($time){
        if(!isset($time))return;
        $new = (int)explode(":",$time)[0];
        if($new==0)return "12 AM";
        if($new>12) return ($new-12)." PM";
        return $new." AM";
    }
     public function flip_collection($collect){
        if(!isset($collect))return $collect;
        $temp = collect([]);
        foreach($collect as $col){
            $temp = $temp->prepend($col);
        }
        return $temp;
    }
    public function full_name(){
        return $this->firstname." ".$this->lastname;
    }
    public function morphname(){
        return $this->full_name();
    }
    public function avg_rating(){
                $total = 0;
                $track = 0;
                $avg = "N/A";
          foreach ($this->ratings_pro as $rating) {
                    $total += (int)$rating->rating;
                    $track+= 1;
                }
                if($track>0){
                    $avg = $total/$track;
                }
                return $avg;
    }

    public function get_cart_amount(){
        $price = 0;
    foreach($this->carts->where('paid',"0")->where('active',"1") as $c){
        $price += (int)$c->price;
        }

        return $price;
    }

    // public function notify($obj){
    //     try{
    //         parent::notify($obj);
    //     } catch(\Exception $e){
    //         echo "invalid email: ".$e->getMessage();
    //     }
    // }

    public function fees(){
         $fees = 0;
        if($this->pro){
        if(!$this->carts_pro || !$this->carts_pro->where('paid', 1))return 0;
        foreach ($this->carts_pro->where('paid', 1) as $c) {
            $fees += $c->price*$c->percentfee + $c->flatfee;
            }
        }else{
             if(!$this->carts || !$this->carts->where('paid', 1))return 0;
              foreach ($this->carts->where('paid', 1) as $c) {
            $fees += $c->price*$c->percentfee + $c->flatfee;
            }
        }
        return $fees;
    }

    public function find_carts(){
        $collect = collect([]);
        $c1 = $this->carts->where('paid',"0")->where('active',"1");
        //$c2 = $this->carts->where('paid',"0")->where('active',1);
        //$c1->union($c2);
        return $c1;
    }
}
