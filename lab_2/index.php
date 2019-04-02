<?php
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;
	require 'vendor/autoload.php';

    require 'db_config.php';

	$app = new \Slim\App;



    //FOR TABLE CLIENT 
	$app->get('/getClients', function (Request $request, Response $response, array $args)
	{

        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getClients`"));

        JSON_save("lab_2.json", json_encode(array(
            'allClients'=> $result
        )), "GET");

        return $response->withJSON(
            ['allClients' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

	});

    $app->get('/getClient/{id_client}', function (Request $request, Response $response, array $args)
    {

        $id_client = (int)$args['id_client'];

        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getClient`('".$id_client."')"));

        JSON_save("lab_2.json", json_encode(array(
            'client'=> $result
        )), "GET");

        return $response->withJSON(
            ['client' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/addClient/{fio}&{phone}', function (Request $request, Response $response, array $args)
    {

        $fio_client = $args['fio'];
        $phone_client = $args['phone'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `addClient`('".$fio_client."', '".$phone_client."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Client added")), "POST");
        }

        return $response->withJSON(
            ['result' => "Client added"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/editClient/{editing_client_id}&{fio}&{phone}', function (Request $request, Response $response, array $args)
    {

        $editing_client_id = (int)$args['editing_client_id'];
        $fio_client = $args['fio'];
        $phone_client = $args['phone'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `editClient`('".$editing_client_id."', '".$fio_client."', '".$phone_client."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Client edited")), "PUT");
        }

        return $response->withJSON(
            ['result' => "Client edited"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });


    $app->get('/deleteClient/{deleting_client_id}', function (Request $request, Response $response, array $args)
    {

        $deleting_client_id = (int)$args['deleting_client_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `deleteClient`('".$deleting_client_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Client deleted")), "DELETE");
        }

        return $response->withJSON(
            ['result' => "Client deleted"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });


    //FOR TABLE REQUEST
    $app->get('/getRequests', function (Request $request, Response $response, array $args)
    {
        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getRequests`"));

        JSON_save("lab_2.json", json_encode(array(
            'allRequests'=> $result
        )), "GET");

        return $response->withJSON(
            ['allRequests' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/getRequest/{id_request}', function (Request $request, Response $response, array $args)
    {

        $id_request = (int)$args['id_request'];

        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getRequest`('".$id_request."')"));

        JSON_save("lab_2.json", json_encode(array(
            'request'=> $result
        )), "GET");

        return $response->withJSON(
            ['request' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/addRequest/{client_id}', function (Request $request, Response $response, array $args)
    {

        $client_id = (int)$args['client_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `addRequest`('".$client_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Request added")), "POST");
        }

        return $response->withJSON(
            ['result' => "Request added"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/editRequest/{editing_request_id}&{client_id}', function (Request $request, Response $response, array $args)
    {

        $editing_request_id = (int)$args['editing_request_id'];
        $client_id = (int)$args['client_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `editRequest`('".$editing_request_id."', '".$client_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Request edited")), "PUT");
        }

        return $response->withJSON(
            ['result' => "Request edited"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/deleteRequest/{deleting_request_id}', function (Request $request, Response $response, array $args)
    {

        $deleting_request_id = (int)$args['deleting_request_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `deleteRequest`('".$deleting_request_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Request deleted")), "DELETE");
        }

        return $response->withJSON(
            ['result' => "Request deleted"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    //FOR TABLE SERVICE
    $app->get('/getServices', function (Request $request, Response $response, array $args)
    {

        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getServices`"));

        JSON_save("lab_2.json", json_encode(array(
            'allServices'=> $result
        )), "GET");

        return $response->withJSON(
            ['allServices' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/getService/{id_service}', function (Request $request, Response $response, array $args)
    {

        $id_service = (int)$args['id_service'];

        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getService`('".$id_service."')"));

        JSON_save("lab_2.json", json_encode(array(
            'service'=> $result
        )), "GET");

        return $response->withJSON(
            ['service' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/addService/{service_name}', function (Request $request, Response $response, array $args)
    {
        $service_name = $args['service_name'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `addService`('".$service_name."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Service added")), "POST");
        }

        return $response->withJSON(
            ['result' => "Service added"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/editService/{editing_service_id}&{service_name}', function (Request $request, Response $response, array $args)
    {

        $editing_service_id = (int)$args['editing_service_id'];
        $service_name = $args['service_name'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `editService`('".$editing_service_id."', '".$service_name."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Service edited")), "PUT");
        }

        return $response->withJSON(
            ['result' => "Service edited"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/deleteService/{deleting_service_id}', function (Request $request, Response $response, array $args)
    {

        $deleting_service_id = (int)$args['deleting_service_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `deleteService`('".$deleting_service_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Service deleted")), "DELETE");
        }

        return $response->withJSON(
            ['result' => "Service deleted"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    //FOR TABLE REQUEST_SERVICE
    $app->get('/getRequestServices', function (Request $request, Response $response, array $args)
    {

        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getRequestServices`"));

        JSON_save("lab_2.json", json_encode(array(
            'allRequestServices'=> $result
        )), "GET");

        return $response->withJSON(
            ['allRequestServices' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/getServicesByRequest/{id_request}', function (Request $request, Response $response, array $args)
    {

        $id_request = (int)$args['id_request'];

        $result = mysqli_fetch_all(mysqli_query($GLOBALS["connection"], "CALL `getServicesByRequest`('".$id_request."')"));

        JSON_save("lab_2.json", json_encode(array(
            'servicesList'=> $result
        )), "GET");

        return $response->withJSON(
            ['servicesList' => $result],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/addRequestService/{request_id}&{service_id}', function (Request $request, Response $response, array $args)
    {
        $request_id = (int)$args['request_id'];
        $service_id = (int)$args['service_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `addRequestService`('".$request_id."', '".$service_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "RequestService added")), "POST");
        }

        return $response->withJSON(
            ['result' => "RequestService added"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/editRequestService/{editing_request_id}&{editing_service_id}&{new_service_id}', function (Request $request, Response $response, array $args)
    {

        $editing_request_id = (int)$args['editing_request_id'];
        $editing_service_id = $args['editing_service_id'];
        $new_service_id = $args['new_service_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `editRequestService`('".$editing_request_id."', '".$editing_service_id."', '".$new_service_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "RequestService edited")), "PUT");
        }

        return $response->withJSON(
            ['result' => "RequestService edited"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

    $app->get('/deleteServiceFromRequest/{editing_request_id}&{deleting_service_id}', function (Request $request, Response $response, array $args)
    {
        $editing_request_id = (int)$args['editing_request_id'];
        $deleting_service_id = (int)$args['deleting_service_id'];

        $result = mysqli_query($GLOBALS["connection"], "CALL `deleteServiceFromRequest`('".$editing_request_id."', '".$deleting_service_id."')");

        if ($result == "1")
        {
           JSON_save("lab_2.json", json_encode(array('result'=> "Service deleted from request succesfully")), "DELETE");
        }

        return $response->withJSON(
            ['result' => "Service deleted from request succesfully"],
            200,
            JSON_UNESCAPED_UNICODE
        );

    });

	function JSON_save($filename, $response, $method)
	{
		$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$example = array(
			'url' => $url,
			'response' => $response,
			'method' => $method);
		$json_example = json_encode($example, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		file_put_contents($filename, $json_example . "\n", FILE_APPEND | LOCK_EX);
	}


    $app->run();
?>
