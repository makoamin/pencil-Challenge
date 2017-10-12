<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSearch()
    {
        $Request['HotelName'] ='Hotel' ;
        $Request['Destination'] ='cairo' ;
        $Request['Price']['from'] ='50' ;
        $Request['Price ']['to'] ='200' ;
        //
        $Request['Date']['from'] ='11-10-2020' ;
        $Request['Date']['to'] ='12-10-2020' ;
        $Request['Sort'] = 'Hotel Name' ; 
        $this->json('get', '/search', $Request)
             ->seeJson([
                'created' => true,
             ]);
        
    }
}
