<?php 
require_once('connection.php');
?>

<html>
<head>
<style>
	table{
		margin-left:80px;
		border:2px solid rgba(224,224,224);
		width: 600px;
		height: 350px;
        border-collapse: collapse;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}
	.form-control {
      width: 100%;
      padding-left: 80px;
      
    }
	
	</style>
</head>
<?php
include_once("link.php");
?>



<?php
include_once("header.php");
?>

<?php
 echo "
 <div class='container-fluid' style='margin-top:50px;'>

<div class='row'>
<div class='col-md-3'>";
include_once("leftpane.php");

echo"</div>";

echo"<div class='col-md-9'>";

if(isset($_POST['submit1'])) 
{
	$rollno_list=$_POST['rollno'];
    $marks=$_POST['marks'];
$class=$_POST['class'];
$sec=$_POST['sec'];
$exam_type=$_POST['exam_type'];
$temp=$_POST['sub'] ;

$temp=explode("_",$temp);

$sub_code=$temp[1];
$sub=$temp[0];

	for($i=0;$i<count($rollno_list);$i++)
	{

$num1=0;
	if($num1==0)
	{
	$query="insert into marks_upload(Class,section,subject,Roll_No,marks,Exam_type,sub_code ) values ('".$class."','".$sec."','".$sub."','".$rollno_list[$i]."','".$marks[$i]."','".$exam_type."','$sub_code')";
	
	}

	if(mysqli_query($con_status,$query))
	
	$att_status[$i]=$rollno_list[$i]."= done";

	else
		$att_status[$i]=$rollno_list[$i]."=marks not updated,check query-".$query;
	
    }
}

else if(isset($_POST['submit']))
{	
	$class=$_POST['s1'];
   $sub=$_POST['sel2']; 
   $sec=$_POST['sel3'];
   $exam_type=$_POST['exam_type'];
   $temp=explode("_",$sub);
   $sub_code=$temp[1];
   $sub_value=$temp[0];
  
 
   $sql="select * from marks_upload where Class='$class'and section='$sec' and subject='$sub_value' and sub_code='$sub_code' and Exam_type='$exam_type'";
   
$result=mysqli_query($con_status,$sql);
$num=mysqli_num_rows($result);
//echo "<br/>$sql<br/>num=".$num;
//echo"<br/>".$num;
//exit;
if($num>0)
{
	echo "<br/><h3>Already Done</h3>";

echo "<br/><a href='marks.php' class='btn btn-info'>Back</a>";
			echo"<form action='marks.php' method='post'>
			<br/><input type='submit' name='edit' value='Edit' class='btn btn-info'>
			</form>";
}//

else
{  
	$sql="SELECT id,name FROM `std_reg` where class='$class' and section='$sec' and session='2023'";
	$result=mysqli_query($con_status,$sql);
if($result)

{

	echo"<div class='panel panel-info fnt' >
<div class='panel-heading' class='display-3' style='margin-left:220px; font-weight:bold; font-size:50px;'>UPLOAD MARKS </div>
<div class='panel-body'> 

<form action='marks.php?class=$class ' method='post'>
<input type='hidden' name='sub' value='$sub'/>
<input type='hidden' name='sec' value='$sec'/>
<input type='hidden' name='exam_type' value='$exam_type'/>

";
	echo "
	<div class='row'>
    
	<div class='col-md-offset-1' style='margin-left:290px;'><b>Class $class-$sec student list</b></div></div>
<br/>
	
	
	<div class='row'>
	
	<div class='col-md-12' style='margin-left:50px;'>
	
	";
    
	
	$sno=0;
	while($data=mysqli_fetch_array($result))
	{
		$temp="marks".$sno;
		
		echo "<div class='row'><div class='col-md-4'>
	 <input type='hidden' class='inp'  name='rollno[]' value=$data[0]/>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 
	 $data[0]
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     $data[1] 
	 </div>
	 
	 <div class='col-md-3'>
	 <select name='marks[]'>
	 <option value='-1'>Pending</option>

	 ";
     for($i=0;$i<101;$i++)
	 echo" <option value='$i'>$i</option>";
	 echo"
	 </select>
	 </div>
	 </div><br/>";

	$sno++;
	}

	echo "<input type='hidden' name='class' value='$class'/>";
	echo "<input type='hidden' name='stu_count' value=$sno/>";
	
     echo "</div>";
	 
	 echo "
	 <div class='col-md-2' style='margin-left:250px;'>
	 <input type='submit' value='ok' name='submit1' class='form-control btn-info style='font-size:18px; padding:5px;'></div></center>";
	
	echo "</div>
	</form>
	</div></div>";
}
	
}	
echo "</div></div></div>";
}

