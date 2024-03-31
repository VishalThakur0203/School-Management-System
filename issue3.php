<?php 
session_start();
ob_start();
require_once('connection.php');
?>


<html>
<head>
<?php 
require_once('link.php');
?>
<style>
div.d1
{
		visibility:hidden;
		color:red;
		
}




#t1,th,td{
	border:1px solid black;
	padding:10px;
	}

</style>
<script>
function div_appear()
{
	
document.getElementById("d1").style.visibility = "visible";
return true;	
}

function match_otp(otp)
{ 
	var v2=otp;
	var v1=document.getElementById('txt_otp').value;
	alert(v2);
	alert(v1);
	if(!v1.match(v2))
	{
	alert('OTP Mismatch');	
	return false;
	}
	else
			return true;
}




</script>

</head>





<body>
 <?php
require_once('header.php');
$data_status="";

echo "<div class='container-fluid'><div class='row' style='margin-top:100px;'>
<div class='col-md-3'>";
require_once('leftpane.php');
echo "</div>
<div class='col-md-9'><!--*-->";

echo "
<center><h3> Issue Stock page</h3></center>";
if(isset($_REQUEST['a']))
{
	$d=$_REQUEST['a'];
//echo "issued";	
echo  "Successfully Issued,Return date is ".$d;
}

elseif(isset($_POST['sub2']))
	{ echo "sub2<br/>";
		$userid=$_POST['uid'];
	$chk_list_arr=$_SESSION['chk_list_arr'];	
		echo "ID is-$userid";
		print_r($chk_list_arr);
		$issue_date=DATE('20y-m-d');
	$return_date=Date('20y-m-d', strtotime('+15 days'));
		
		
		$len=count($chk_list_arr);
		echo "LENGTH IS-".$len;
		for($i=0;$i<$len;$i++)
		{
			
			
		$sql4="update  product_info set member_id=$userid,status=1,issue_date='$issue_date' ,
		return_date='$return_date' WHERE serial_no='$chk_list_arr[$i]'";
//echo "<br/> $sql4";	
$res4=mysqli_query($con_status,$sql4);
if($res4)
{
	
	echo "Issued ,Return Date is-".$return_date;
	
}

else
{
echo "Query Error,Check Query-".$sql4;	
}

		header("Location:issue3.php?a=$return_date");

		}

	}
else if(isset($_POST['roll'])  )   //||isset($_REQUEST['act']==10)
	{
		$id=$_POST['roll'];
	$sql3="select name,email,phno from std_reg where id=$id";
	//echo $sql3;
	$res3=mysqli_query($con_status,$sql3);
	$row_count=mysqli_num_rows($res3);
	
	if($row_count>0)
	{ 

$data=mysqli_fetch_row($res3);	

echo "<td> Entered ID-<b>$id</b> </td> <td>Email-<b>$data[1]</b><br/></td>
<td> Name-<b>$data[0]</b>, Mobile-<b>$data[2]</b></td>"	;
	

echo"</tr>";
	$NEW_OTP=rand(1000,9999);
	echo "<br><b>OTP is-</b>".$NEW_OTP;
	echo "<tr><td colspan='3' align='center'>  <br/>Enter OTP sent to <b>$data[2]</b>:
	<form action='issue3.php' method='post' onsubmit='return match_otp($NEW_OTP)'>
	
	
	<input type='hidden' name='uid' value='$id'>
	<input type='text' name='txt_otp' id='txt_otp'>
	<input type='submit' value='Submit OTP and Issue' name='sub2' class='btn btn-info'></form></td></tr>";
	}
	else
	echo"<tr><td colspan='3'><h4>Id not found;Enter valid Id<a href='issue3.php?newact=10'>Click to enter ID</a></h4></td></tr>";	
	
	
	}
else if(isset($_POST['sub1'])||isset($_REQUEST['newact']))
	{
		echo "sub1";
echo "<table><tr><td colspan='3'><center>
Enter ID to issue selected:</center></td></tr></form>
	";
	if(isset($_POST['sub1']))
	{
	$chk_list=$_POST['chk'];
$_SESSION['chk_list_arr']=$chk_list;
	}
	else{
		$chk_list=$_SESSION['chk_list_arr'];
	}
	
	
	//$chk_list=$_POST['chk'];
	//print_r($chk_list);
	echo "<tr><td colspan='3' align='center'>
	
	<form action='issue3.php' method='post'>
	<b>Enter your ID:</b>
	
	<input type='text'  name='roll' onchange='this.form.submit()'>
	
	</form></td></tr></table>";
	
	}
else if(isset($_POST['s1']))//|| isset($_SESSION['Iid']))
{
	
	$id=$_POST['s1'];
	
	echo "<a href='issue3.php'>Back</a>$id";
	//$v1=$_POST['s1'];
	//$st=$_SESSION['Iid'];

$sql2="SELECT product_info.product_name,product_info.serial_no from product_info join product_details
 on product_info.pid=product_details.pid and product_details.iid=$id where status=0";
 
$res2=mysqli_query($con_status,$sql2);
	$row_count=mysqli_num_rows($res2);
	$col_count=mysqli_num_fields($res2);
	echo "rows are-".$row_count.",columns are-".$col_count;
	if($row_count>0)
	{ echo"<table  id'='t1' width='70%'><tr>";
		
	
		
	echo "<th>Issue</th><th>Item name</th><th>Serial No.</th>";
	
	echo"</tr>";
	echo"<form action='issue3.php?v=1' method='post' onsubmit='return div_appear()'>";
	while($data=mysqli_fetch_array($res2))
	{ 
     $ch_status="";
	 $status="";
	 if(isset($_POST['chk']))
	 {
		 $chk_list=$_POST['chk'];
$_SESSION['chk_list_arr']=$chk_list;
		 $ch_status=in_array($data[1],$chk_list);
	 if($ch_status==true)
		 $status="checked";
	 
	 }
	 
		
	echo"<tr><td>
	";
	//print_r($chk_list);
	echo "<input type='checkbox' name='chk[]' $status value='$data[1]'>issue</td><td>$data[0]</td><td>$data[1]</td></tr>
	";	
		
		
	}
	echo "
	<tr><td colspan='3'><center><input type='submit'  value='Issue selected' name='sub1' class='btn btn-primary'></center></td></tr></form>
	";




	}
	else
		echo "<tr><td>no data found</td></tr>";
	
	
	echo "</table>";
}
else
{	










echo "
<div class='row'><!--row 1  starts here-->
<div class='col-md-3'><b>Select Issue type</b></div>
<div class='col-md-9'>
<form action='issue3.php' method='post'>
<select name='s1' onchange='this.form.submit()' class='form-control' style='width:320px'>
<option value='' disabled selected hidden>select stock type</option>";
$sql = "SELECT  DISTINCT iid,product_type FROM product_details";

$res=mysqli_query($con_status,$sql);
$num=mysqli_num_rows($res);
echo "rows are-".$num;
if($num>0)
{   $data_status=true;

	while($data=mysqli_fetch_array($res))
{
	
	if(isset($_POST['s1']) && $data[0]==$_POST['s1'])
 $status="selected";
 else
	 $status="";
	
echo "<option value='$data[0]' $status>$data[1]</option>";
}

}
else
{
	$data_status=false;
	echo "no data found";
}
echo"</select><form></div>
</div><!--row 1 ends here-->
";

}

?> 
	
<?php 
echo"</div></div>";
require_once('footer.php');
?>
</body>
</html>