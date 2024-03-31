
<?php 
$server='localhost';
$user_id='root';
$password='';
$database='project_database1';
$con=mysqli_connect($server,$user_id,$password,$database);
if(!$con)
{header("Location:error_page.php?err=101");}
else
{echo "";}
?>