// ELSE PART FOR FIRST FORM
else
{
echo "
<h2 style='text-align:center;'><b>MARKS UPLOADING</b></h2> <br/>
<table>
<tr><td>

 ";
if(isset($_REQUEST['case']))
 {
    $id=$_REQUEST['case'];
    echo "saved";
 }
echo"

<tr><th>
<h5>Select Class</h5>
</th>
<td>
<form action='marks.php' method='post'>
<select name='sel1' id='sel1'  class='form-control' style='text-align:center; width:400px;'   onchange='this.form.submit()'>
<option>Select class-</option>";

$sql="SELECT DISTINCT(class) FROM `std_reg` where session='2023'";
$result=mysqli_query($con_status,$sql);
$num=mysqli_num_rows($result);
$status="";
while($data=mysqli_fetch_row($result))
{
if(isset($_POST['sel1']) && $data[0]==$_POST['sel1'])
{
$status="selected";
	 
}
else
$status="";			   
				   
				   
echo "<option value='$data[0]' $status>  $data[0] </option>";
}
echo"</select>
</form>
</td></tr>
";


echo"
<!--section-->
<tr>
<th>
<h5>Select Section</h5>
</th>
<td>
<form action='marks.php'  method='post'>";
if(isset($_POST['sel1']))
{
$sel1=$_POST['sel1'];
		   
echo "<input type='hidden' name='s1' value='$sel1'/>";
}
echo"<select name='sel3' id='sel3'  class='form-control' style=' text-align:center;width:400px;'  >
<option>Select Section-</option>";
if(isset($_POST['sel1']))
{$sel1=$_POST['sel1'];
echo "class=$sel1";
		   
$sql="SELECT distinct(section) FROM `std_reg` where session='2023' and class='$sel1'";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
		   
while($data1=mysqli_fetch_row($result1))
{

echo "<option value='$data1[0]'>  $data1[0] </option>";
}
}
echo"</select>
</td></tr>

<!--subject-->
<tr><th>
<h5>Select subject</h5> 
</th>
<td>
<select name='sel2' id='sel2' class='form-control'style=' text-align:center;width:400px;' >
<option>Select Subject-</option>";
if(isset($_POST['sel1'])){
{$sel1=$_POST['sel1'];
		   
$sql="SELECT * FROM `std_syllabus` where class='$sel1'";
		  
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
		   
while($data1=mysqli_fetch_row($result1))
{
$temp=$data1[2]."_".$data1[3];
echo "<option value='$temp'>  $data1[2] ($data1[3])</option>";
}
		   
}
}
echo "</select>
</td></tr>

<tr><th><br/>
<h5>Select Exam type</h5> 
</th>
<td><br/>
<select name='exam_type' id='exam_type'  class='form-control' style='text-align:center; width:400px;' >
<option>Select Exam Type-</option>";
                    
$sql="select * from exam_type";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
                      
while($data1=mysqli_fetch_row($result1))
{
           
echo "<option value='$data1[1]'>  $data1[1] </option>";
}
echo "</select>
   </td><tr>          


<tr>
 <td>
<br/><input type='submit' name='submit' class='btn btn-info' style='margin-left:20px;'>
<a href='marks_view.php' class='btn btn-info'>View</a>

</tr>


";
}
echo" </form>
<td></tr></table>
</div>
</div>
</div>
</div>";
?>
<?php include_once("footer.php"); ?>
		   
</body>
</html>
<?php
/*
if(isset($_POST['edit'])){
	$class=$_POST['s1'];
   $sub=$_POST['sel2']; 
   $sec=$_POST['sel3'];
   $exam_type=$_POST['exam_type'];
   $temp=explode("_",$sub);
   $sub_code=$temp[1];
   $sub_value=$temp[0];
  
	$sql="SELECT id,name FROM `std_reg` where class='$class' and section='$sec' and session='2023'";
	$result=mysqli_query($con_status,$sql);
if($result)

{
	echo"<form action='marks.php?class=$class ' method='post'>
	<input type='hidden' name='sub' value='$sub'/>
	<input type='hidden' name='sec' value='$sec'/>
	<input type='hidden' name='exam_type' value='$exam_type'/>";
	$sno=0;
	while($data=mysqli_fetch_array($result))
	{
		$temp="marks".$sno;	
		echo"<input type='hidden' class='inp'  name='rollno[]' value=$data[0]/>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 
	 $data[0]
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     $data[1] 
	 <select name='marks[]'>
	 <option value='-1'>Pending</option>

	 ";
     for($i=0;$i<101;$i++)
	 echo" <option value='$i'>$i</option>";
	 echo"
	 </select>";
	 $sno++;
}
echo "<input type='hidden' name='class' value='$class'/>";
	echo "<input type='hidden' name='stu_count' value=$sno/>";
	echo"<input type='submit' name='update' value='Update'>";
}

}
*/
?>		   