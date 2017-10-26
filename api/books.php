<?php


$app->get('/api/book/{id}', function ($request, $response ) {
	
	require_once('../config/db-config.php');

	$book_id = $request->getAttribute('id');
    $query = "select * from books where  id = $book_id";
    $result = $mysqli->query($query);

    
    $row = $result->fetch_assoc();
    if($row ==null){
    	$row = [
    			"result"=>"No Result"
    		];
    }
    $response = $row;
    echo json_encode($response);

});


// Infographics
$app->get('/api/province', function ($request, $response ) {
	
	$data = file_get_contents('data.json');
    
    echo  json_encode( $data );

});


// $app->get('/{name}', function ($request, $response) {
// 	$name = $request->getAttribute('name');
//     $response->getBody()->write("Hello, " . $name);
//     return $response;
// });

// $app->get('/books/{name}', function ($request, $response, $args) {
// 	$name = $args['name'];
//     $response->getBody()->write("Book: " . $name);
//     return $response;
// });

?>