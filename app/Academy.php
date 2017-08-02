<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{

	protected $fillable = ['name','bio','email','lat','lng','city','state','zip','address','yoe','website','type'];
    public function users(){
    	return $this->belongsToMany('App\User');
    }
    public function morphname(){
    	return $this->name;
    }
    public function is_in(User $user){
    	foreach ($this->users as $u) {
    		if((int)$u->id == (int)$user->id)return true;
    	}
    	return false;
    }
    public function avg_rating(){
        $count = 0;
        $total = 0;
        foreach ($this->users as $k=>$u) {
            if($u->avg_rating() != 'N/A'){
            $total+=$u->avg_rating();
            $count++;
            }
        }
        if($count == 0)return 'N/A';
        return $total/$k;
    }

}
