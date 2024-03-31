
<?php 
require_once('connection.php');
?>
<html>
<head>
<?php 
require_once('link.php');
?>
<style>

#example
{
	 
	border:1px solid black;
	}
	height:600px;
	#example tr:nth-child(even){background-color:red;}

#example tr:hover {background-color: #ddd;}

th,td
{
border: 1px solid #ddd;
	
}
.t1
{
	height:400px;
}
.d1
{
	//background-color:red;
margin-left:200px;
//text-align:center;
//border:1px solid black;
//width:0%;
padding-top:10px;}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" type="text/css"/>



</head>
<body>
<?php 
require_once('header.php');
?>
<?php
echo "<div class='container-fluid'><div class='row'>
<div class='col-md-0'>";



echo "</div>

<div class='col-md-12'><div class='t1' style='margin-top:100px;'>";
?>

<?php
if(isset($_REQUEST['sub'])&&isset($_REQUEST['class']))
{
$class_name=$_REQUEST['class'];
$sub=$_REQUEST['sub'];



//$sec=$_REQUEST['s2'];
$sec='E';
$mon='Dec';
//echo $sub;
//echo $class_name;
//exit;
echo"<h3><center>Class $class_name($sec) attendance of $sub subject in $mon month-</center></h3>";

	$query ="select class_".$class_name."."."name,class_att."."d01,class_att."."d02,class_att."."d03,class_att."."d04,class_att."."d05,
class_att."."d06,class_att."."d07,class_att."."d08,class_att."."d09,class_att."."d10,
class_att."."d11,class_att."."d12,class_att."."d13,class_att."."d14,class_att."."d15,
class_att."."d16,class_att."."d17,class_att."."d18,class_att."."d19,class_att."."d20,
class_att."."d21,class_att."."d22,class_att."."d23,class_att."."d24,class_att."."d25,
class_att."."d26,class_att."."d27,class_att."."d28,class_att."."d29,class_att."."d30,class_att."."d31 
	from class_att inner join 
	class_$class_name on class_att.rollno=class_$class_name."."rollno  
	where class='$class_name' and subject='$sub' and month='$mon'";
	//echo $query;
	echo "<br/>";
//$query ="select * from empinfo";
$result=mysqli_query($con_status,$query);

if($result)
{
	//echo "data fectched";
	$row_count=mysqli_num_rows($result);
	$col_count=mysqli_num_fields($result);
	
	if($row_count>0)
	{
		echo "<table class='table' id='exam'><thead><tr>";
	for($i=0;$i<$col_count;$i++)
	 {
		
	 $heading_data=mysqli_fetch_field($result);
	   $heading_name= $heading_data->name;
	if($i<1)
	echo "<th>$heading_name</th>";
	
	
	if($i>0)
	{$j=$i;
		$d="day".$j;
		echo "<th>$d</th>";
	}
		
		
		
	 }
	echo"</tr></thead>";
	
	echo "<tbody>";
	while($data=mysqli_fetch_array($result)) //for printing rows one my one
	{ 
		echo "<tr>";
		for($i=0;$i<$col_count;$i++)            
		{
	echo "<td>$data[$i]</td>";		
		
		}	
 
	echo"<tr/>";
	//}	
	} 
	echo "</tbody>";
	echo "</table></div></div>";
	
	
	
	}
	else
	    {
		echo "no rows found";
		}
		
		
	}
else 
	echo $query;
}







echo"
</div></div>";
?>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
new DataTable('#exam');
</script>





<?php 
require_once('footer.php');
?>

</body>
</html>