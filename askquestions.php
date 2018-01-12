<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Ask Questions</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

    </style>
</head>
<body>



<?php
// connect to the database
include_once('homepage.php');
require_once('connect-db.php');

if (empty($_POST['question'])) {

}
else
{
    $question = $_POST['question'];
    $userid = $_POST['userId'];
    $classId = $_POST['selectedClass'];
    $query = "INSERT INTO questions(Question, UserId, ClassId) VALUES ('$question','$userid','$classId')";
    $result = mysqli_query($mysqli, $query);
    if($result){
        $smsg = "Question Posted to the class.";
        $class = $mysqli->query("select * from class where Id = '$classId'");
        $class_row = $class->fetch_object();
        $mysqli->query("update notifications set Questions = Questions +1 where UserId = '$class_row->Professor '");
    }else{
        $fmsg = "Failure while posting the question.";
    }


}
if ($res = $mysqli->query("select * from login where Username='$login_session'")){
    $row1 = $res->fetch_object();
    $id = $row1->Id;

}

$query = "UPDATE notifications set Answers = 0 where UserId = '$id'";
$result = mysqli_query($mysqli, $query);

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM enroll WHERE UserId = '$id'"))
{
// display records if there are records to display
    if ($result->num_rows > 0)
    {
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4'>";
        /*echo <<<_END
        <form method='post' action='creategiftcard.php'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' class="btn btn-success btn-block" value='Create Gift Card'>
        </form>
        </br>
        _END;*/

        echo "</br>";
        echo "<form method='post' action='askquestions.php' id=\"viewEnrolledClassForm\">";
        echo " <div class='form-group'>";
        echo "<label for='enrolledclass' class='list-classes-txt'>Post Questions for an Enrolled Class</label>";
        echo "<div class=\"form-group\" name=\"classId\" id=\"classId\" class=\"form-control\" required>";
        echo "<select id='selectedClass', name='selectedClass', class=\"form-control\">";
        while ($row = $result->fetch_object()) {
            $class = $mysqli->query("select * from class where Id='$row->ClassId'");
            $class_row = $class->fetch_object();
            if (empty($_POST['selectedClass'])) {
                echo "<option value = ".$row->ClassId.">". $class_row-> Name ."</option>";
            }
            else
            {
                $classId = $_POST['selectedClass'];
                if ($classId == $row->ClassId){
                    echo "<option selected value = ".$row->ClassId.">". $class_row-> Name ."</option>";
                }
                else{
                    echo "<option value = ".$row->ClassId.">". $class_row-> Name ."</option>";
                }

            }
        }
        echo "</select>";
        echo "</div>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Submit</button>";
        echo "</form>";
        echo "</br>";


        if (empty($_POST['selectedClass']) ) {

        }
        else {
            $classId = $_POST['selectedClass'];
            $questions = $mysqli->query("select * from questions where UserId ='$id' and ClassId='$classId'");
            if ($questions->num_rows > 0) {
                while ($question_row = $questions->fetch_object()) {

                    echo "<div class=\"form-group\">";
                    echo "<label for=\"question\">Question:</label>";
                    echo "<textarea class=\"form-control\" rows=\"3\" id=\"question\" disabled>". $question_row->Question ."</textarea>";
                    echo "<label for=\"answer\">Answer:</label>";
                    echo "<textarea class=\"form-control\" rows=\"3\" id=\"answer\" disabled>". $question_row->Answer ."</textarea>";
                    echo "</div>";

                }

                echo "<form method='post' action='askquestions.php' id=\"askQuestionForm\">";
                echo "<div class=\"form-group\">";
                echo "<label for=\"question\">Question:</label>";
                echo "<textarea class=\"form-control\" rows=\"3\" name='question' id=\"question\" placeholder='Ask a question' required></textarea>";
                echo "</div>";
                echo "<input type='hidden' name='selectedClass' id='selectedClass' value='$classId'>";
                echo "<input type='hidden' name='userId' id='userId' value='$id'>";
                echo "<button type='submit' class='btn btn-info'>Post Question</button>";
                echo "</form>";

            }
            else
            {
                echo "<form method='post' action='askquestions.php' id=\"askQuestionForm\">";
                echo "<div class=\"form-group\">";
                echo "<label for=\"question\">Question:</label>";
                echo "<textarea class=\"form-control\" rows=\"3\" name='question' id=\"question\" placeholder='Ask a question' required></textarea>";
                echo "</div>";
                echo "<input type='hidden' name='selectedClass' id='selectedClass' value='$classId'>";
                echo "<input type='hidden' name='userId' id='userId' value='$id'>";
                echo "<button type='submit' class='btn btn-info'>Post Question</button>";
                echo "</form>";

            }
        }
    }
// if there are no records in the database, display an alert message
    else
    {
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4'>";
        echo "</br></br>";
        echo "<center>There are no Enrolled Classes to view.</center><br>";
//echo <<<_END
//<form method='post' action='creategiftcard.php'>
//<input type='hidden' name='id' value='$id'>
//<input type='submit' class="btn btn-success btn-block" value='Create Gift Card'>
//</form>
//</br>
//_END;
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}
// show an error if there is an issue with the database query
else
{
    echo "Error: " . $mysqli->error;
}
// close database connection
$mysqli->close();

?>
</body>
</html>