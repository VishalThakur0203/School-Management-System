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
width:100%;
}
th,td
{font-size:20px;
	cellspacing:10px;
	padding:20px;
border:1px solid black;	
}

</style>
<!--link rel='stylesheet' type='text/css' href='css/.0.min.css'-->
<script>



</script>
</head>
<body>
<?php

require_once('header.php'); 
?>

<?php
echo"<div class='container-fluid'><div class='row' style='margin-top:70px; min-height:600px;'>
";
echo"<div class='col-md-2'>";

include_once("leftpane.php");
echo "</div>";



echo"<div class='col-md-10'>






<table id='t1' style=''>
<center><h3>Attendance data-</h3></center><br/>
<tr><td>Select class</td><td>";


echo "
<form action='atten.php' method='post'>
<select id='s1' name='c' class='form-control' onchange='this.form.submit()'>
<option>Select class</option>";
$sql="select distinct class from std_reg";
$result=mysqli_query($con_status,$sql);
$num=mysqli_num_rows($result);
$status="";
              while($data=mysqli_fetch_row($result))
               {
 if(isset($_POST['c']) && $data[0]==$_POST['c'])
 {
	 $status="selected";
	 
 }
 else
	 $status="";
	 
 
            echo "<option value='$data[0]' $status>  $data[0] </option>";
              }
         echo"</select>
		
		 </form>
		 ";
		 
		 echo "</td></tr>
           <tr><td>";
		   
		   
		   
		    if(isset($_POST['c']))
		   {
			   $c=$_POST['c'];
		 //  echo "class=$c";
		   echo "<input type='hidden' name='s1' value='$c'/>";
		   }
		   
		   echo "Select Section</td>
		   <td>";
		  
		   
		   echo "<select class='form-control' id='s2' name='s2'>
		   <option>select section-</option>";
		    if(isset($_POST['c']))
		   {
			   $c=$_POST['c'];
		   echo "class=$c";
		   
		   
		   $sql="Select DISTINCT section from std_reg WHERE class='$c'";
		 //
//		 $sql="select  section from class_info where class='$c'";
		
	
            $result1=mysqli_query($con_status,$sql);
            $num1=mysqli_num_rows($result1);
		   
		   while($data1=mysqli_fetch_row($result1))
               {

            echo "<option value='$data1[0]'>  $data1[0] </option>";
              }
		   }
		   echo"</select>";
	
		   
		   echo "</td></tr>

          <tr><td>Select Subject</td><td>";
		  
		  echo "<ul name='s3' STYLE='LIST-STYLE-TYPE:NONE;'>";
		   if(isset($_POST['c']))
		   {$c=$_POST['c'];
		   //echo "class=$c";
		  $sql="select subject from std_syllabus where class='$c'";
		  
		  echo "$sql";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
		   
		   while($data1=mysqli_fetch_row($result1))
               {

            echo "<li ><a href='view_attendance.php?sub=$data1[0]&class=$c&sec='>  $data1[0]</a>";
              }
		   
		   }
		  
		  echo"</UL>";
		  echo "
		  </td></tr>
		  <tr><td></td><td><center>
		  <!--input type='submit' name='sub2' value='submit'-->
		  <input type='reset' value='reset'></center></td></tr></table>
		  
		  ";



echo "</div></div></div>";
?>
<?php
require_once('footer.php'); 
?>

</body>
</html>


















