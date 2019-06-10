<?php
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;
	use Slim\Views\PhpRenderer;
	require 'vendor/autoload.php';

	function SQL_QUERY($sql_request)
	{
		$_GLOBALS['connection'] = mysqli_connect("127.0.0.1", "root", "", "LAB6_TEST_API");
		if ($_GLOBALS['connection'] == false)
		{
			exit();
		}

		return mysqli_query($_GLOBALS['connection'], $sql_request);
	}

	$app = new \Slim\App;

	$container = $app->getContainer();
	$container['view'] = function ($container)
	{
	    return new \Slim\Views\PhpRenderer('TESTS_CLIENT/');
	};


	$app->get('/', function (Request $request, Response $response, array $args)
	{
		return $this->view->render($response, 'main.php', []);
	});


	$app->get('/manageTests/', function (Request $request, Response $response, array $args)
	{
		$listTests = mysqli_fetch_all(SQL_QUERY(
			"CALL `allTestsList`()"
		));
		return $this->view->render($response, 'manage_tests.php', ['listTests' => $listTests]);
	});

	$app->get('/addNewTest/', function (Request $request, Response $response, array $args)
	{
		return $this->view->render($response, 'addTest.php', []);
	});

	$app->post('/addNewTest/', function (Request $request, Response $response, array $args)
	{
		$newTestName = $request->getParam('newTestName');
		if (!$newTestName == "")
		{
			$res1 = SQL_QUERY("CALL `addNewTest`('$newTestName')");
			$lastAddedTest = mysqli_fetch_assoc(SQL_QUERY("CALL `lastAddedNewTest`()"));

			if ($res1 == 1)
			{
				return $response->withRedirect("http://localhost/LAB6_TESTS_SERVER/changeTest/".$lastAddedTest["ID_Test"]);
				//return $this->view->render($response, 'main.php', []);
			}
			else
			{
				echo "Тест не добавлен!";
			}
		}
		else
		{
			echo "Тест не добавлен!";
		}
		
	});

	$app->get('/deleteTest/{ID_Test}', function (Request $request, Response $response, array $args)
	{
		$idTest = $args['ID_Test'];
		//echo $idTest;
		$res2 = SQL_QUERY("CALL `deleteTest`('$idTest')");
		if ($res2 == 1)
		{
			$depeQuestions = SQL_QUERY("CALL `allQuestions`('$idTest')");
			while ($question = mysqli_fetch_assoc($depeQuestions))
			{
				$ID_q = $question['ID_Question'];
				SQL_QUERY("CALL `deleteQuestionAnswers`('$ID_q')");
			}
			SQL_QUERY("CALL `deleteTestAllQuestions` ('$idTest')");
			return $response->withRedirect('http://localhost/LAB6_TESTS_SERVER/manageTests/');
		}
		else
		{
			echo "Тест не удален!";
		}
		//return $this->view->render($response, 'addTest.php', []);
	});


	$app->get('/changeTest/{ID_Test}', function (Request $request, Response $response, array $args)
	{
		$idTest = $args['ID_Test'];
		//echo $idTest;
		$listQuestions = mysqli_fetch_all(SQL_QUERY("CALL `allQuestions`('$idTest')"));

		return $this->view->render($response, 'addTestQuestions.php', [
			'listQuestions' => $listQuestions,
			"testId" => $idTest
		]);
	});

	$app->get('/addNewQuestion/{ID_Test}', function (Request $request, Response $response, array $args)
	{
		$thisidTest = $args['ID_Test'];
		return $this->view->render($response, 'addNewQuestionForTest.php', [
			'idTest' => $thisidTest
		]);
	});

	$app->post('/addNewQuestion/{ID_Test}', function (Request $request, Response $response, array $args)
	{
		$testID = $args['ID_Test'];
		$newQuestionName = $request->getParam('newQuestionName');
		//echo $testID;
		//echo $newQuestionName;
		$insertQuestionCommand = SQL_QUERY("CALL `addQuestionTest`('$testID', '$newQuestionName')");

		if ($insertQuestionCommand == 1)
		{
			return $response->withRedirect("http://localhost/LAB6_TESTS_SERVER/changeTest/$testID");
		}
		else
		{
			echo "Вопросы к тесту не добавлены!";
		}

	});


	$app->get('/deleteTestQuestion/{ID_Test}/{ID_Question}', function (Request $request, Response $response, array $args)
	{
		$ID_Test = $args['ID_Test'];
		$ID_Question = $args['ID_Question'];
		//echo $idTest;
		$res2 = SQL_QUERY("CALL `deleteTestQuestion`('$ID_Question')");
		if ($res2 == 1)
		{	
			SQL_QUERY("CALL `deleteQuestionAnswers`('$ID_Question')");
			return $response->withRedirect('http://localhost/LAB6_TESTS_SERVER/changeTest/'.$ID_Test);
		}
		else
		{
			echo "Тест не удален!";
		}
		//return $this->view->render($response, 'addTest.php', []);
	});


	$app->get('/changeTestQuestionAnswers/{ID_TEST}/{ID_Question}/', function (Request $request, Response $response, array $args)
	{
		$idTest = $args['ID_TEST'];
		$idQuestion = $args['ID_Question'];

		$allAnswersByQuestion = mysqli_fetch_all(SQL_QUERY( "CALL `allAnswersByQuestion`('$idQuestion')" ));
		$thisQuestionAnswer = mysqli_fetch_assoc(SQL_QUERY("CALL `questionTrueAnswer`('$idQuestion')"));


		return $this->view->render($response, 'changeTestQuestionAnswers.php', [
			'idTest' => $idTest,
			'idQuestion' => $idQuestion,
			'questionAnswers' => $allAnswersByQuestion,
			'trueAnswer' => $thisQuestionAnswer['answer_Question']
		]);
	});



	$app->get('/addAnswers/{ID_Question}/{mainAnswer}/{textAnswer}', function (Request $request, Response $response, array $args)
	{
		$idQuestion = $args['ID_Question'];

		$mainAnswer = $args['mainAnswer'];
		$textAnswer = urldecode($args['textAnswer']);

		if ($mainAnswer == 1 or $mainAnswer == "1")
		{
			SQL_QUERY("UPDATE Question SET answer_Question = '$textAnswer' WHERE ID_Question = $idQuestion ");
		}

		$addAnswer = SQL_QUERY( "CALL `addAnswer`('$idQuestion', '$textAnswer')" );

		if ($addAnswer == 1)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}

	});






	$app->get('/passTests/', function (Request $request, Response $response, array $args)
	{
		return $this->view->render($response, 'testing.php', []);
	});

	

    $app->run();


?>
