<?php
require_once('connection.php'); 
?>

<html>

<head>
<?php
require_once('link.php'); 
?>

<style>
#t1
{
border:0px solid black;	
width:80%;
}
th,td
{font-size:20px;
	cellspacing:10px;
	padding:20px;
border:1px solid black;	
}
table
{
	width:100%;
}

</style>

<script>



</script>
</head>
<body>
<?php

require_once('header.php'); 
?>

<?php
if(isset($_POST['sub2']))
{
$date1=$_POST['d1'];
$type=$_POST['s1'];	
$info=$_POST['des'];
$d_array=explode("-",$date1);

//echo $d_array[0];  //2023

$sql="insert into holidays_data(date,yyyy,mm,dd,type,description) values('$date1','$d_array[0]','$d_array[1]','$d_array[2]','$type','$info')";

if(mysqli_query($con_status,$sql))	
{	
echo "<div style='background-color:red; width:300px; margin-left:600px;'><h3>Holiday inserted</h3></div>";
//header('Location:edit_attendance.php?act=savedholiday');

}
else
	echo "not inserted -".$sql;
}


/*if(isset($_REQUEST['act']) && ($_REQUEST['act'])=='savedholiday' )
{
	echo "<div><h3>Holiday inserted</h3></div>";
}*/

echo"<div class='container-fluid'>
<div class='row' style='margin-top:100px'>";
echo"<div class='col-md-2'>";

require_once('leftpane.php'); 

echo "</div><div class='col-md-1'></div><div class='col-md-9'>

<form action='edit_attendance.php' method='post'>
<div class='row'>
<div class='col-md-3'></div><div class='col-md-8' >
<h3>HOLIDAY UPDATION-</h3>
</div></div>

<table id='t1' style='margin-top:50px'>
<tr><td><b>Select day to choose as a Holiday</b></td>  <td><input type='date' name='d1' class='form-control'></td></tr>
<tr><td><b>Type of holiday</b></td>
<td>
<SELECT name='s1' class='form-control'>
<OPTION>select holidays type-</OPTION>
<option value='GH'>Public Holiday</optionn>
<option value='RH'>Restricted Holiday</optionn>
<option value='SH'>School Holiday</optionn>

</SELECT></td></tr>
<tr><td><b>Description</b></td>  <td><input type='text' name='des' class='form-control' ></td></tr>
<tr><td></td><td><center><input type='submit' name='sub2' value='submit' class='btn btn-info'>
<input type='reset' value='reset'  class='btn btn-info'></center></td></tr></table>	  
</form>";
echo"<div class='row' style='margin-top:100px'>
<div class='col-md-12'>";
$sql="select * from Holidays_data";
$res=mysqli_query($con_status,$sql);
$num_col=mysqli_num_fields($res);
$num_rows=mysqli_num_rows($res);


echo"<table class='table table-bordered table-hover'>";
	echo "<thead><tr>";
	for($i=0;$i<$num_col;$i++)
{
$h_data=mysqli_fetch_field($res);
$h_name=$h_data->name;
echo"<th>$h_name</th>";
}	
echo "</tr>
</thead>
<tbody>";
while($data=mysqli_fetch_array($res))
{
	echo "<tr>";
for($i=0;$i<$num_col;$i++)
{
	echo "<td> $data[$i]</td>";
}
echo "</tr></tbody>";
}

echo"</table>
</div><div></div></div></div>";
?>
<?php
require_once('footer.php'); 
?>
</body>
</html>