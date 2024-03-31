<?php 

require_once('connection.php');
?>

<html>
<head>
<?php 
require_once('link.php');
?>
<style>
#t1,th,td
{
	
	padding:20px;
}

</style>
</head>
<body>
<?php
require_once('header.php');
?>
<?php

echo "<div class='container-fluid'><div class='row' style='margin-top:100px;'>
<div class='col-md-3'>";
require_once('leftpane.php');
echo "</div>
<div class='col-md-9'>
<center><h3>Return Page</h3></center>

";
if(isset($_POST['roll']))
{
	$id=$_POST['roll'];
$sql="Select product_name,serial_no,member_type, issue_date, return_date
from product_info where member_id=$id and status=1";
// $sql;
$res=mysqli_query($con_status,$sql);
$num=mysqli_num_rows($res);
$col_count=mysqli_num_fields($res);
//echo $num;
if($num>0)
{
	echo"<form action='return.php' method='post'><table id='t1' border=1 width=80%>
	<tr><td colspan='6'><center><h4>Stock issued is -</b></h4></center></tr>
	<tr><th>Return<input type='hidden' name='uid' value='$id' ></th>";
	for($i=0;$i<$col_count;$i++)
	 {
		
	 $heading_data=mysqli_fetch_field($res);
	   $heading_name= $heading_data->name;
	   echo "<th>$heading_name</th>";
	 }
	
	echo"</tr>";	
while($data=mysqli_fetch_array($res))	
{

echo "<tr><td><input type='checkbox' name=chk[] value='$data[1]+$data[4]'>Return</td>";

	echo " <td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td>";
	echo"</tr>";
	}
echo "<tr><td colspan='6'><input type='submit' name='sub1' value='return selected' class='btn btn-info'></td></tr>";
	
	
echo"</table></form>";

}
else
	echo"<h4>No stock issued ;enter valid ID <a href='return.php'>back</a></h4>";

}




else if(isset($_POST['sub1']))
{
	$id=$_POST['uid'];
	echo "id is-".$id;
$chk_list=	$_POST['chk'];
//print_r($chk_list);

$len=count( $chk_list);
//echo $len;
for($i=0;$i<$len;$i++)
{
$v1=explode("+",$chk_list[$i]);
//print_r($v1);
$sno=$v1[0];
$return_str=$v1[1];
$c_date_str=date('d-m-Y');
//echo $c_date;
$c_date=date_create($c_date_str);
$return_date=date_create($return_str);
//echo "<br/>Serial No is-".$sno;


$dif=DATE_diff($return_date,$c_date);
$days= $dif->format("%R%a days");
//echo "<br/>days are=".$days;
$total_fine=0;
if($days>0)
{
	//15 days
	//echo "<br>".$days;
	$temp=explode(" ",$days);
	$days=substr($temp[0],1,strlen($temp[0]));
	//echo "<br/>days=".$days;
	
	$fine=50*$days;
	
	$total_fine=$total_fine+$fine;
	echo "<br/><b>fine is=</b>".$total_fine."Rupees/-";
	
}
else
{
	echo "<br/>No fine ";
	
}

$sql="update product_info set status=0, fine=$total_fine where serial_no='$sno'";
	//echo $sql;
	$res=mysqli_query($con_status,$sql);
	if($res)
	{
	echo "<br/>Returned Successfully";	
	}
else{
	
	echo "<br/>Not Returned";
}
}



}
else

{
	echo "<div class='row'>
<div class='col-md-2'><b>Enter your ID</b></div>
<div class='col-md-10'>
<form action='return.php' method='post' ><input type='text' name='roll' onchange='this.form.submit()'></form>
</div>

</div>";
	
	
}
echo"</div></div></div>";?>
<?php
require_once('footer.php');
?>
</body>
</html>