<?php

namespace App\Classes;
use App\Classes\Hotels ;
use App\Classes\interfaces\SortHoteals;
class SortHotels  extends Hotels implements SortHoteals

{
    
    
      /**

     * to sort hotels by hotals name  or price 
     * 
     * @return array of Data sorted      /
     *  @author Mahmoud Azmi <makoamin@gmail.com> 
     */

    public function SortHotels ()
    {
        
           $dataSortIn = $this->getArrayOfSearch();
       
        $SortHotel= array () ;
          if($dataSortIn == 0 ){return $this->ArrayOfHotels ;}
        foreach ($dataSortIn as $name) {
            foreach ($this->ArrayOfHotels as $hotel) {
                
                if (isset($this->SearchCriteria->Sort) and $this->SearchCriteria->Sort == 'Hotel Name') {
                    if ($hotel->name == $name) {
                       
                        $SortHotel[] = $hotel;
                    }
                } elseif (isset($this->SearchCriteria->Sort) and $this->SearchCriteria->Sort == 'Price') {
                    if ($hotel->price == $name) {
                        $SortHotel[] = $hotel;
                    }
                }
            }
        }

        return $SortHotel ;
        
    }

      /**

     * to get data sorted  
   
     * @return array of hotel named or pricess       /
     *  @author Mahmoud Azmi <makoamin@gmail.com> 
     */
    private function getArrayOfSearch() {

   
        foreach ($this->ArrayOfHotels as $hotel) {
            
            if (isset($this->SearchCriteria->Sort) and $this->SearchCriteria->Sort == 'Hotel Name') {
                $arrayFiledSort[] = $hotel->name;
            } elseif (isset($this->SearchCriteria->Sort) and $this->SearchCriteria->Sort == 'Price') {
                $arrayFiledSort[] = $hotel->price;
            }
        }
        if(isset($arrayFiledSort) &&  is_array($arrayFiledSort)){
             sort($arrayFiledSort);
         return $arrayFiledSort ;
        }
        return 0 ;
    }

}