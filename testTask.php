
<?php

$Request['HotelName'] ='Hotel' ;
$Request['Destination'] ='cairo' ;
$Request['Price']['from'] ='50' ;
$Request['Price ']['to'] ='200' ;

$Request['Date']['from'] ='11-10-2020' ;
$Request['Date']['to'] ='12-10-2020' ;

$requestJson = urlencode(json_encode($Request));
$Data = file_get_contents('http://localhost:8000/search?request='.$requestJson ) ;
header('Content-type: application/json');
echo $Data;
?>