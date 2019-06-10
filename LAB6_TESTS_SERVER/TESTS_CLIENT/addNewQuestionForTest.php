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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
          <a class="navbar-brand text-warning" href="http://localhost/LAB6_TESTS_SERVER/">Панель управления тестами</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://localhost/LAB6_TESTS_SERVER/changeTest/<?php echo $idTest; ?>"><< главная</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
		<form action="http://localhost/LAB6_TESTS_SERVER/addNewQuestion/<?php echo $idTest; ?>" method="POST" enctype="multipart/form-data">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Введите новый вопрос для теста:</label>
		    <input type="text" name="newQuestionName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Что такое бла бла бла...?">
		  </div>			
		<br><button type="submit" name="saveNewQuestion" class="btn btn-success">Сохранить вопрос</button>
		</form>
    </div><!-- /.container -->
    
</body>
</html>