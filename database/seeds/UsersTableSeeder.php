<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Academy;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User;
        $user->firstname = "Seth";
        $user->lastname = "Dichard";
        $user->email = "seth@seth.com";
        //$user->email = "nlynch@bates.edu";
        $user->password = bcrypt("seth123");
        $user->bio = "Seth brings over 15 years of professional teaching experience to his students at The Seth Dichard Golf Schools. He was first introduced to the golfing arena by his father at the young age of 8. His father, who owned and operated an off-course pro shop in Nashua, encouraged Seth to follow his dreams of becoming a professional golfer. He has since played and competed for over 30 years at the high school, collegiate and professional levels. In 2000, Seth graduated from Pfeiffer University in Misenheimer, N.C. as a member of the schools nationally ranked NCAA golf team.";
        $user->propic = "imgs/seth.jpg";
        $user->cover = "imgs/seth_cover.jpg";
        $user->handicap = "3";
        $user->age = "32";
        $user->lat = "42.765366";
        $user->lng = "-71.467567";
        $user->city = "Nahua";
        $user->state = "Nh";
        $user->zip = "03060";
        $user->address = "15 Macdonald Drive";
        $user->country = "USA";
        $user->pro = 1;
        $user->approved = 1;
        $user->requested = 0;
        $user->experience = "While attending Pfeiffer, Seth became passionate about studying and teaching the game and has since worked with and mentored under Golf Digests and Golf Magazines Top PGA Instructor Dr. Jim Suttie. He continues to further his education every year studying the best players and teachers in the world.";
        $user->why = "Through the years he has worked with several collegiate and high school teams in the area such as the Nashua High School and Umass Lowell Golf Teams. Seth also has previously assisted in golf conditioning programs.";
        $user->yoe = 16;
        $user->website = "http://www.sethdichardgolf.com";
        $user->save();
        $user1 = $user;


        $user = new User;
        $user->firstname = "Andrew";
        $user->lastname = "Hoch";
        $user->email = "andrew@andrew.com";
        $user->password = bcrypt("andrew123");
        $user->bio = "Founder of Swingtips Golf and former WA varsity golfer";
        $user->propic = "imgs/andrew.jpg";
        $user->cover = "imgs/golf_sunset.png";
        $user->handicap = 5;
        $user->age = "23";
        $user->is_admin = 1;
        $user->course_id = 1;
        $user->lat = "42.599851";
        $user->lng = "-71.40568300000001";
        $user->city = "Cambridge";
        $user->state = "Ma";
        $user->zip = "02140";
        $user->address = "165 Cambridgepark Dr";
        $user->country = "USA";
        $user->pro = 0;
        $user->approved = 0;
        $user->requested = 0;
        $user->save();

        $user = new User;
        $user->firstname = "Nick";
        $user->lastname = "Lynch";
        $user->email = "nmlynch10@gmail.com";
        $user->password = bcrypt("nick123");
        $user->bio = "Developer for Swingtips Golf and Bates college athlete, golf enthusiest";
        $user->propic = "imgs/nick.jpg";
        $user->cover = "imgs/golf_sunset.png";
        $user->handicap = 30;
        $user->age = "20";
        $user->is_admin = 1;
        $user->lat = "42.599851";
        $user->lng = "-71.40568300000001";
        $user->city = "Westford";
        $user->state = "Ma";
        $user->zip = "01886";
        $user->address = "14 Baldwin Road";
        $user->country = "USA";
        $user->pro = 0;
        $user->approved = 0;
        $user->requested = 0;
        $user->field0 = "My routine consists of...";
        $user->field1 = "My current swing thoughts are...";
        $user->field2 = "My least favorite club is...";
        $user->field3 = "Hybrid, I can hit it solid";
        $user->field4 = "200";
        $user->field5 = "left and far";
        $user->field6 = "very high";
        $user->field7 = "to the left and short";
        $user->field8 = "toe";
        $user->field9 = "right";
        $user->field10 = "yes big divots";
        $user->field11 = "choppy swing";
        $user->save();

        $user = new User;
        $user->firstname = "Chris";
        $user->lastname = "Lynch";
        $user->email = "chris@chris.com";
        $user->password = bcrypt("chris123");
        $user->bio = "Advisor for Swingtips Golf and golf enthusiest";
        $user->propic = "imgs/chris.jpg";
        $user->cover = "imgs/golf_sunset.png";
        $user->handicap = 25;
        $user->age = "22";
        $user->is_admin = 0;
        $user->lat = "43.599851";
        $user->lng = "-71.940568300000001";
        $user->city = "Cambridge";
        $user->state = "Ma";
        $user->zip = "02140";
        $user->address = "165 Cambridgepark Dr";
        $user->country = "USA";
        $user->pro = 0;
        $user->approved = 0;
        $user->requested = 0;
        $user->save();

        $user = new User;
        $user->firstname = "Eric";
        $user->lastname = "Leith";
        $user->email = "eric@eric.com";
        $user->password = bcrypt("eric123");
        $user->bio = "Eric W. Leith has been a PGA of America member for over twenty years. During that time, he has been employed as a Head Golf Professional at three locations throughout the south. His passion for golf is focused on the opportunities in the teaching arena, from the tiniest tykes, up to and including 80-year old kids. Having majored in Elementary Education at Springfield (Mass.) college, Eric has extensive formal training and thousands of lessons in his background that enable him to help each student achieve his or her goals.";
        $user->propic = "imgs/eric.jpg";
        $user->cover = "imgs/eric_cover.jpg";
        $user->handicap = "0";
        $user->age = "52";
         $user->lat = "42.609851";
        $user->lng = "-79.40768300000001";
        $user->city = "Billerica";
        $user->state = "Ma";
        $user->zip = "01821";
        $user->address = "51 Baldwin Rd";
        $user->country = "USA";
        $user->pro = 1;
        $user->course_id = 1;
        $user->approved = 1;
        $user->requested = 0;
        $user->experience = "Eric has coached players of all skill levels, and is extremely comfortable in both private and group settings. Former students praise his encouraging manner and constant support of even the simplest success. The nationally renowned Hilton Head Junior Golf Academy focused Eric’s natural inclination towards Junior instruction, and provided him with the specific knowledge needed for succeeding with younger golfers. The private clubs at which he served each required constant interaction with novices, intermediates, and special needs player; he has equal experience with both men and women in his teaching history.";

        $user->why = "We are here to make your golf game better, and to make golf a better game. The student requires professional input regarding much that surrounds the game in addition to swing instruction, and Eric strives to insert important information into each session. An awareness of topics like Rules, Etiquette, Equipment and Fitting, History, Current Events, and Course Management are examples of what separates a True Golfer from a range rat. Students will learn about their swing, and learn about the game.";
        $user->yoe = 35;
        $user->website = "http://www.sethdichardgolf.com/instructors.html";
        $user->save();
        $user3 = $user;
    	
        $user = new User;
        $user->firstname = "Ben";
        $user->lastname = "Derrick";
        $user->email = "ben@ben.com";
        $user->password = bcrypt("ben123");
        $user->bio = "Ben brings 12 years of professional golf experience to the Seth Dichard Golf School. He grew up in Saratoga Springs, NY around the game being the son of a golf course superintendent and nephew of a local golfing legend, Howard There is some golfing blood in his veins.";
        $user->propic = "imgs/ben.jpg";
        $user->cover = "imgs/eric_cover.jpg";
        $user->handicap = "0";
        $user->age = "52";
        $user->lat = "42.795366";
        $user->lng = "-73.469567";
        $user->city = "Nashua";
        $user->state = "NH";
        $user->zip = "01821";
        $user->address = "51 Baldwin Rd";
        $user->country = "USA";
        $user->pro = 1;
        $user->approved = 1;
        $user->requested = 0;
        $user->experience = "Ben incorporates the methodology of the Seth Dichard Golf School thru a holistic approach to the game of golf with a concentration on the mental game. He enjoys helping good players “go low,” intermediate players to have their career round and beginner golfers to achieve success with the game.";

        $user->why = "While attending Cazenovia College, Ben played his freshman and sophomore years but didn't get serious about golf until his junior year at Plymouth State College where he found his game. After college, he turned pro and started his career playing professionally on a Southern Florida Mini Tour and has since given professional instruction for over a decade.";
        $user->yoe = 25;
        $user->website = "http://www.sethdichardgolf.com/instructors.html";
        $user->save();
        $user2 = $user;
        

        $user = new User;
        $user->firstname = "Jordan";
        $user->lastname = "Babineau";
        $user->email = "jordan@jordan.com";
        $user->password = bcrypt("jordan123");
        $user->bio = "Jordan brings 10 years of experience to the Seth Dichard Golf Schools. Growing up in central Maine, he found a true love for sport and competition. He started teaching professionally while at #1 Ranked Sunday River Golf Club in the western mountains of Newry, Maine. He refined his skills as the Head Teaching Professional and General Manager at the Freeport CC in Freeport, Maine. He is known for creating an environment where golfers come together and enjoy the game.";
        $user->propic = "imgs/ben.jpg";
        $user->cover = "imgs/eric_cover.jpg";
        $user->handicap = "0";
        $user->age = "52";
        $user->lat = "45.765316";
        $user->lng = "-70.467517";
        $user->city = "Chelmsford";
        $user->state = "Ma";
        $user->zip = "01886";
        $user->address = "51 Baldwin Rd";
        $user->country = "USA";
        $user->pro = 1;
        $user->course_id = 1;
        $user->approved = 1;
        $user->requested = 0;
        $user->experience = "Jordan is a member of the WGTF, USGTF, USGMA, and the International PGA. His knowledge and passion makes him an ideal candidate to teach all personalities and abilities. He has spent thousands of hours performing everything from private lessons to large group clinics, with ages ranging from 5 to 75. The use of training aids and video further enhance his abilities. His philosophy is to make the game and its mechanics relatable to the specific student. He believes in making a full swing simple and the short game creative. ";

        $user->why = "Jordan is very excited to be part of the team at the Seth Dichard Golf Schools. He utilizes physical mechanics, mental desire and awareness to enhance the way a student plays and enjoys the game. His upbeat personality makes his lessons feel comfortable and relaxed. Jordan puts himself in your shoes. He really understands my concerns. He has truly helped my golf game and made it fun along the way. -Sylvie Bachofner Come join Jordan at the Brookmeadow CC in Canton Ma. and let's start improving your game.";
        $user->yoe = 15;
        $user->website = "http://www.sethdichardgolf.com/instructors.html";
        $user->save();
        $user4 = $user;










        /////////////////////////////////////////////////////////////////
        $a = new Academy;
        $a->name = "Vesper-Country Club";
        $a->bio = "Vesper-Country Club sits on Tyngs Island in the midst of the Merrimack River and was established in 1875 as Vesper Boat Club. In 1899 it merged with Lowell Country Club (founded in 1892) to create Vesper-Country Club.";
        $a->email = "vesper@vesper.com";
        $a->website = "http://www.vespercc.com/";
        $a->propic = "imgs\/vesper.png";
        $a->cover = "imgs\/vesper_cover.jpg";
        $a->yoe = "35";
        $a->lat = "44.599851";
        $a->lng = "-70.40568300000001";
        $a->city = "Westford";
        $a->state = "MA";
        $a->zip = "01886";
        $a->address = "14 baldwin road";
        $a->country = "USA";
        $a->approved = 0;
        $a->type = "course";
        $a->save();

        $a = new Academy;
        $a->name = "Seth Dischard Golf Schools";
        $a->bio = "The Seth Dichard Golf Schools teaching philosophy is very simple: 'Build a technically sound swing around the student's physical characteristics such as flexibility, body stucture, strength and ability.' Our teaching is solely based on specific fundamentals that will directly improve your impact positions. We'll match both your specific fundamentals and swing to your preferred or natural ball flight to help develop consistency.";
        $a->email = "seth2@seth2.com";
        $a->website = "http://www.sethdichardgolf.com/";
        $a->propic = "imgs\/sd.png";
        $a->cover = "imgs\/seth_cover.jpg";
        $a->yoe = "35";
        $a->lat = "42.599851";
        $a->lng = "-72.40568300000001";
        $a->city = "Westford";
        $a->state = "MA";
        $a->zip = "01886";
        $a->address = "14 baldwin road";
        $a->country = "USA";
        $a->approved = 0;
        $a->type = "academy";
        $a->users()->attach($user1);
        $a->users()->attach($user2);
        $a->users()->attach($user3);
        $a->users()->attach($user4);
        $a->save();

        // $user1->save();
        // $user1->academies()->attach(Academy::all()->first());
        // $user1->save();
        // $user2->save();
        // $user3->save();
        // $user4->save();
        // $user1->academies()->attach(Academy::all()->where('id',2)->first());
        // $user2->academies()->attach(Academy::all()->where('id',2)->first());
        // $user3->academies()->attach(Academy::all()->where('id',2)->first());
        // $user4->academies()->attach(Academy::all()->where('id',2)->first());
        // $user1->save();
        // $user2->save();
        // $user3->save();
        // $user4->save();
        // $user4->academies()->attach(Academy::all()->where('id',3)->first());
        // $user4->save();

    }
}
