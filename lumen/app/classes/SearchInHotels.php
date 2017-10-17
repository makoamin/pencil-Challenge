<?php

namespace App\Classes;

use App\Classes\Hotels;
use App\Classes\interfaces\SearchHoteals;
class SearchInHotels  extends Hotels implements SearchHoteals {

    /**
     * 
     * @return json file of search results     
     * @author Mahmoud Azmi <makoamin@gmail.com> 
     */
    public function searchInHotels() {


        $valedHotel = array();
        $hotelName = array();
        $Price = array();
        foreach ($this->ArrayOfHotels->hotels as $hotel) {

            // search in hotel name 
            if (isset($this->SearchCriteria->HotelName) && is_string($this->SearchCriteria->HotelName)) {
                if (!strpos($hotel->name, $this->SearchCriteria->HotelName)) {
                    continue;
                }
            }
            // search in price 
            if (isset($this->SearchCriteria->Price->from) && is_float($this->SearchCriteria->Price->from) && isset($this->SearchCriteria->Price->to) && is_float($this->SearchCriteria->Price->to)) {

                if (($this->SearchCriteria->Price->from >= $hotel->price ) || ( $this->SearchCriteria->Price->to <= $hotel->price)) {
                    continue;
                }
            }
            // search in city 
            if (isset($this->SearchCriteria->Destination) && is_string($this->SearchCriteria->Destination)) {

                if ($this->SearchCriteria->Destination != $hotel->city) {
                    continue;
                }
            }
            // search by Date 
            if (isset($this->SearchCriteria->Date->from) && isset($this->SearchCriteria->Date->to)) {
                $isAvailabil = 0;
                foreach ($hotel->availability as $availability) {
                    $serch = array();
                    $availability->from = strtotime($availability->from);
                    $availability->to = strtotime($availability->to);
                    $serch['Date']['from'] = strtotime($this->SearchCriteria->Date->from);
                    $serch['Date']['to'] = strtotime($this->SearchCriteria->Date->to);

                    if ($availability->from <= $serch['Date']['from'] && $availability->from <= $serch['Date']['to'] &&
                            $availability->to >= $serch['Date']['from'] && $availability->to >= $serch['Date']['to']) {
                        $isAvailabil = 1;
                    }
                }
                if ($isAvailabil != 1) {
                    continue;
                }
            }
            $valedHotel[] = $hotel;
        }

        return $valedHotel;
    }

}
