<?php



namespace App\Classes;
 

abstract class Hotels {
    
     /**

     *
     * @var type      /
     */
     protected $ArrayOfHotels  = array ();
    
    /**

     *
     * @var type      /
     */
    protected  $SearchCriteria = array() ;
    
    /**

     * 
     * @param type $ArrayOfHotels     /
     */
    public function setArrayOfHotels($ArrayOfHotels)
    {
        $this->ArrayOfHotels = $ArrayOfHotels ;
    }
    /**

     * 
     * @param array  $SearchCriteria     /
     */
    
    public function setSearchCriteria($SearchCriteria)
    {
        $this->SearchCriteria = $SearchCriteria ;
    }
    
  
}
