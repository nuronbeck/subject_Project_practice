<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Панель управления тестами</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
	    body
	    {
			font-family: 'Varela Round', sans-serif;
		}

	</style>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand text-warning" href="">Панель управления тестами</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://localhost/LAB6_TESTS_SERVER/manageTests/"><< тесты</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    	<div class="row" style="text-align: right;">
			<a class="btn btn-success" href="http://localhost/LAB6_TESTS_SERVER/addNewQuestion/<?php echo $testId; ?>">Добавить новый вопрос к тесту</a><br><br>
	  </div>

		<div class="row"><h1>Все вопросы теста</h1><br>
		<?php
			//echo "<pre>";
			//var_dump($listQuestions);
			for ($i=0; $i < count($listQuestions); $i++)
			{ 	
				echo "<h3>";
				echo ($i+1).". ".$listQuestions[$i][1];
				echo "<h3>";
				echo "<div class=\"row\" style=\"text-align: right;\">";
				echo "<a class=\"btn btn-primary\" href=\"http://localhost/LAB6_TESTS_SERVER/changeTestQuestionAnswers/".$testId."/".$listQuestions[$i][0]."/\">Изменить варианты ответов</a>|";
				echo "<a class=\"btn btn-danger\" href=\"http://localhost/LAB6_TESTS_SERVER/deleteTestQuestion/".$testId."/".$listQuestions[$i][0]."\">Удалить вопрос из теста</a>";
				echo "</div>";
				echo "<hr>";
			}
		?>
	  </div>
    </div><!-- /.container -->
</body>
</html>