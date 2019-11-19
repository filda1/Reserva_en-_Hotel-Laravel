<?php

namespace App\Http\Controllers;

use App\Room;
use App\Roomeng;
use App\Reserve;
use App\Hotelpicture;
use App\Roompicture;
use Datetime;
use Carbon\Carbon;
//use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search()
    {

            // VERIFICA QUE LAS FECHAS SEAN MAYORES QUE HOY
            $checkin = Input::get ( 'checkin' );
            $checkout = Input::get ( 'checkout' );
           
            //$today = Carbon::today();
            $today = Carbon::yesterday();
    
         
            if ((  $checkin < $today ) or (  $checkout <  $today )){
           
                   //return view('welcome');
                   //return redirect::back();
                   return back();
            }

            
       // Para pasar el Banner dede BD  a view  app.blade ====> por hotel.blade
        $posts = hotelpicture::all();

      //////////////////////////////// Despues de acabar la reserva, se activa los quartos ///////////////////////////////
        $today = date("Y-m-d H:i:s");                 
        $dato=reserve::where('checkout', '<', $today)
                      ->get();
         
        foreach ($dato as $datos) {

           if(($datos->checkout <  $today)){
                                
              $data = room::where ( 'id', $datos->id_room )
                            ->first();   
                    
            

                room::where('id',$datos->id_room )
                     ->update(['available' => 0, 'vacancies' => $data->person ]); 



        $data1 = roomeng::where ( 'id', $datos->id_room )
                     ->first();   
             

         roomeng::where('id',$datos->id_room )
              ->update(['available' => 0, 'vacancies' => $data1->person ]); 

              // ELIMINO EL QUARTA EN RESERVA
              reserve::where ( 'id_room', $datos->id_room )   
              ->delete();

            }
        }

       
        /////////////////////////////////////////////////////////////////////////////////////////////////////////


         // $hotel = Input::get ( 'hotel' );
          $checkin = Input::get ( 'checkin' );
          $checkout = Input::get ( 'checkout' );
          $person = Input::get ( 'person' );

          
        // numero de registros = numero de quartos

        //$n_registros = $person/2; 

        // PARTE ENTERA
        // 18.8 , floor($x); ---> retorna 18 
        // 18.8 , round($x) ----> retorna 19
         
        // available =0 ============> Existe quartos
        // available =1 ============> no Existe quartos
        // vacancies y available se modifica al reservar
        // Ej: 10 personas, 6 quartos


         //Cambio de idioma en BD (O sea cambio de tablas)    
         
         $lang = Input::get ( 'lang' );
        


        if ($lang=="pt"){
           
            $total_person= room::all()->sum('vacancies');
             

            if ( $person <= $total_person){
            
                if ($person % 2 == 0){
           
                        $data_room1   = room::where ( 'person', 'LIKE', '%' . 1 . '%' )
                                            ->where ( 'available', 'LIKE', '%' . 0 . '%' )
                                            ->get();
                        
        
                                            $n_registros = $person/2;
                                            $persona = Input::get ( 'person' );
                
                    if( ($data_room1[0]->person == 1)  && ($data_room1[1]->person ==1)   ) {
                     
                        $extra_room=$data_room1[0];
                        $extra_room2= $data_room1[1];
                        $max= $n_registros-1;
                       
                       $end=$max;
                       $data = room::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
        
        
                                    $checkin = Input::get ( 'checkin' );
                                    $checkout = Input::get ( 'checkout' );
                                    $persona = Input::get ( 'person' );
                              
                                  if ($checkin > $checkout) {
    
                                    $checkout = $checkin ;  
                                    //$checkout = $checkin ;
                                    $checkin = Input::get ( 'checkout' );
        
                                      
        
                                    return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;  
                          
                                  } elseif ($checkin== $checkout) {
                                      $checkout=$checkin ;
                                      $checkin =$checkin;
        
                                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                          
                                  } else {
                                      $checkout;
                                      $checkin;
                                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ; 
                          
                                  }                       
                      
                    }   
                     else {
                        $extra_room = null;
                        $extra_room2= null;
                        $max= $n_registros;
                       
                       $end=$max;
                       $data = room::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
        
                            $checkin = Input::get ( 'checkin' );
                            $checkout = Input::get ( 'checkout' );
                            $persona = Input::get ( 'person' );                
                                         
                             if ($checkin > $checkout) {
    
                                    $checkout = $checkin ;  
                                    //$checkout = $checkin ;
                                    $checkin = Input::get ( 'checkout' );
                   
                            return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                     
                              } elseif ($checkin== $checkout) {
                                 $checkout=$checkin ;
                                 $checkin =$checkin;
                   
                                 return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;    
                                     
                                 } else {
                                    $checkout;
                                    $checkin;
                   
                                    return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;    
                                     
                                 }
                     }
                }  
                // IMPAR PT
                else {
                          
                
                    $data_room  = room::where ( 'person', 'LIKE', '%' . 1 . '%' )
                                 ->get();
        
                                 $n_registros = ($person/2);                      
                                 $persona = Input::get ( 'person' );
                   
        

                    if( ($data_room[0] -> available == 0)  && ($data_room[1]->available == 1)   ) {
        
                        $extra_room= $data_room[0];
                        $extra_room2= null;
                        $max= floor($n_registros);
                           
                        $end=$max;
                        $data = room::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                     ->get();
                   
                     
                            $checkin = Input::get ( 'checkin' );
                             $checkout = Input::get ( 'checkout' );
                             $persona = Input::get ( 'person' );             
                                          
                            if ($checkin > $checkout) {
                    
                                $checkout = $checkin ;  
                                //$checkout = $checkin ;
                                $checkin = Input::get ( 'checkout' );
                    
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                      
                             } elseif ($checkin== $checkout) {
                                $checkout=$checkin ;
                                $checkin =$checkin;
                    
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                                      
                             } else {
                                $checkout;
                                $checkin;
                    
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                      
                                      };
           
                    }
                  
                    elseif( ($data_room[0] -> available == 1)  && ($data_room[1]->available == 0)   ) {

                        $extra_room= $data_room[1];
                        $extra_room2= null;
                        $max= floor($n_registros);
                           
                       $end=$max;
                       $data = room::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
                   
                     
                            $checkin = Input::get ( 'checkin' );
                            $checkout = Input::get ( 'checkout' );
                            $persona = Input::get ( 'person' );         
                                         
                         if ($checkin > $checkout) {
                   
                             $checkout = $checkin ;  
                            //$checkout = $checkin ;
                            $checkin = Input::get ( 'checkout' );
                   
                            return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                                     
                         } elseif ($checkin== $checkout) {
                             $checkout=$checkin ;
                             $checkin =$checkin;
                   
                             return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ; 
                                     
                        } else {
                              $checkout;
                              $checkin;
                   
                              return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                     
                                     }
                    }

                    elseif( ($data_room[0] -> available == 0)  && ($data_room[1]->available == 0)   ) {

                        $extra_room= $data_room[0];
                        $extra_room2= null;
                        $max= floor($n_registros);
                           
                       $end=$max;
                       $data = room::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
                   
                     
                            $checkin = Input::get ( 'checkin' );
                            $checkout = Input::get ( 'checkout' );
                            $persona = Input::get ( 'person' );         
                                         
                         if ($checkin > $checkout) {
                   
                             $checkout = $checkin ;  
                            //$checkout = $checkin ;
                            $checkin = Input::get ( 'checkout' );
                   
                            return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                                     
                         } elseif ($checkin== $checkout) {
                             $checkout=$checkin ;
                             $checkin =$checkin;
                   
                             return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ; 
                                     
                        } else {
                              $checkout;
                              $checkin;
                   
                              return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                     
                                     }
                    }
                  
                    elseif( ($data_room[0] -> available == 1)  && ($data_room[1]->available == 1)   ) {
        
                        $extra_room= null;
                        $extra_room2= null;
                        $max= round($n_registros);
                           
                        $end=$max;
                        $data = room::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                      ->get();
                              
                         $checkin = Input::get ( 'checkin' );
                         $checkout = Input::get ( 'checkout' );
                         $persona = Input::get ( 'person' );                   
                                           
                            if ($checkin > $checkout) {
                     
                                   $checkout = $checkin ;  
                                    //$checkout = $checkin ;
                                    $checkin = Input::get ( 'checkout' );
                     
                                    return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                       
                            } elseif ($checkin== $checkout) {
                                 $checkout=$checkin ;
                                $checkin =$checkin;
                     
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;    
                                       
                           } else {
                                 $checkout;
                                 $checkin;
                     
                                 return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                       
                         }
        
                    }
                               
                }        
              
               
               $end=0;
               $extra_room= null;
               $extra_room2= null;
               $data = null;           
               $checkin = " ";
               $checkout = " ";
               $persona = Input::get ( 'person' );
                    
                if ($checkin > $checkout) {
        
                     $checkout= " ";  
                     //$checkout = $checkin ;
                      $checkin = " ";
        
                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                
                } elseif ($checkin== $checkout) {
                       $checkout=$checkin ;
                       $checkin =$checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                
                } else {
                       $checkout;
                       $checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                
                }
    
    
            }

             // NO HAY QUARTOS PARA EL TOTAL DE PERSONAS
            else {
    
               $end=0;
               $extra_room= null;
               $extra_room2= null;
               $data = null;           
               $checkin = " ";
               $checkout = " ";
                         
               $persona = Input::get ( 'person' );
    
                if ($checkin > $checkout) {
        
                     $checkout= " ";  
                     //$checkout = $checkin ;
                      $checkin = " ";
        
                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;  
                
                } elseif ($checkin== $checkout) {
                       $checkout=$checkin ;
                       $checkin =$checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                } else {
                       $checkout;
                       $checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;     
                
                }
    
            }
         
        }

         // Lang ="en"
        else{
            
            $total_person= roomeng::all()->sum('vacancies');
             

            if ( $person <= $total_person){
            
                if ($person % 2 == 0){
           
                        $data_room1   = roomeng::where ( 'person', 'LIKE', '%' . 1 . '%' )
                                            ->where ( 'available', 'LIKE', '%' . 0 . '%' )
                                            ->get();
                        
        
                                            $n_registros = $person/2;
                                            $persona = Input::get ( 'person' );
                
                    if( ($data_room1[0]->person == 1)  && ($data_room1[1]->person ==1)   ) {
                     
                        $extra_room=$data_room1[0];
                        $extra_room2= $data_room1[1];
                        $max= $n_registros-1;
                       
                       $end=$max;
                       $data = roomeng::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
        
        
                                    $checkin = Input::get ( 'checkin' );
                                    $checkout = Input::get ( 'checkout' );
                                    $persona = Input::get ( 'person' );
                              
                                  if ($checkin > $checkout) {
    
                                    $checkout = $checkin ;  
                                    //$checkout = $checkin ;
                                    $checkin = Input::get ( 'checkout' );
        
                                      
        
                                    return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;  
                          
                                  } elseif ($checkin== $checkout) {
                                      $checkout=$checkin ;
                                      $checkin =$checkin;
        
                                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                          
                                  } else {
                                      $checkout;
                                      $checkin;
                                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ; 
                          
                                  }                       
                      
                    }   
                     else {
                        $extra_room = null;
                        $extra_room2= null;
                        $max= $n_registros;
                       
                       $end=$max;
                       $data = roomeng::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
        
                            $checkin = Input::get ( 'checkin' );
                            $checkout = Input::get ( 'checkout' );
                            $persona = Input::get ( 'person' );                
                                         
                             if ($checkin > $checkout) {
    
                                    $checkout = $checkin ;  
                                    //$checkout = $checkin ;
                                    $checkin = Input::get ( 'checkout' );
                   
                            return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                     
                              } elseif ($checkin== $checkout) {
                                 $checkout=$checkin ;
                                 $checkin =$checkin;
                   
                                 return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;    
                                     
                                 } else {
                                    $checkout;
                                    $checkin;
                   
                                    return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;    
                                     
                                 }
                     }
                }  
                // IMPAR EN
                else {
                          
                
                    $data_room  = roomeng::where ( 'person', 'LIKE', '%' . 1 . '%' )
                                 ->get();
        
                                 $n_registros = ($person/2);                      
                                 $persona = Input::get ( 'person' );
                   
        

                    if( ($data_room[0] -> available == 0)  && ($data_room[1]->available == 1)   ) {
        
                        $extra_room= $data_room[0];
                        $extra_room2= null;
                        $max= floor($n_registros);
                           
                        $end=$max;
                        $data = roomeng::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                     ->get();
                   
                     
                            $checkin = Input::get ( 'checkin' );
                             $checkout = Input::get ( 'checkout' );
                             $persona = Input::get ( 'person' );             
                                          
                            if ($checkin > $checkout) {
                    
                                $checkout = $checkin ;  
                                //$checkout = $checkin ;
                                $checkin = Input::get ( 'checkout' );
                    
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                      
                             } elseif ($checkin== $checkout) {
                                $checkout=$checkin ;
                                $checkin =$checkin;
                    
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                                      
                             } else {
                                $checkout;
                                $checkin;
                    
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                      
                                      };
           
                    }
                  
                    elseif( ($data_room[0] -> available == 1)  && ($data_room[1]->available == 0)   ) {

                        $extra_room= $data_room[1];
                        $extra_room2= null;
                        $max= floor($n_registros);
                           
                       $end=$max;
                       $data = roomeng::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
                   
                     
                            $checkin = Input::get ( 'checkin' );
                            $checkout = Input::get ( 'checkout' );
                            $persona = Input::get ( 'person' );         
                                         
                         if ($checkin > $checkout) {
                   
                             $checkout = $checkin ;  
                            //$checkout = $checkin ;
                            $checkin = Input::get ( 'checkout' );
                   
                            return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                                     
                         } elseif ($checkin== $checkout) {
                             $checkout=$checkin ;
                             $checkin =$checkin;
                   
                             return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ; 
                                     
                        } else {
                              $checkout;
                              $checkin;
                   
                              return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                     
                                     }
                    }

                    elseif( ($data_room[0] -> available == 0)  && ($data_room[1]->available == 0)   ) {

                        $extra_room= $data_room[0];
                        $extra_room2= null;
                        $max= floor($n_registros);
                           
                       $end=$max;
                       $data = roomeng::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                    ->get();
                   
                     
                            $checkin = Input::get ( 'checkin' );
                            $checkout = Input::get ( 'checkout' );
                            $persona = Input::get ( 'person' );         
                                         
                         if ($checkin > $checkout) {
                   
                             $checkout = $checkin ;  
                            //$checkout = $checkin ;
                            $checkin = Input::get ( 'checkout' );
                   
                            return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                                     
                         } elseif ($checkin== $checkout) {
                             $checkout=$checkin ;
                             $checkin =$checkin;
                   
                             return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ; 
                                     
                        } else {
                              $checkout;
                              $checkin;
                   
                              return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                     
                                     }
                    }
                  
                    elseif( ($data_room[0] -> available == 1)  && ($data_room[1]->available == 1)   ) {
        
                        $extra_room= null;
                        $extra_room2= null;
                        $max= round($n_registros);
                           
                        $end=$max;
                        $data = roomeng::where ( 'available', 'LIKE', '%' . 0 . '%' )
                                      ->get();
                              
                         $checkin = Input::get ( 'checkin' );
                         $checkout = Input::get ( 'checkout' );
                         $persona = Input::get ( 'person' );                   
                                           
                            if ($checkin > $checkout) {
                     
                                   $checkout = $checkin ;  
                                    //$checkout = $checkin ;
                                    $checkin = Input::get ( 'checkout' );
                     
                                    return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                       
                            } elseif ($checkin== $checkout) {
                                 $checkout=$checkin ;
                                $checkin =$checkin;
                     
                                return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;    
                                       
                           } else {
                                 $checkout;
                                 $checkin;
                     
                                 return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                                       
                         }
        
                    }
                               
                }        
              
               
               $end=0;
               $extra_room= null;
               $extra_room2= null;
               $data = null;           
               $checkin = " ";
               $checkout = " ";
               $persona = Input::get ( 'person' );
                    
                if ($checkin > $checkout) {
        
                     $checkout= " ";  
                     //$checkout = $checkin ;
                      $checkin = " ";
        
                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                
                } elseif ($checkin== $checkout) {
                       $checkout=$checkin ;
                       $checkin =$checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                
                } else {
                       $checkout;
                       $checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;   
                
                }
    
    
            }

             // NO HAY QUARTOS PARA EL TOTAL DE PERSONAS
            else {
    
               $end=0;
               $extra_room= null;
               $extra_room2= null;
               $data = null;           
               $checkin = " ";
               $checkout = " ";
                         
               $persona = Input::get ( 'person' );
    
                if ($checkin > $checkout) {
        
                     $checkout= " ";  
                     //$checkout = $checkin ;
                      $checkin = " ";
        
                      return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;  
                
                } elseif ($checkin== $checkout) {
                       $checkout=$checkin ;
                       $checkin =$checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;
                } else {
                       $checkout;
                       $checkin;
        
                       return view('hotel',compact('data','end','extra_room','extra_room2', 'checkin','checkout','persona','posts')) ;     
                
                }
    
            }
            

            
        } 

      
        
      
    }
   
}
