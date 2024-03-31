<?php 
require_once('connection.php');
?>

<html>
<head>
<?php
include_once("link.php");
?>



<?php
include_once("header.php");
?>

<?php
 echo "
 <div class='container-fluid' style='margin-top:50px; min-height:700px;'>

<div class='row'>
<div class='col-md-3'>";
include_once("leftpane.php");

echo"</div>
<div class='col-md-9'>";
if(isset($_POST['submit1']))
{
	$rollno_list=$_POST['rollno'];
	$count1=$_POST['stu_count'];
	$class=$_POST['class'];
	$status=array();
	for($i=0;$i<$count1;$i++)
	{
		$temp="s_att".$i;
		//echo "$temp";
		//echo "<br/>";
		$status[$i]=$_POST[$temp];
	}
		//print_r($rollno_list);
		//echo "<br/>class=$class<br/>";
	//print_r($status);
	$sub="english";
	$cday=Date("d");
	$dname="d".$cday;
	$mname=Date("M");
	//echo $mname;
	
	
	//$row_data="";
	$att_status=array();
	for($i=0;$i<$count1;$i++)
	{
		/*$row_data .="('".$class."',".$rollno_list[$i].",".$status[$i].")";
		if($i<$count1-1)
		$row_data .=",";*/
	
	
	
	$sql="select * from class_att where Class='$class' and subject='$sub' and month='$mname' and Rollno=".$rollno_list[$i] ." and $dname in(1,-1)";
	//echo $sql;
//exit;

$result=mysqli_query($con_status,$sql);
$num=mysqli_num_rows($result);
//echo $num;
if($num==0)
{

	$sql1="select * from class_att where Class='$class' and subject='$sub' and month='$mname' and Rollno=".$rollno_list[$i] ;






	$result1=mysqli_query($con_status,$sql1);
	$num1=mysqli_num_rows($result1);






	
	if($num1==0)
	{
		
		$sql="select dd,type,id from holidays_data where mm='".date('m')."'";
//echo $sql;
//exit;
		$ss=mysqli_query($con_status,$sql);
		$ss_num=mysqli_num_rows($ss);
			$temp_c="";
		$temp_v="";
		
		if($ss_num>0)
		{
			$temp_c=",";
		$temp_v=",";
		
			$r1=0;
			while($r=mysqli_fetch_array($ss))
			{
				$temp_c .="d".$r[0];
				
				$temp_v .=$r[2];
				if($r1<$ss_num-1)
				{
				$temp_c .=",";
				$temp_v .=",";
				}
				$r1++;
			}
		}
		$query="insert into class_att(class,Rollno,subject,month,$dname $temp_c) values('".$class."',".$rollno_list[$i].",'".$sub."','".$mname."',".$status[$i]." $temp_v)";
	
	
	}else
	$query="update class_att set ".$dname."=".$status[$i]." where class='$class' and Rollno=".$rollno_list[$i]." and  subject='$sub' and month='$mname'";	

		
	if(mysqli_query($con_status,$query))
	$att_status[$i]=$rollno_list[$i]."= done";
	else
		$att_status[$i]=$rollno_list[$i]."=Attendance not updated,check query-".$query;
}
else{
	$att_status[$i]=$rollno_list[$i]."= already done";
	
}
	
	

	}
	//{echo "Attendance Updated";	
for($i=0;$i<count($att_status);$i++)
{
	echo $att_status[$i]."<br/>";
}
	
	//$cday=Date("d");
	//$dname="d".$cday;
	//echo "$cday<br/>";
	//$query="insert into class_att(class,Rollno,$dname) values".$row_data;
	//echo $query;
	/**/

	//echo "$count";
	
	
	//$s_att1=$_POST['s_att1'];
	//echo $s_att1;
	/*
$rollno=$_POST['sel2'];	
$status=$_POST['rad'];
$class_no=$_REQUEST['class'];
//echo "class no is-".$class_no;
//echo "roll no -".$rollno;
//echo "is-".$status;	
$sql="update class_".$class_no." set attendance='".$status."' where rollno=".$rollno." ";
//echo $sql;
$result=mysqli_query($con_status,$sql);
if($result)
	echo "Attendance Updated";
else
	echo"Attendance not updated,check query-".$sql;*/

}
else if(isset($_POST['submit']))
{
	
	$class=$_POST['s1'];
	//echo "$v1";
   $sub=$_POST['sel2'];
   $sec=$_POST['sel3'];
	$sql="select rollno,name from class_".$class."";
	$result=mysqli_query($con_status,$sql);
if($result)
{

	echo"<div class='panel panel-info fnt' >
<div class='panel-heading' class='display-3'><CENTER>CLASS ATTENDANCE </CENTER> </div>
<div class='panel-body'> 

<form action='attendance.php?class=$class' method='post'>
";
	echo "
	<div class='row'>
	<div class='col-md-offset-1'><b>Class $class student list-</b></div></div>
<br/>
	
	
	<div class='row'>
	
	<div class='col-md-12'>
	
	";
	
	$sno=0;
	while($data=mysqli_fetch_array($result))
	{
		$temp="s_att".$sno;
		
		echo "<div class='row'><div class='col-md-6'>
	 <input type='hidden' class='inp'  name='rollno[]' value=$data[0] />$data[0]
	 $data[1] 
	 </div>
	 
	 <div class='col-md-6'>
	 <input type='radio' class='inp'  name='$temp' id='rad1' value=1>Present
	 <input type='radio' name='$temp' id='rad2' class='inp' value=-1 CHECKED >Absent
	 <input type='radio' name='$temp' id='rad3' class='inp' value='7'> Leave
	 </div>
	 </div><br/>";

	$sno++;
	}

	echo "<input type='hidden' name='class' value='$class' 	/>";
	echo "<input type='hidden' name='stu_count' value=$sno 	/>";
	
     echo "</div>";
	 
	 echo "
	 <div class='col-md-2'>
	 <input type='submit' value='ok' name='submit1' class='form-control btn-info style='font-size:18px; padding:5px;'></div>";
	
	echo "</div>
	</form>
	</div></div>";
}
else
{
	echo "No data found for this class";
	}
echo "</div></div></div>";
}
else
{

echo "


<div class='panel panel-info fnt' >
<div class='panel-heading'><CENTER>CLASS ATTENDANCE </CENTER> </div>
<div class='panel-body' > 


<div class='row'>
<div class='col-md-5' style='font-size:18px;'>Enter your Class</div>
<div class='col-md-5' style='font-size:18px;'>
<form action='attendance.php' method='post'>
<select name='sel1' id='sel1'  class='form-control' style='font-size:16px;'  onchange='this.form.submit()'>
<option>Select class-</option>";
$sql="select distinct class from class_info";
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
		 </form>";


echo "</div>
<div class='col-md-2'></div>
</div>


<!--section-->
<div class='row'>
<div class='col-md-5' style='font-size:18px;'>
Enter Section
</div>
<div class='col-md-5'>

<form action='attendance.php'  method='post'>";
		   if(isset($_POST['sel1']))
		   {
			   $sel1=$_POST['sel1'];
		   //echo "class=$c";
		   echo "<input type='hidden' name='s1' value='$sel1'/>";
		   }
		   echo"<select name='sel3' id='sel3'  class='form-control' style='font-size:16px;'>
<option>Select Section</option>";
if(isset($_POST['sel1']))  
       {
			$sel1=$_POST['sel1'];
		   echo "class=$sel1";
		   $sql="select  section from class_info where class='$sel1'";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
		   
		   while($data1=mysqli_fetch_row($result1))
               {

            echo "<option value='$data1[0]'>  $data1[0] </option>";
              }
		   }
echo"</select></div>
<div class='col-md-2'></div>
</div>



<!--subject-->
<div class='row'>
<div class='col-md-5' style='font-size:18px;'>
Enter subject
</div>
<div class='col-md-5'>
<select name='sel2' id='sel2'  class='form-control' style='font-size:16px;'>
<option>Select Subject-</option>";
if(isset($_POST['sel1']))
		   {$sel1=$_POST['sel1'];
		   //echo "class=$c";
		  $sql="select subject from class_info where class='$sel1'";
		  echo "<option>Select subject- </option>";
		 // echo "$sql";
		 // echo "$sql";
		 // echo "$sql";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
		   
		   while($data1=mysqli_fetch_row($result1))
               {

            echo "<option value='$data1[0]'>  $data1[0] </option>";
              }
		   }
		}
		  echo " </select>
		   </div>
		   <div class='col-md-2'></div>
		   </div>
		   </br></br><br/>
		   <div class='row'>
		   <div class='col-md-5'></div>
			   <div class='col-md-offset-2 col-md-2'>
				  <input type='submit' name='submit' class='form-control btn-info ' style='font-size:18px; padding:8px; '>
			   </div>

			   <div class='col-md-2'>
				   <input type='reset' name='reset' class='form-control btn-info ' style='font-size:18px; padding:8px; '>
			   </div>
		   </div>
		   </form>
		   </div>
		   </div>
		   </div>
		   </div>
		   </div>
		   </div>
		   </div>";

		   ?>
		   <?php include_once("footer.php");
		    ?>
		   </body>
		   </html>
		   