<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Reserve;
use App\Hotelpicture;
use App\Roompicture;
use Datetime;

class WelcomeController extends Controller
{
    
    public function index()
    {   
        // Elimina registros de sobra en BD
        $data = reserve::where ( 'id_room', null )   
                        ->delete();


    
     $posts = hotelpicture::all();
                        
      return view('Welcome',compact('posts'));

        //return view('welcome'); 
    }

}
