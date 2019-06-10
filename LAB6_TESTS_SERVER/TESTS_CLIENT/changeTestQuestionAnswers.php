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
      .row .answers .answer input
      {
        font-size: 3.5vh;
      }
      .row .answers .answer input[type="text"]
      {
        width: 950px;
        padding: 0 0 0 10px;
        border-radius: 5px;
        border: 1px solid #b5b5b5;
      }

      .row .optionAdd input
      {
        background-color: #0aaa65;
        color: #fff;
        font-size: 2.5vh;
        border-radius: 3px;
        border: none;
        padding: 5px 15px;
        margin-left: 50px;
      }
      .row .optionAdd
      {
        display: none;
      }
      
      .row .optionSaveAnswers
      {
        text-align: right;
      }
      .row .optionSaveAnswers input
      {
        background-color: #8cba0e;
        color: #fff;
        font-size: 2.5vh;
        border-radius: 3px;
        border: none;
        padding: 5px 15px;
        margin-left: 50px;
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
            <li><a href="http://localhost/LAB6_TESTS_SERVER/changeTest/<?php echo $idTest; ?>"><< вопросы</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    	<div class="row" style="text-align: right;">
			<a id="addAnswerBtn" class="btn btn-warning" href="http://localhost/LAB6_TESTS_SERVER/changeTestQuestionAnswers/<?php echo $testId; ?>">Добавить ответы к вопросу</a><br><br>
	  </div>

		<div class="row"><h1>Ответы к вопросу</h1><br>
		  <div class="answers">
    <?php 

     //echo "<pre>";
      //var_dump($questionAnswers);
      if (count($questionAnswers) > 0)
      {
        for ($k=0; $k < count($questionAnswers); $k++)
        { 
          if ($trueAnswer == $questionAnswers[$k][1])
          {
            echo "<div class=\"answer\"><input class=\"radCheck\" type=\"radio\" name=\"main_answer\" checked/><input class=\"answerText\" type=\"text\" placeholder=\"следующий ответ\" id=\"".$questionAnswers[$k][0]."\" value=\"".$questionAnswers[$k][1]."\" /></div><br>";
          }
          else
          {
            echo "<div class=\"answer\"><input class=\"radCheck\" type=\"radio\" name=\"main_answer\"/><input class=\"answerText\" type=\"text\" placeholder=\"следующий ответ\" id=\"".$questionAnswers[$k][0]."\" value=\"".$questionAnswers[$k][1]."\" /></div><br>";
          }
          
        }
      }

    ?>
      </div>
      <br>
      
      <div class="optionAdd">
        <input type="button" value="Добавить еще один ответ">
      </div>
      <hr>
      <div class="optionSaveAnswers" name="<?php echo $idQuestion; ?>">
        <input type="button" value="Сохранить ответы">
      </div>
	  </div>
    </div><!-- /.container -->

<script>
  $(document).ready(function ()
    {
      var addButton = $('#addAnswerBtn');
      var answersBag = $('.row .answers');

      var questionId = $('.row .optionSaveAnswers').attr("name");

      addButton.click(function (event)
        {
          event.preventDefault();

          var answers_count = answersBag.find(".answer").length;

          if (answers_count == 0)
          {

            for (var cc = 0; cc < 2; cc++)
            {
              if (cc == 0)
              {
                answersBag.append( $( "<div class=\"answer\"><input class=\"radCheck\" type=\"radio\" name=\"main_answer\" checked/><input class=\"answerText\" type=\"text\" placeholder=\"ответ "+(cc+1)+"\"/></div><br>" )).hide().slideDown();
              }
              else
              {
                answersBag.append( $( "<div class=\"answer\"><input class=\"radCheck\" type=\"radio\" name=\"main_answer\"/><input class=\"answerText\" type=\"text\" placeholder=\"ответ "+(cc+1)+"\"/></div><br>" )).hide().slideDown();
              }
              
            }
            
            $('.row .optionAdd').fadeIn("slow");
          }

        });







      var addAnotherAnswerBtn = $('.row .optionAdd input');
      addAnotherAnswerBtn.click(function (event)
        {
          event.preventDefault();

          var answers_count = answersBag.find(".answer").length;


          if (answers_count > 0 && answers_count < 4)
          {
            answersBag.append( $( "<div class=\"answer\"><input class=\"radCheck\" type=\"radio\" name=\"main_answer\"/><input class=\"answerText\" type=\"text\" placeholder=\"следующий ответ\"/></div><br>" ) );
          }
          if (answers_count == 4)
          {
            alert("Максимальное количество ответов 4!\nБольше нельзя добавить!");
          }
          

        });




      var saveAnswerBtn = $('.row .optionSaveAnswers input');
      saveAnswerBtn.click(function (event)
        {
          event.preventDefault();

          var answersAll = answersBag.find(".answer");
          //alert(answers.length);

          var alertSave = true;

          answersAll.each(function()
            {
              //alert($(this).find(".answerText").val());
              var mainAnswer = $(this).find(".radCheck").is(':checked');
              var answerText = $(this).find(".answerText").val();

              var trueAnswer = "";

              if (mainAnswer == true){ trueAnswer = "1"; }
              else{ trueAnswer = "0"; }

              var getLink = "http://localhost/LAB6_TESTS_SERVER/addAnswers/"+questionId+"/"+trueAnswer+"/"+encodeURIComponent(answerText);
              //alert(getLink);

                $.ajax(
                {
                  type: "GET",
                  url: getLink,
                  success: function(msg)
                  {
                    if(msg == 1 || msg == "1")
                    {
                      alertSave = true;
                    }
                    else
                    {
                      alertSave = false;
                    }
                    //alert( "Прибыли данные: " + msg );
                  }
                });
              
            });

          if (alertSave){alert("Ответы сохранены");}
          else{alert("Не удалось сохранить ответы");}

          
          

        });

    });
</script>
</body>
</html>