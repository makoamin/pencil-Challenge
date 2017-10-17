<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\SearchInHotels ;
use App\Classes\SortHotels ;
use App\Search ;
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

        // get data from api 
        $allHotelData = array();
        $allHotelData = Search::HotelData();

        $jesonSearchCriteria = trim($request->input('request'));
        $searchCriteria = array();
        $searchCriteria = json_decode($jesonSearchCriteria);
        // search 
        $searchInHotel = new SearchInHotels();
        $searchInHotel->setArrayOfHotels($allHotelData);
        $searchInHotel->setSearchCriteria($searchCriteria);
        $resaltSearchHotel = $searchInHotel->searchInHotels();
          //Sort 
        $sortHotel = new SortHotels();
        $sortHotel->setArrayOfHotels($resaltSearchHotel);
        $sortHotel->setSearchCriteria($searchCriteria);


        return $resaltHotel = $sortHotel->SortHotels();

        // return $this->SearchInArray($DataArray, $RequestArray);
    }

    /**
     * 
     * @param  $Data is all Data to can search in 
     * $serch search criteria
     * @return json file of search results     
     * @author Mahmoud Azmi <makoamin@gmail.com> 
     */
   
    /**

     * to sort hotels by hotals name 
     * @param type $Data hotels data 
     * @param type $HotelName array of hotels name
     * @return array of Data sorted      /
     *  @author Mahmoud Azmi <makoamin@gmail.com> 
     */
   
    
    
     /**

      *  to sort by price 
      * @param type $Data hotels data 
      * @param type $Price price of hotel 
      * @return type  array of Data sorted
      * @author Mahmoud Azmi <makoamin@gmail.com> 
      */
    

   
    
    
    
    

}
