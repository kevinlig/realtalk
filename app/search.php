<?php

ini_set('display_errors',1);

// YES we should make a RESTful API
// but we are literally doing 1 thing, so we won't


function curlRequest($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// per Wikipedia's request, let's set the user agent
	curl_setopt($ch, CURLOPT_USERAGENT, 'RealTalkLorem/1.0 (http://realtalk-lorem.herokuapp.com)');
	$body = curl_exec($ch);
	return $body;
}

// parse the incoming data
$input = json_decode(file_get_contents('php://input'),true);
// validate the contents
if ($input == NULL || !array_key_exists("topic",$input) || !array_key_exists("paragraphs",$input)) {
	header('HTTP/1.1 400 Bad Request');
	return;
}

$topic = $input['topic'];
$paragraphs = $input['paragraphs'];

// do some more validation
if ($topic == "" || !is_int($paragraphs) || $paragraphs < 1 || $paragraphs > 6) {
	// still invalid
	header('HTTP/1.1 400 Bad Request');
	return;
}


// now we search for the topic
$searchUrl = "http://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=" . urlencode($topic) . "&srlimit=5&srprop=title&format=json";

$search = json_decode(curlRequest($searchUrl),true);

// parse the response
$result = $search['query']['search'];

$response = $input;
$response['results'] = $result;

echo json_encode($response);

?>