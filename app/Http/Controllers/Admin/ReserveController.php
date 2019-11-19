<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Hotelpicture;
use App\Reserve;
use App\Room;


class ReserveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $posts = reserve::all();
        return view('admin.reserve.show',compact('posts'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reserve.post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
        $post = reserve::where('id',$id)->first();
             
        return view('admin.reserve.edit',compact('post','id'));
   
    return redirect(route('admin.home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                
        $post = reserve::find($id);
        $post->name_reserve =  $request->name_reserve;
        $post->id_user=  $request->id_user;
        $post->id_room =  $request->id_room;
        $post->checkin =  $request->checkin;
        $post->checkout =  $request->checkout;
        $post->price =  $request->price;
        $post->total =  $request->total;
        $post->person =  $request->person;
        $post->cancel =  $request->cancel;
        $post->info =  $request->info;
     
        $post->save();

        return redirect(route('reserve.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
       /* $n_room = reserve::where('id',$id)
                ->join ('room','reserve.id_room','=','room.id')
                ->first();

        $person= $n_room ->person;*/

        room::where('id',$id )
             ->update(['available' => 0, 'vacancies' => $person->person ]); 




        reserve::where('id',$id)->delete();
        return redirect()->back();
    }
}
