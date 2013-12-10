<?php

ini_set('display_errors',1);

// now let's get the actual article from wikipedia

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
if ($input == NULL || !array_key_exists("title",$input) || $input['title'] == "") {
	header('HTTP/1.1 400 Bad Request');
	return;
}

$title = $input['title'];


// now we search for the topic
$parseUrl = "http://en.wikipedia.org/w/api.php?action=parse&page=" . urlencode($title) . "&format=json";

$parse = json_decode(curlRequest($parseUrl),true);

// parse the response
$text = $parse['parse']['text']['*'];

// strip out any JS scripts from the source so it won't be accidentally executed
$dom = new DOMDocument();
$dom->loadHTML($text);
$scripts = $dom->getElementsByTagName('script');
for ($i = 0; $i < $scripts->length; $i++) {
	$scripts->item($i)->parentNode->removeChild($scripts->item($i));
}
$text = $dom->saveHTML();


$response = $input;
$response['contents'] = $text;

echo json_encode($response);

?>