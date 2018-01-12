<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Add Videos</title>
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
<script>
    function closeModal(){
        document.getElementsByClassName('modal')[0].classList.remove('show');
    }
</script>


<?php
// connect to the database
include_once('homepage.php');
require_once('connect-db.php');
if (empty($_POST['topic']) && empty($_POST['url'])) {

}
else
{
    $topic = $_POST['topic'];
    $url = $_POST['url'];
    $classId = $_POST['selectedClass'];
    $query = "INSERT INTO videos(ClassId, Links,Topic) VALUES ('$classId','$url','$topic')";
    $result = mysqli_query($mysqli, $query);
    if($result){
        $smsg = "Class Video URL added succesfully.";
        if ($res = $mysqli->query("SELECT * FROM enroll WHERE ClassId = '$classId'")) {
            // display records if there are records to display
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_object()) {
                    $class = $mysqli->query("update notifications set Videos = Videos +1 where UserId = '$row->UserId'");
                }
            }
        }
    }else{
        $fmsg = "Failure while adding the Class Streaming URL.";
    }


}
if ($res = $mysqli->query("select * from login where Username='$login_session'")){
    $row1 = $res->fetch_object();
    $id = $row1->Id;

}
// get the records from the database
if ($result = $mysqli->query("SELECT * FROM class WHERE Professor  = '$id'"))
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
        echo "<form method='post' action='addvideos.php' id=\"viewEnrolledClassForm\">";
        echo " <div class='form-group'>";
        echo "<label for='enrolledclass' class='list-classes-txt'>Select a Class to add video</label>";
        echo "<div class=\"form-group\" name=\"classId\" id=\"classId\" class=\"form-control\" required>";
        echo "<select id='selectedClass', name='selectedClass', class=\"form-control\">";
        while ($row = $result->fetch_object()) {
            if (empty($_POST['selectedClass'])) {
                echo "<option value = ".$row->Id.">". $row-> Name ."</option>";
            }
            else
            {
                $classId = $_POST['selectedClass'];
                if ($classId == $row->Id){
                    echo "<option selected value = ".$row->Id.">". $row-> Name ."</option>";
                }
                else{
                    echo "<option value = ".$row->Id.">". $row-> Name ."</option>";
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
            echo "<table class='table table-striped table-hover' id='list-topics'>";
            echo "<tbody>";
            echo "<tr><th>Topic</th><th>URL</th></tr>";
            $classId = $_POST['selectedClass'];
            $videos = $mysqli->query("select * from videos where ClassId='$classId'");
            if ($videos->num_rows > 0) {
                while ($video_row = $videos->fetch_object()) {
                    echo "<tr>";
                    echo "<td>" . $video_row->Topic . "</td>";
                    echo "<td><a style='cursor: pointer;'>" . $video_row->Links . "</a></td>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<form method='post' action='addvideos.php' id=\"viewEnrolledClassForm\">";
                echo " <div class='form-group'>";
                echo "<td> <input type=\"text\" name=\"topic\" id=\"topic\" tabindex=\"1\" class=\"form-control\" placeholder=\"Add Topic\" value=\"\" required></td>";
                echo "<td> <input type=\"text\" name=\"url\" id=\"url\" tabindex=\"1\" class=\"form-control\" placeholder=\"Add URL\" value=\"\" required></td>";
                echo "</div>";
                echo "</tr>";
                echo "</tbody>";
                echo "<tr>";
                echo "<td colspan='2'>";
                echo "<input type='hidden' name='selectedClass' id='selectedClass' value='$classId'>";
                echo "<button type='submit' class='btn btn-info'>Add Streaming URL</button>";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
                echo "</table>";
                echo "</br></br>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            else
            {

                echo "<tr>";
                echo "<form method='post' action='addvideos.php' id=\"viewEnrolledClassForm\">";
                echo " <div class='form-group'>";
                echo "<td> <input type=\"text\" name=\"topic\" id=\"topic\" tabindex=\"1\" class=\"form-control\" placeholder=\"Add Topic\" value=\"\" required></td>";
                echo "<td> <input type=\"text\" name=\"url\" id=\"url\" tabindex=\"1\" class=\"form-control\" placeholder=\"Add URL\" value=\"\" required></td>";
                echo "</div>";
                echo "</tr>";
                echo "</tbody>";
                echo "<tr>";
                echo "<td colspan='2'>";
                echo "<input type='hidden' name='selectedClass' id='selectedClass' value='$classId'>";
                echo "<button type='submit' class='btn btn-info'>Add Streaming URL</button>";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
                echo "</table>";
                echo "</br></br>";

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

<?php if(isset($smsg)){ ?>
    <div class="modal show" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p class ="text-success" ><?php echo $smsg; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Close</button>
                </div>
            </div>

        </div>
    </div>

<?php } ?>
<?php if(isset($fmsg)){ ?>

    <div class="modal show" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p class = "text-danger"><?php echo $fmsg; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Close</button>
                </div>
            </div>

        </div>
    </div>


<?php } ?>
</body>
</html>