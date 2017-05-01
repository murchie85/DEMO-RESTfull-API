<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Get All jokes (doesn't work yet) 

$app->get('/api/jokes', function(Request $request, Response $response){
    $sql = "SELECT * FROM new_jokes";

        try{
            // Get DB object 
            $db = new db();
            // connect 
            $db = $db->connect(); 
            // when we are working with PDO we need to  create statements 
            // there are a few benefits to creating prepared statements
            // 1. the query only needs to be parsed once 
            // 2. can be executed multiple times with the same / or diff peramaters
            // 3. the parameters don't need to be quoted. 
            //stmt is standard 
            // passes in $sql var


            $stmt = $db->query($sql);
            $jokes = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            echo json_encode($jokes);


        } catch(PDOException $e){
            //e for errors exception handling
             echo '{"error": {"text": '.$e->getMessage().'}';
        }
});

//Get A SINGLE joke 
//****All jokes terms changed to joke, except in SQL statement
$app->get('/api/joke/{joke_index}', function(Request $request, Response $response){
    $joke_index = $request->getAttribute('joke_index');

    $sql = "SELECT * FROM new_jokes WHERE joke_index = $joke_index"; //$joke_index comes from the URL 

        try{
            // Get DB object 
            $db = new db();
            // connect 
            $db = $db->connect(); 


            $stmt = $db->query($sql);
            $joke = $stmt->fetchAll(PDO::FETCH_OBJ); // changed to singular
            $db = null;
            echo json_encode($joke);  // changed to singular


        } catch(PDOException $e){
            //e for errors exception handling
             echo '{"error": {"text": '.$e->getMessage().'}';
        }
});