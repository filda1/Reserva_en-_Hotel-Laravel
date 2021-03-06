<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Hotelpicture;
use App\Room;


class RoomController extends Controller
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
        $posts = room::all();
        return view('admin.room.show',compact('posts'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.post');
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
         
        $post = room::where('id',$id)->first();
             
        return view('admin.room.edit',compact('post','id'));
   
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
                
        $post = room::find($id);
        $post->name_room=  $request->name_room;
        $post->descripcion=  $request->descripcion;
        $post->activity =  $request->activity;
        $post->service =  $request->service;
        $post->price =  $request->price;
        $post->available =  $request->available;
        $post->vacancies =  $request->vacancies;
        $post->quantity=  $request->quantity;
        $post->person =  $request->person;
        $post->capacity =  $request->capacity;
        $post->include =  $request->include;
        $post->info1 =  $request->info1;
        $post->info2 =  $request->info2;
        $post->bed1 =  $request->bed1;
        $post->bed2 =  $request->bed2;
        $post->serviceespecial1 =  $request->serviceespecial1;
        $post->serviceespecial2 =  $request->serviceespecial2;
        $post->infoprice1 =  $request->infoprice1;
        $post->infoprice2 =  $request->infoprice2;
        $post->alert1 =  $request->alert1;
        $post->alert2 =  $request->alert2;
        $post->notice1 =  $request->notice1;
        $post->notice2 =  $request->notice2;
        $post->infoConfirm =  $request->infoConfirm;
        $post->inforegister =  $request->inforegister;
        $post->infocard =  $request->infocard;

        $post->save();

        return redirect(route('room.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            
        room::where('id',$id)->delete();
        return redirect()->back();
    }
}
