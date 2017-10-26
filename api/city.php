<?php

// Infographics
$app->get('/api/city/{name}', function ($request, $response ) {
	
	require_once('../config/db-config.php');

	$cityShort = $request->getAttribute('name');
	$cityLong = $request->getAttribute('name'). ' city';
    $query = "select city.id, city.city, city.province, province.province as province_name, province.id as province_id from city inner join province on (city.province = province.id) where city.city like '$cityShort' or city.city like '$cityLong' limit 0,10" ;
    $result = $mysqli->query($query);

    if($result){
    	 while($row = $result->fetch_assoc()){
	    	$data[] = $row;
	    }
    }else{
    	$data = [
    		[
    			"result"=>"No Result"
    		]
    	];
    }
   

    echo json_encode($data);
});

$app->get('/api/city', function ($request, $response ) {
	
	require_once('../config/db-config.php');

	$cityShort = $request->getAttribute('name');
	$cityLong = $request->getAttribute('name'). ' city';
    $query = "select * from city limit 0,10" ;
    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()){
    	$data[] = $row;
    }
    //echo $query;
    echo json_encode($data);

});


?>