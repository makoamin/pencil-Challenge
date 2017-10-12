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

            $valedHotel[] = $hotel;
        }

        return response()->json($valedHotel);
    }

    /**

     * @return  array of date  
     */
    private function getArray() {
        $JsonDate = file_get_contents($this->link);
        return json_decode($JsonDate);
    }

}
