<?php

use Illuminate\Database\Seeder;
use App\Option;
use App\Hire;
use App\Playlist;
use App\Testimonial;
use App\Client;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $this->call(UsersTableSeeder::class);
         return false;


         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "60";
         $option->title = "1 Person Hourly Session";
         $option->description = "1 person hourly session";
         $option->active = "1";
         $option->quantity = "1";
         $option->price = "160";
         $option->people = "1";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "60";
         $option->title = "2 People Hourly Session";
         $option->description = "2 people hourly sessions";
         $option->active = "1";
         $option->quantity = "1";
         $option->price = "240";
         $option->people = "2";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "60";
         $option->title = "3 People Hourly Session";
         $option->description = "3 people hourly sessions";
         $option->active = "1";
         $option->quantity = "1";
         $option->price = "240";
         $option->people = "3";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "60";
         $option->title = "Series of 3, 1 Hour Sessions, For 1 person";
         $option->description = "Series of 3, 1 Hour Sessions";
         $option->active = "1";
         $option->quantity = "3";
         $option->price = "429";
         $option->people = "1";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "60";
         $option->title = "Series of 6, 1 Hour Sessions, For 1 Person";
         $option->description = "Series of 6, 1 Hour Sessions";
         $option->active = "1";
         $option->quantity = "6";
         $option->price = "749";
         $option->people = "1";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "60";
         $option->title = "Series of 3, 1 Hour Sessions, For 1 person";
         $option->description = "Series of 3, 1 Hour Sessions";
         $option->active = "1";
         $option->quantity = "3";
         $option->price = "429";
         $option->people = "1";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "30";
         $option->title = "Half Hour Session, For 1 Person";
         $option->description = "1 Half Hour Sessions";
         $option->active = "1";
         $option->quantity = "1";
         $option->price = "100";
         $option->people = "1";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "60";
         $option->title = "1 Hour Playing Lesson";
         $option->description = "Pick a local course to play for 1 hour";
         $option->active = "1";
         $option->quantity = "1";
         $option->price = "160";
         $option->people = "1";
         $option->save();

         $option = new Option;
         $option->user_id = "1";
         $option->minutes = "120";
         $option->title = "2 Hour Playing Lesson";
         $option->description = "Pick a local course to play for 2 hours";
         $option->active = "1";
         $option->quantity = "1";
         $option->price = "299";
         $option->people = "1";
         $option->save();


         $option = new Option;
         $option->user_id = "5";
         $option->minutes = "30";
         $option->title = "30 minute Lesson";
         $option->description = "a simple 30 miute lesson";
         $option->active = "1";
         $option->quantity = "1";
         $option->price = "50";
         $option->people = "1";
         $option->save();

         $this->call(VideoSeeder::class);

         

         $t = new Testimonial;
         $t->user_id = "4";
         $t->pro_id = "1";
         $t->title = "Changed my Swing!";
         $t->description = "When I started out sliced the ball every drive. After only two weeks. I now hit the ball 50 yard further and completely straight. I would recommend him to any competitive golfer.\r\n-Chris";
         $t->save();

         $t = new Testimonial;
         $t->user_id = "3";
         $t->pro_id = "1";
         $t->title = "Revolutionized my game";
         $t->description = "Seth took my game to the next level. I went from a decent for fun golfer to a serious tournament contender. Not a second was wasted Really = tepped up my game.-Nick";
         $t->save();

         $c = new Client;
         $c->user_id = "4";
         $c->pro_id = "1";
         $c->save();

         $c = new Client;
         $c->user_id = "4";
         $c->pro_id = "5";
         $c->save();

         $c = new Client;
         $c->user_id = "3";
         $c->pro_id = "1";
         $c->save();

         $c = new Client;
         $c->user_id = "2";
         $c->pro_id = "1";
         $c->save();









         // {"id":1,"firstname":"Seth","lastname":"Dichard","email":"ahoch@xebialabs.com","bio":"Seth brings over 15 years of professional teaching experience to his students at The Seth Dichard Golf Schools. He was first introduced to the golfing arena by his father at the young age of 8. His father, who owned and operated an off-course pro shop in Nashua, encouraged Seth to follow his dreams of becoming a professional golfer. He has since played and competed for over 30 years at the high school, collegiate and professional levels. In 2000, Seth graduated from Pfeiffer University in Misenheimer, N.C. as a member of the schools nationally ranked NCAA golf team.","propic":"https://s3.amazonaws.com/swingtips/imgs/d6ce389303107049fecfa0fba109f9da.jpeg","cover":"https://s3.amazonaws.com/swingtips/imgs/1c85801320d7d9a31f0af62989439668.jpeg","course_old":null,"course_id":null,"handicap":null,"age":"32","reference_id":null,"usage":"0","is_admin":"0","data":"0","alotted":"100","lat":"42.765366","lng":"-71.467567","city":"Nahua","state":"Nh","zip":"03060","address":"15 Macdonald Drive","country":"USA","pro":1,"approved":1,"requested":0,"experience":"While attending Pfeiffer, Seth became passionate about studying and teaching the game and has since worked with and mentored under Golf Digests and Golf Magazines Top PGA Instructor Dr. Jim Suttie. He continues to further his education every year studying the best players and teachers in the world.","why":"Through the years he has worked with several collegiate and high school teams in the area such as the Nashua High School and Umass Lowell Golf Teams. Seth also has previously assisted in golf conditioning programs.","file":null,"yoe":16,"website":"http:\/\/www.sethdichardgolf.com","accepts_lessons":null,"accepts_swingtips":0,"swingtip_price":"19.00","software":"V1 Golf","balance":"571.92","pending_balance":"0.00","paypal_email":"paypal@email.com","created_at":"2017-04-26 02:57:37","updated_at":"2017-06-06 21:38:28","field0":null,"field1":null,"field2":null,"field3":null,"field4":null,"field5":null,"field6":null,"field7":null,"field8":null,"field9":null,"field10":null,"field11":null,"field12":null,"field13":null,"field14":null,"field15":null,"field16":null,"field17":null,"field18":null,"field19":null,"shortgame0":null,"shortgame1":null,"shortgame2":null,"shortgame3":null,"shortgame4":null,"shortgame5":null,"shortgame6":null,"shortgame7":null,"shortgame8":null,"shortgame9":null,"shortgame10":null,"shortgame11":null,"shortgame12":null,"shortgame13":null,"shortgame14":null,"shortgame15":null,"shortgame16":null,"shortgame17":null,"shortgame18":null,"shortgame19":null,"general0":null,"general1":null,"general2":null,"general3":null,"general4":null,"general5":null,"general6":null,"general7":null,"general8":null,"general9":null,"general10":null,"general11":null,"general12":null,"general13":null,"general14":null,"general15":null,"general16":null,"general17":null,"general18":null,"general19":null,"specific0":null,"specific1":null,"specific2":null,"specific3":null,"specific4":null,"specific5":null,"specific6":null,"specific7":null,"specific8":null,"specific9":null,"specific10":null,"specific11":null,"specific12":null,"specific13":null,"specific14":null,"specific15":null,"specific16":null,"specific17":null,"specific18":null,"specific19":null,"account_setup":1,"address_setup":1,"questions_setup":0,"fv_id":null,"dtl_id":null,"swingtips_spent":"0.00","swingtips_recieved":"29.12","lessons_spent":"0.00","lessons_recieved":"4282.76","camps_spent":"0.00","camps_recieved":"0.00","phone":null}
    }
}
