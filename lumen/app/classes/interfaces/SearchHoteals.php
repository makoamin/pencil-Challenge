<?php namespace App\Classes\interfaces;

interface SearchHoteals {

    /**
     * Push a new event to all clients.
     *
     * @param  string  $event
     * @param  array  $data
     * @return void
     */
    public function searchInHotels();

}