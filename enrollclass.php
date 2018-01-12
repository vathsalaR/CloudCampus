<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Enroll Class</title>
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
if (empty($_POST['id']) || empty($_POST['classid'])) {

}
else
{
    $id = $_POST['id'];
    $classid = $_POST['classid'];
    $type = $_POST['type'];
    if($type == 'enroll'){
        $query = "select * from enroll where UserId = '$id' and ClassId = '$classid'";
        $result = mysqli_query($mysqli, $query);
        if($result->num_rows > 0)
        {
            $fmsg = "You are already enrolled in the class";
        }
        else
        {
            $query = "INSERT INTO enroll(UserId, ClassId) VALUES ('$id','$classid')";
            $result = mysqli_query($mysqli, $query);
            if($result){
                $smsg = "Class Enrollment is Successful.";
            }else{
                $fmsg = "Class Enrollment Failed.";
            }


        }
    }
    else{
        $query = "select * from enroll where UserId = '$id' and ClassId = '$classid'";
        $result = mysqli_query($mysqli, $query);
        if($result->num_rows == 0)
        {
            $fmsg = "You are trying to drop from an unenrolled class";
        }
        else
        {
            $query = "DELETE FROM enroll WHERE UserId= '$id' and ClassId = '$classid' ";
            $result = mysqli_query($mysqli, $query);
            if($result){
                $smsg = "You are Dropped from the class.";
            }else{
                $fmsg = "Dropping of class Failed.";
            }
        }

    }

}
if ($res = $mysqli->query("select * from login where Username='$login_session'")){
    $row1 = $res->fetch_object();
	$id = $row1->Id;

}
// get the records from the database
if ($result = $mysqli->query("SELECT * FROM class"))
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

echo "<h3><b><center class='list-classes-txt'>List of Classes for Enrollment</center></b></h3>";
echo "</br>";
echo "<table class='table table-striped table-hover' id='view-classes-table'>";

echo "<tbody>";
echo "<tr><th>Class Code</th><th>Class Name</th><th>Class Description</th><th>Professor</th><th>Enroll</th><th>Drop</th></tr>";
while ($row = $result->fetch_object())
{
$prof = $mysqli->query("select * from login where Id='$row->Professor'");
$prof_row = $prof->fetch_object();
echo "<tr>";
echo "<td>" . $row->Code . "</td>";
echo "<td>" . $row->Name . "</td>";
echo "<td>" . $row->Description . "</td>";
echo "<td>" . $prof_row->Name . "</td>";
echo "<td>";
echo <<<_END
<form method='post' action='enrollclass.php' id="form1">
<input type='hidden' name='id' value='$id'>
<input type='hidden' name='classid' value='$row->Id'>
<input type='hidden' name='type' value='enroll'>
<input type='submit' class="btn btn-success btn-block" value='Enroll'>
</form>
_END;
echo "</td>";
echo "<td>";
echo <<<_END
<form method='post' action='enrollclass.php' id="form1">
<input type='hidden' name='id' value='$id'>
<input type='hidden' name='classid' value='$row->Id'>
<input type='hidden' name='type' value='drop'>
<input type='submit' name='submit' class="btn btn-danger btn-block" value='Drop'>
</form>
_END;
echo "</td>";
echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</br></br>";
echo "</div>";
echo "</div>";
echo "</div>";
}
// if there are no records in the database, display an alert message
else
{
echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4'>";
echo "</br></br>";
echo "<center>Sorry there are no Gift Cards for this username! Please create it by selecting 'Create Gift Card'</center><br>";
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