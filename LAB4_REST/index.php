<?php
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;
	require 'vendor/autoload.php';



	$app = new \Slim\App;

	$app->get('/callapi/', function (Request $request, Response $response, array $args)
	{

        $url = 'http://www.mocky.io/v2/5c7db5e13100005a00375fda';
        $api_response = json_decode(file_get_contents($url));
        $text = $api_response->result;


        $output_text = str_replace(' ', '_', $text);


		JSON_save("lab_4.json", json_encode($output_text));
		return $response->withJSON(
	        ["result"=> $output_text],
	        200,
	        JSON_UNESCAPED_UNICODE
    	);
        
	});

    $app->run();



	function JSON_save($filename, $response)
	{
		$example = array(
			'result' => $response
        );
		$json_example = json_encode($example, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		file_put_contents($filename, $json_example . "\n", FILE_APPEND | LOCK_EX);
	}

?>
