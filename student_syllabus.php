<?php
require_once("connection.php");
require_once("link.php");
include_once("header.php");
echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>
<center >";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['subject_dropdown']))
     {
        $selected_subject = $_POST['subject_dropdown'];
        $query = "SELECT syllabus FROM std_syllabus WHERE subject='$selected_subject'";
        $result = mysqli_query($con_status, $query);

        if (mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_array($result); 
            echo "<br><br><h2>Syllabus for ".$selected_subject."</h2><br><br>";
            echo "<img src='".$row['syllabus']."' style='width:200px;'>"; 
           // print_r($row);
            echo "</br></br> <a href='student_syllabus.php'>Back</a>";
        } 
        else
         {
            echo "No syllabus found for the selected subject.";
        }
    } 
    elseif (isset($_POST['class_dropdown']))
     {
        $selected_class = $_POST['class_dropdown'];
        $query = "SELECT subject, sub_code FROM std_syllabus WHERE class='$selected_class'";
        $result = mysqli_query($con_status, $query);

        if (mysqli_num_rows($result) > 0)
         {
            echo "<br><br><h2>Select a Subject</h2></br></br>";
            echo "<form method='POST' action=''>";
            echo "<select name='subject_dropdown' class='form-control' style='width:200px;'>";
            while ($row = mysqli_fetch_assoc($result))
             { 
                echo "<option value='".$row['subject']."'>".$row['subject']." - ".$row['sub_code']."</option>";
            }
            echo "</select>";
            echo "<br/><br/></br><input type='submit' value='Show Syllabus' class='btn btn-info'>";
            echo "</form>";
        } 
        else 
        {
            echo "No subjects";
        }
    }
} 
else 
{
    $query = "SELECT DISTINCT class FROM std_syllabus";
    $result = mysqli_query($con_status, $query);

    if (mysqli_num_rows($result) > 0) 
    {
        echo "<br/><br/><h2>Select a Class</h2></br></br>";
        echo "<form method='POST' action='' >";
        echo "<select name='class_dropdown' class='form-control' style='width: 200px;' onchange='this.form.submit()'>";
        echo "<option>select class</option>";
        while ($row = mysqli_fetch_array($result)) 
        { 
            echo "<option value='".$row['class']."'>".$row['class']."</option>";
        }
        echo "</select>";
        echo "</form></center>";
    }
}
echo "</div></div></div>";

include_once("footer.php");
?>

