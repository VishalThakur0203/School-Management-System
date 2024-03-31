<html>
<head> 
<?php
include_once("link.php");
?> 
<?php 
require_once('connection.php');
?>
<style>
.r1
{
margin-top:15px;
font-size:16px;
}
.d1
{
	boder:1px solid black;
	
	}

</style>

</head>
<body>
<?php
include_once("header.php");
?>
<?php
echo "<div class='container-fluid' >
<div class='row' style='margin-top:50px;'>";
echo" <div class='col-md-2'>";
include_once('leftpane.php');
echo "</div>";


echo "<div class='col-md-10'>";

if(isset($_POST['sub']))
{
	$rollno=$_POST['roll'];
	$class=$_POST['s1'];
	$sub=$_POST['s2'];
	$mon=$_POST['s3'];
	//echo $rollno;
	//echo $class;
	//echo $sub;
	//echo $mon;
	
	$sql="select d01,d02,d03,d04,d05,d06,d07,d08,d09,d10,
	             d11,d12 ,d13,d14,d15,d16,d17,d18,d19,d20,
				 d21,d22,d23,d24,d25,d26,d27,d28,d29,d30,d31
				 from class_att where rollno='$rollno' and class='$class' and month='$mon' and subject='$sub'";
	//echo $sql;
	$result=mysqli_query($con_status,$sql);
	if($result)
	{
		$row_count=mysqli_num_rows($result);
	$col_count=mysqli_num_fields($result);
	if($row_count>0)
	{
	echo "<div class='row' style='font-size:18px;' ><div class='col-md-offset-4 col-md-4'>";
$data=mysqli_fetch_row($result);
$len=count($data);
//echo "Number of records are-".$len;
//print_r($data);
/*for($i=0;$i<$len;$i++)
{
echo "<br/>".$data[$i];
}*/
$p=0;
$a=0;
for($i=0;$i<$len;$i++)
{
	if($data[$i]==1)
	$p++;
   if($data[$i]==(-1))
	  $a++;
}
echo "<br/><b>Total working days are</b>-".($p+$a);
echo "<br/><b>Number of present are</b>-".$p;
echo "<br/><b>Number of absent are</b>-".$a;


	/*echo "<table class='table'><tr>";
	for($i=0;$i<$col_count;$i++)
	 {
		 echo "<th>";
	 $heading_data=mysqli_fetch_field($result);
	   $heading_name= $heading_data->name;
	 echo $heading_name;
	 echo "</th>";
	 }
	echo"</tr>";
	
	
	while($data=mysqli_fetch_array($result)) //for printing rows one my one
	{ 
echo "<tr>";
    for($i=0;$i<$col_count;$i++)    //for printing columns            
	{
	echo "<td>";	
	echo $data[$i];   
    echo "</td>";		
	}					    
	echo"<tr/>";
	} 
	echo "</table>";*/
	echo "</div>";	
	}
	else
	{
		echo "no rows found";
		}
	}
	
	else
	{
		//echo "No such data found";
		echo "query error-".$sql;
	}

}
else
{
	
?>

<?php 
$sid="";
if(isset($_POST['roll']))
{
	$sid=$_POST['roll'];
}
echo "
<!--div class='panel panel-info'>
<div class='panel-heading'>Check your attendance details</div>

<div class='panel-body'-->
<div class='d1'style=''>

<div class='row'><center><h2>Student attendance record-</h2></center></div></div><br/><br/>
<!--row1-->
<div class='row r1'>
<div class='col-md-offset-1 col-md-4'>
<label>Enter your Rollno</label>
</div>
<div class='col-md-4'>
<form action='view_attendance1.php' method='post'>
<input type='text' name='roll' class='form-control' placeholder='Enter your Rollno'   value='$sid'onchange='this.form.submit()'>
</form>";

$class="";
if(isset($_POST['roll']))
{
	$sid=$_POST['roll'];
	//echo $sid;
$sql=" select  class from std_reg where id=$sid";
$result=mysqli_query($con_status,$sql);

while($data=mysqli_fetch_row($result))
               {
        $class=$data[0];
			   }
}

 
echo"
</div>
</div>

<form action='view_attendance1.php' method='post'>
<!--row2-->
<div class='row r1'>
<div class='col-md-offset-1 col-md-4'><label>Enter your Class</label></div>
<div class='col-md-6'>
<input type='hidden'  name='roll' value='$sid' >


<input type='hidden'  name='s1' value='$class' >$class



</div>
</div>

<!--row3-->


<div class='row r1'>
<div class='col-md-offset-1 col-md-4'><label>Choose Subject</label></div>
<div class='col-md-6'>";

$sql1="select subject from std_syllabus where class='$class'";

echo "<select  name='s2'  class='form-control'>
<option>choose subject-</option>";

$result1=mysqli_query($con_status,$sql1);

while($data=mysqli_fetch_row($result1))
               {
        echo "<option value='$data[0]'>  $data[0] </option>";
			   }



echo"</select >

</div>
</div>

<!--row4-->
<div class='row r1'>
<div class='col-md-offset-1 col-md-4'><label>Choose Month</label></div>
<div class='col-md-6'>
<select  name='s3'  class='form-control'>
<option>Select month-</option>
<option value='jun'>June</option>
<option value='jul'>July</option>
<option value='aug'>August</option>
<option value='sep'>September</option>
<option value='oct'>October</option>
<option value='nov'>November</option>
<option value='dec'>December</option>
</select >

</div>
</div>
<!--row5-->
<div class='row r1'>
<div class='col-md-4'></div>
<div class='col-md-6'>
<input type='submit' name='sub' value='Submit' class='btn btn-info'>
<input type='reset' name='reset' value='Reset' class='btn btn-info' ></div>

</div>




</form></div><!--/div></div-->";






}


echo "</div></div></div>";
?>

<?php
include_once("footer.php");
?>

<body>
</html>