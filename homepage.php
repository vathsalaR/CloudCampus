<?php
include('session.php');
?>
<html>
<head>
  <title>Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
    
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
	
  </style>
</head>
<body>
  
<div class="container-fluid text-center">    
<div class="row">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="homepage.php">Cloud Campus</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav nav-stacked">
	  <li id="user-name"><?php echo $login_session; ?>&nbsp;<span class="glyphicon glyphicon-sunglasses"></span></li>






	</ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-bell"></span> Notifications (<b>

                        <?php
                        $ses_sql=mysqli_query($mysqli,"select * from notifications where UserId = '$login_id'");
                        $row = mysqli_fetch_assoc($ses_sql);
                        echo $row['Videos']+$row['Questions']+$row['Answers'];
                        echo "</b>)";
                        echo "</a>";
                        echo "<ul class=\"dropdown-menu notify-drop\" id=\"notification-li\">";
                        if($login_role == 'Student' && $row['Videos'] != 0) {

                            echo "<div class=\"notify-drop-title\">";
                            echo "<div class=\"row\">";
                            echo "<div class=\"col-md-6 col-sm-6 col-xs-6\" ><p class='text-info'>Videos (<b>" . $row['Videos'] . "</b>)</p>";
                            echo " </div>";
                            echo "<div class=\"col-md-6 col-sm-6 col-xs-6 text-right\"><a href=\"\" class=\"rIcon allRead\" data-tooltip=\"tooltip\" data-placement=\"bottom\" title=\"tümü okundu.\"><i class=\"fa fa-dot-circle-o\"></i></a></div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class=\"drop-content\">";
                            echo "<li>";
                            echo "<div class=\"col-md-3 col-sm-3 col-xs-3\"><span class=\"glyphicon glyphicon-camera\"></span></div>";
                            echo "<div class=\"col-md-9 col-sm-9 col-xs-9 pd-l0\">";
                            echo "<p class='text-info'>You have " . $row['Videos'] . " Videos posted. View them in your View Enrolled Classes section.</p>";
                            echo "<hr>";
                            echo "<p class=\"time\">";
                            echo "</p>";
                            echo "</div>";
                            echo " </li>";
                            echo "</div>";

                        }
                        if($login_role == 'Professor' && $row['Questions'] != 0) {
                            echo "<div class=\"notify-drop-title\">";
                            echo "<div class=\"row\">";
                            echo "<div class=\"col-md-6 col-sm-6 col-xs-6\"><p class='text-info'>Questions (<b>" . $row['Questions'] . "</b>)</p>";
                            echo " </div>";
                            echo "<div class=\"col-md-6 col-sm-6 col-xs-6 text-right\"><a href=\"\" class=\"rIcon allRead\" data-tooltip=\"tooltip\" data-placement=\"bottom\" title=\"tümü okundu.\"><i class=\"fa fa-dot-circle-o\"></i></a></div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class=\"drop-content\">";
                            echo "<li>";
                            echo "<div class=\"col-md-3 col-sm-3 col-xs-3\"><span class=\"glyphicon glyphicon-question-sign\"></span></div>";
                            echo "<div class=\"col-md-9 col-sm-9 col-xs-9 pd-l0\">";
                            echo "<p class='text-info' >You have " . $row['Questions'] . " Question posted by students. View them in your Answer Questions section.</>";
                            echo "<hr>";
                            echo "<p class=\"time\">";
                            echo "</p>";
                            echo "</div>";
                            echo " </li>";
                            echo "</div>";
                        }

                        if($login_role == 'Student' && $row['Answers'] != 0) {


                            echo "<div class=\"notify-drop-title\">";
                            echo "<div class=\"row\">";
                            echo "<div class=\"col-md-6 col-sm-6 col-xs-6\">Answers <p class='text-info'>(<b>" . $row['Answers'] . "</b>)</p>";
                            echo " </div>";
                            echo "<div class=\"col-md-6 col-sm-6 col-xs-6 text-right\"><a href=\"\" class=\"rIcon allRead\" data-tooltip=\"tooltip\" data-placement=\"bottom\" title=\"tümü okundu.\"><i class=\"fa fa-dot-circle-o\"></i></a></div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class=\"drop-content\">";
                            echo "<li>";
                            echo "<div class=\"col-md-3 col-sm-3 col-xs-3\"><span class=\"glyphicon glyphicon-pencil\"></span></div>";
                            echo "<div class=\"col-md-9 col-sm-9 col-xs-9 pd-l0\">";
                            echo "<p class='text-info'>You have " . $row['Answers'] . " questions answered by your professors. View them in your Ask Questions section.</p>";
                            echo "<hr>";
                            echo "<p class=\"time\">";
                            echo "</p>";
                            echo "</div>";
                            echo " </li>";
                            echo "</div>";

                        }

                        echo "</ul>";

                        ?>
                    </li>

            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Logout</a></li>
        </ul>
    </div>
  </div>
</nav>
</div>
    <ul class="nav nav-pills nav-stacked" id="vertical-nav">
        <li><a href="#">Customer Profile  &nbsp;<span class="glyphicon glyphicon-user"></span></a></li>
        <?php

        ?>
        <?php
        if($login_role == 'Professor')
        {
            echo "<li><a href=\"addvideos.php\">Add Videos &nbsp;<span class=\"glyphicon glyphicon-camera\"></span></a></li>";
            echo "<li><a href=\"answerquestions.php\">Answer Questions &nbsp;<span class=\"glyphicon glyphicon-pencil\"></span></a></li>";
            echo "<li><a href=\"enrollclass.php\" class='disabled'>Enroll Class   &nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-search\"></span></a></li>";
            echo "<li><a href=\"viewenrolledclasses.php\" class='disabled'>View Enrolled Classes &nbsp;<span class=\"glyphicon glyphicon-list-alt\"></span></a></li>";
            echo "<li><a href=\"askquestions.php\" class='disabled'>Ask Questions &nbsp;<span class=\"glyphicon glyphicon-question-sign\"></span></a></li>";
        }
        if($login_role == 'Student')
        {
            echo "<li><a href=\"addvideos.php\" class='disabled'>Add Videos &nbsp;<span class=\"glyphicon glyphicon-camera\"></span></a></li>";
            echo "<li><a href=\"answerquestions.php\" class='disabled'>Answer Questions &nbsp;<span class=\"glyphicon glyphicon-pencil\"></span></a></li>";
            echo "<li><a href=\"enrollclass.php\">Enroll Class   &nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-search\"></span></a></li>";
            echo "<li><a href=\"viewenrolledclasses.php\">View Enrolled Classes &nbsp;<span class=\"glyphicon glyphicon-list-alt\"></span></a></li>";
            echo "<li><a href=\"askquestions.php\">Ask Questions &nbsp;<span class=\"glyphicon glyphicon-question-sign\"></span></a></li>";
        }
        ?>

<!--        <li><a href="redeem.php">Redeem</a></li>-->
    </ul>
</div>
 

</body>
</html>