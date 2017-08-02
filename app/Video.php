<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Auth;
use Carbon\Carbon;

class Video extends Model
{
  protected $fillable = [
        'user_id','title', 'description', 'url', 'type1', 'type2','type3',
    ];

    public function user(){
    	return $this->belongsTo("App\User");
    }
    public function playlist(){
    	return $this->belongsTo("App\Playlist");
    }
    public function hire(){
    	return $this->belongsTo("App\Hire");
    }
    public function other(){
    	return $this->belongsTo("App\User", 'other_id');
    }

    public function set(){
        //$this->cover_shot();
        $this->to_mp4();
    }

    public function cover_shot(){
             if($this->cover)return;
             $cover = pathinfo($this->url, PATHINFO_FILENAME);
             $full_url = '"/'.$this->url.'"';
             $full_new_url = '"/uploads/'.$cover.'.jpg"';
             $cmd = '/tmp/ffmpeg -y -ss 00:00:00 -i '.$full_url.' -vframes 1 -q:v 2 '.$full_new_url;
             shell_exec($cmd);
             $this->cover = '/uploads/'.$cover.'.jpg';
             $this->save();

    }

    public function to_mp4(){
        if($this->converted)return;
        set_time_limit (5000);
        
        //$cmd = 'ffmpeg -i '.$this->url.' -codec copy videos/coverted-'.$filename.'.mp4';
        //$cmd = 'ffmpeg -i '.$this->url.' -b 1500k -vcodec libx264 -g 30 videos/coverted-'.$filename.'.mp4';
        //$cmd = 'ffmpeg -i '.$this->url.' -c copy videos/coverted-'.$filename.'.mp4';
        // $full_url = '/'.$this->url;
        // $new_name = 'converted-1234-'.$filename.'.mp4';
        // $full_url_new ='/videos/'.$new_name;
        // ///tmp/ffmpeg2/ffmpeg -i /videos/1.mp4 -q:v 3 outher.mp4 -y
        // $cmd = '/tmp/ffmpeg2/ffmpeg -i "'.$full_url.'" -q:v 3 "'.$full_url_new.'" -y';
        ///tmp/ffmpeg2/ffmpeg -y -ss 00:00:00 -i https://s3.amazonaws.com/swingtips/videos/3-43-2016-09-03%2015%3A54%3A13.mp4 -vframes 1 -q:v 2 hey.jpg
        ///tmp/ffmpeg2/ffmpeg -i https://s3.amazonaws.com/swingtips/videos/3-43-2016-09-03%2015%3A54%3A13.mp4 2>&1
        ///tmp/ffmpeg2/ffmpeg -i "https://s3.amazonaws.com/swingtips/videos/3-43-2016-09-03 2015:54:13.mp4" -q:v 3 /var/app/current/public/videos/help4.mp4 -y 2>&1
        //wget and then ffmpeg works!!!
        //wget "https://s3.amazonaws.com/swingtips/videos/3-43-2016-09-03%2015%3A54%3A13.mp4" 2>&1
        // /tmp/ffmpeg2/ffmpeg -i "3-43-2016-09-03 15:54:13.mp4" -q:v 3 /var/app/current/public/videos/help4.mp4 -y 2>&1
        ///var/app/current/public is the path
        /////////////////////////////////////////////////////////////////////////////////////
        //new as of 9/5/16
        $filename = pathinfo($this->url, PATHINFO_FILENAME);
        $file_extension = pathinfo($this->url, PATHINFO_EXTENSION);
        $now = Carbon::now();
        $new_name = "local-converted-".$this->id.'-'.$now->minute.$now->hour.$now->day.'.mp4';
        $cmd1 = 'wget "'.$this->url.'" 2>&1';
        $cmd1.=' && ';
        //$cmd1 .= '/tmp/ffmpeg -i "'.$filename.'.'.$file_extension.'" -q:v 3 "/var/app/current/public/videos/'.$new_name.'" -y 2>&1';
        //old one works but takes too long

        $cmd1 .= '/tmp/ffmpeg -i "'.$filename.'.'.$file_extension.'" -codec copy "/var/app/current/public/videos/'.$new_name.'" -y 2>&1';
        //this one converrts it, make sure ffmpeg is there though
        //wget "https://s3.amazonaws.com/swingtips/videos/unconverted-31-281421.mp4" 2>&1 && /tmp/ffmpeg2/ffmpeg -i "unconverted-31-281421.mp4" -q:v 3 "/var/app/current/public/videos/local-converted-31-281421.mp4" -y 2>&1
        //original above
        //wget "https://s3.amazonaws.com/swingtips/videos/unconverted-31-281421.mp4" 2>&1 && /tmp/ffmpeg2/ffmpeg -i "/var/app/current/public/unconverted-31-281421.mp4" -q:v 3 "/var/app/current/public/videos/local-converted-31-281421.mp4" -y 2>&1
        //https:\/\/s3.amazonaws.com\/swingtips\/videos\/unconverted-34-531521.mp4

         //wget "https://s3.amazonaws.com/swingtips/videos/unconverted-34-531521.mp4" 2>&1 && /tmp/ffmpeg -i "/var/app/current/public/unconverted-34-531521.mp4" -q:v 3 "/var/app/current/public/videos/local-converted-31-281421ww.mp4" -y 2>&1

        ///tmp/ffmpeg -y -ss 00:00:00 -i "/var/app/current/public/unconverted-34-531521.mp4" -vframes 1 -q:v 2 test.jpg 2>&1

        echo $cmd1; //seems to work
        echo '<br>';
        exec($cmd1, $o);
        print_r($o);
        $this->url = '/var/app/current/public/videos/'.$new_name;
        $this->converted = 1;
        $this->save();
        $this->to_aws();
        // $this->filesize = (int)filesize($this->url);
        // $data = (int)$this->user->data;
        // if(!$data)$data = 0;
        // $this->user->data = (string)($data+$this->filesize);
        // $this->user->save();

    }

    public function to_aws(){
     $now = Carbon::now();
     $f = new File($this->url);//note will not work with playlist i think
     if($this->converted)$tname = 'converted-';
     else $tname = 'unconverted-';
     $tname .= $this->id.'-'.$now->minute.$now->hour.$now->day.'.'.$f->guessExtension();
     $name = Storage::disk('s3')->putFileAs('videos', $f, $tname, 'public');
    // $name = Storage::disk('s3')->putFile('videos', $f, 'public');
     //tthe above line overwrites duplicate files
     $this->url = Storage::disk('s3')->url($name);
     $this->in_aws = 1;
     $this->save();
    }
}
//  mkdir /opt/newfolder -y 2>&1
