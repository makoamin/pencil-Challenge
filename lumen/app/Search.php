<?php



namespace App;
use Illuminate\Database\Eloquent\Model;

class Search extends Model {
    
     /**
     * @return  array of date 
     * @author Mahmoud Azmi <makoamin@gmail.com>  
     */
     public static function  HotelData() {
        // dd(env('linkOfDate'));
        $JsonDate = file_get_contents(env('linkOfDate'));
    
        $JsonDate = json_decode($JsonDate);
       return $JsonDate ;
    }
   
}
