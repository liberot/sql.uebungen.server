<?php require '../vendor/autoload.php';

$app = new Slim\App();

/*
$app->get('/hello/{name}', function ($request, $response, $args) {
	return $response->getBody()->write("Hello, " . $args['name']);
});
*/

$app->get("/", function ($request, $response, $args) {

	$doc = [];
	
	date_default_timezone_set("UTC");
	$doc["utc"] = [];
	$doc["utc"]["date"] = date("Y-m-d H:i:s");
	$doc["utc"]["stamp"] = date("U");
	$doc["utc"]["zone"] = date_default_timezone_get();	
	
	date_default_timezone_set("Europe/Berlin");
	$doc["default"] = [];
	$doc["default"]["date"] = date("Y-m-d H:i:s");
	$doc["default"]["stamp"] = date("U");
	$doc["default"]["zone"] = date_default_timezone_get();	
	
	$response->withStatus(200)
		->withHeader('Content-Type', 'text-plain; charset=utf-8')
		->withHeader('Content-Type', 'application/json; charset=utf-8')
		->write(json_encode($doc, JSON_PRETTY_PRINT));
});

$app->get("/select1st", function ($request, $response, $args) {

	require_once('../../.sqlexercises/db.conn.util.php');
	
	$sql = "call sqlexcdb.select_assets_by_release_id(1)";
	$doc = q($sql);

	$response->withStatus(200)
		->withHeader('Content-Type', 'text-plain; charset=utf-8')
		->withHeader('Content-Type', 'application/json; charset=utf-8')
		->write(json_encode($doc, JSON_PRETTY_PRINT));
});

$app->get("/select2nd", function ($request, $response, $args) {

	require_once('../../.sqlexercises/db.conn.util.php');
	
	$sql = "call sqlexcdb.select_assets_by_artist_id_2nd(1)";
	$doc = q($sql);

	$response->withStatus(200)
		->withHeader('Content-Type', 'text-plain; charset=utf-8')
		->withHeader('Content-Type', 'application/json; charset=utf-8')
		->write(json_encode($doc, JSON_PRETTY_PRINT));
});

$app->run();




exit();
