<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * is a json api to get search criteria of json and search in json api 
 * 
 * @author Mahmoud Azmi
 */
class SearchController extends Controller {

    private $link;

    /**

     * 
     * @param Request $request
     * @return json file of search results     
     * @author Mahmoud Azmi <makoamin@gmail.com>
     */
    public function index(Request $request) {
        $this->link = env('linkOfDate');
        // get data from api 
        $DataArray = $this->getArray();

        $stringJeson = trim($request->input('request'));

        $RequestArray = json_decode($stringJeson);

        return $this->SearchInArray($DataArray, $RequestArray);
    }

    /**
     * 
     * @param  $Data is all Data to can search in 
     * $serch search criteria
     * @return json file of search results     
     * @author Mahmoud Azmi <makoamin@gmail.com> 
     */
    private function SearchInArray($Data, $serch) {
        $valedHotel = array();
        $hotelName = array();
        $Price = array ();
        foreach ($Data->hotels as $hotel) {

            if (isset($serch->HotelName) && is_string($serch->HotelName)) {
                if (!strpos($hotel->name, $serch->HotelName)) {
                    continue;
                }
            }

            if (isset($serch->Price->from) && is_float($serch->Price->from) && isset($serch->Price->to) && is_float($serch->Price->to)) {

                if (($serch->Price->from >= $hotel->price ) || ( $serch->Price->to <= $hotel->price)) {
                    continue;
                }
            }

            if (isset($serch->Destination) && is_string($serch->Destination)) {

                if ($serch->Destination != $hotel->city) {
                    continue;
                }
            }

            if (isset($serch->Date->from) && isset($serch->Date->to)) {
                $isAvailabil = 0;
                foreach ($hotel->availability as $availability) {
                    $availability->from = strtotime($availability->from);
                    $availability->to = strtotime($availability->to);
                    $serch->Date->from = strtotime($serch->Date->from);
                    $serch->Date->to = strtotime($serch->Date->to);
                    if ($availability->from <= $serch->Date->from && $availability->from <= $serch->Date->to && $availability->to >= $serch->Date->from && $availability->to >= $serch->Date->to) {
                        $isAvailabil = 1;
                    }
                }
                if ($isAvailabil != 1) {
                    continue;
                }
            }
           if(isset($serch->Sort) and $serch->Sort == 'Hotel Name')
           {
               $hotelName[] = $hotel->name ;
            
            }elseif(isset($serch->Sort) and $serch->Sort == 'Price')
           {
                $Price[] = $hotel->price ;
           }
           

            $valedHotel[] = $hotel;
        }

        if(isset($serch->Sort) and $serch->Sort == 'Hotel Name')
            {
           
               $valedHotel = $this->SortByName($valedHotel ,$hotelName);
            
            }elseif(isset($serch->Sort) and $serch->Sort == 'Price')
           {
                $valedHotel = $this->SortByPrice($valedHotel ,$Price);
           }
          
                return response()->json($valedHotel);
           
        //return response()->json($valedHotel);
    }
    
    /**

     * to sort hotels by hotals name 
     * @param type $Data hotels data 
     * @param type $HotelName array of hotels name
     * @return array of Data sorted      /
     *  @author Mahmoud Azmi <makoamin@gmail.com> 
     */
    private function SortByName($Data  , $HotelName)
    {
      
        sort($HotelName) ;
      
        $SortHotel= array () ;
          
        foreach ($HotelName as $name)
        {
            foreach ($Data as $hotel )
            {
                
                if($hotel->name == $name){
                    $SortHotel[] = $hotel ;
                }
            }
        }
       
        return $SortHotel ;
    }
    
    
     /**

      *  to sort by price 
      * @param type $Data hotels data 
      * @param type $Price price of hotel 
      * @return type  array of Data sorted
      * @author Mahmoud Azmi <makoamin@gmail.com> 
      */
    private function SortByPrice($Data  , $Price)
    {
   sort($Price) ;
        $SortHotel= array () ;
        foreach ($Price as $pr)
        {
            foreach ($Data as $hotel )
            {
                if($hotel->price == $pr){
                    $SortHotel[] = $hotel ;
                }
            }
        }
        
        return $SortHotel ;
    }

    /**

     * @return  array of date 
     * @author Mahmoud Azmi <makoamin@gmail.com>  
     */
    private function getArray() {
        $JsonDate = file_get_contents($this->link);
        return json_decode($JsonDate);
    }
    
    
    

}
