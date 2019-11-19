<?php

namespace App\Http\Controllers;

use App\Room;
use App\Roomeng;
use App\Reserve;
use App\User;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Mail\Demoemail3;
use Illuminate\Support\Facades\Mail;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function save()
    {
         // $hotel = Input::get ( 'hotel' );


         // OJO con fechas poner en : //config/database.php
         // 'mysql' => [
         // 'strict' => false,

         $person = Input::get ( 'persona');
         $person_extraroom = Input::get ( 'persona_extraroom');
         $person_extraroom2 = Input::get ( 'persona_extraroom2');
         $total = Input::get ( 'total');
                   
         
         $checkin = Input::get ( 'checkini');
         $checkout = Input::get ( 'checkouti');

         $time = strtotime($checkin);
         $time2 = strtotime($checkout);
         $newformat = date('Y-m-d',$time);
         $newformat2 = date('Y-m-d',$time2);

         $id_extraroom = Input::get ( 'id_extraroom');
         $price_extraroom = Input::get ( 'price_extraroom');
         $name_extraroom = Input::get ( 'name_extraroom');
         $checkin_extraroom = Input::get ( 'checkin_extraroom'); 
         $checkout_extraroom = Input::get ( 'checkout_extraroom'); 
         $time_extraroom  = strtotime($checkin_extraroom );
         $time2_extraroom  = strtotime($checkout_extraroom );
         $newformat_extraroom  = date('Y-m-d',$time_extraroom );
         $newformat2_extraroom  = date('Y-m-d',$time2_extraroom );

         
         $id_extraroom2 = Input::get ( 'id_extraroom2');
         $price_extraroom2 = Input::get ( 'price_extraroom2');
         $name_extraroom2 = Input::get ( 'name_extraroom2');
         $checkin_extraroom2 = Input::get ( 'checkin_extraroom2'); 
         $checkout_extraroom2 = Input::get ( 'checkout_extraroom2'); 
         $time_extraroom2  = strtotime($checkin_extraroom2);
         $time2_extraroom2  = strtotime($checkout_extraroom2 );
         $newformat_extraroom2  = date('Y-m-d',$time_extraroom2 );
         $newformat2_extraroom2  = date('Y-m-d',$time2_extraroom2 );
         
         

          $end = Input::get ( 'end');
           $fin= (int)$end;

           $uniqid = uniqid();

         for ($i =0; $i<$fin; $i++){
           
            $y = (string)$i;
            $id_room = Input::get ( $y );
            $dataDB = room::where('id',$id_room)->first();

            $name_room= $dataDB->name_room;
            $price_room= $dataDB->price;

            $post = new reserve;
            $post->name_reserve = $uniqid."_". $name_room ;
            $post->id_user = Auth::user()->id; 
            $post->id_room =  $id_room ;
            //$post->id_user = 1 ;
            $post->id_hotel = 1 ;
            $post->checkin =   $newformat;
            $post->checkout = $newformat2;
            $post->price = $price_room;
            $post->total = $total ;
            $post->person = $person ;
            $post->children = 0 ;
            $post->cancel = 0 ;
            $post->info = "";
          
        
            $post->save();

            // Change Activation in room table
            // Discount total person in vacancies ,room table
            $change = room::find($id_room);
            $change->available = 1 ;
            $change->vacancies = 0 ;       
            $change->save();

            roomeng::where('id', $id_room )
            ->update(['available' => 1, 'vacancies' => 0 ]);     
           
         }
    
         if (($id_extraroom !== 0) && ($id_extraroom2 !== 0)){

            $namedataDB = room::where('id',$id_extraroom)->first();
               
            $post = new reserve;
            $post->name_reserve = $uniqid."_".$namedataDB->name_room;
            $post->id_user = Auth::user()->id;
            $post->id_room =  $id_extraroom ;
            $post->id_hotel = 1 ;
            $post->checkin =   $newformat_extraroom;
            $post->checkout = $newformat2_extraroom;
            $post->price = $price_extraroom;
            $post->total = $total ;
            $post->person = $person_extraroom;
            $post->children = 0 ;
            $post->cancel = 0 ;
            $post->info = "";

            
            $post->save();


            $namedataDB2 = room::where('id',$id_extraroom2)->first();
            
            // Change Activation in room table
            // Discount total person in vacancies ,room table
    

            room::where('id', $id_extraroom)
            ->update(['available' => 1, 'vacancies' => 0 ]); 

            roomeng::where('id', $id_extraroom)
            ->update(['available' => 1, 'vacancies' => 0 ]); 


            $post2 = new reserve;
            $post2->name_reserve = $uniqid."_".$namedataDB2->name_room;
            $post2->id_user = Auth::user()->id;
            $post2->id_room =  $id_extraroom2 ;
            $post2->id_hotel = 1 ;
            $post2->checkin =   $newformat_extraroom2;
            $post2->checkout = $newformat2_extraroom2;
            $post2->price = $price_extraroom2;
            $post2->total = $total;
            $post2->person = $person_extraroom2 ;
            $post2->children = 0 ;
            $post2->cancel = 0 ;
            $post2->info = "";

            
            $post2->save();

            
            
            // Change Activation in room table
            // Discount total person in vacancies ,room tab
          
            room::where('id', $id_extraroom2 )
                        ->update(['available' => 1, 'vacancies' => 0 ]); 

          roomeng::where('id', $id_extraroom2 )
                        ->update(['available' => 1, 'vacancies' => 0 ]); 

   
         }
         elseif( (($id_extraroom !== 0) && ($id_extraroom2== 0))  ) {

            $namedataDB = room::where('id',$id_extraroom)->first();
             
            $post = new reserve;
            $post->name_reserve = $uniqid."_".$namedataDB->name_room;
            $post->id_user = Auth::user()->id;
            $post->id_room =  $id_extraroom ;
            //$post->id_user = 1 ;
            $post->id_hotel = 1 ;
            $post->checkin =   $newformat_extraroom;
            $post->checkout = $newformat2_extraroom;
            $post->price = $price_extraroom;
            $post->total = $total;
            $post->person = $person_extraroom;
            $post->children = 0 ;
            $post->cancel = 0 ;
            $post->info = "";

            
            $post->save();

        
            // Change Activation in room table
            // Discount total person in vacancies ,room table
            $change = room::find($id_extraroom);
            $change->available = 1 ;
            $change->vacancies = 0 ;       
            $change->save();

            roomeng::where('id', $id_extraroom )
            ->update(['available' => 1, 'vacancies' => 0 ]); 
                  
                           
         }
         elseif( (($id_extraroom2 !== 0) && ($id_extraroom == 0))  ) {
   

            $namedataDB2 = room::where('id',$id_extraroom2)->first();
         

            $post2 = new reserve;
            $post2->name_reserve = $uniqid."_".$namedataDB2->name_room;
            $post->id_user = Auth::user()->id;
            $post->id_room =  $id_extraroom2 ;
            $post->id_hotel = 1 ;
            $post->checkin =   $newformat_extraroom2;
            $post->checkout = $newformat2_extraroom2;
            $post->price = $price_extraroom2;
            $post->total = $total;
            $post->person = $person_extraroom2 ;
            $post->children = 0 ;
            $post->cancel = 0 ;
            $post->info = "";

            
            $post->save();

            
             // Change Activation in room table
            // Discount total person in vacancies ,room table
            $id_extraroom2 = Input::get ( 'id_extraroom2');
            $muda = room::find($id_extraroom2);
            $muda->available = 1 ; 
            $muda->vacancies = 0 ;      
            $muda->save();    
            
            roomeng::where('id', $id_extraroom2 )
            ->update(['available' => 1, 'vacancies' => 0 ]); 
   
         }
         
         reserve::where ( 'id_room', null )   
                        ->delete();

         $count = reserve::where ( 'name_reserve', 'LIKE', '%' . $uniqid . '%' )->count();

      
         for ($i =0; $i<$count; $i++){

           

            $first = reserve::where ( 'name_reserve', 'LIKE', '%' . $uniqid . '%' )->get();

            $id_user= $first->id_user;
            $currentuser = User::find($id_user);
             $name_user = $currentuser->name;
             $email_user = $currentuser->email;

            $A =  $first[$i]->name_reserve. ","."CHECKIN :" .$first[$i]->checkin .","." CHECKOUT:".
            $first[$i]->checkout.","."TOTAL:".$total.""."€".","."Nº PERSON:".$first[$i]->person.",
            "."PRICE:". $first[$i]->price.""."€" .","."NAME:".$name_user.","."EMAIL:".$email_user;

            $message = $A;
            $name = $uniqid;
            Mail::to('filinto.urh@gmail.com')->send(new Demoemail3($uniqid,$message));
         }

     

         //$message='OK';
         //return view('exitreserve',compact('message'));
         return view('exitreserve');
        

   
   
    }
   
}
