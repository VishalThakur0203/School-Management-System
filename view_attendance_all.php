
<?php 
require_once('connection.php');
?>
<html>
<head>
<?php 
require_once('link.php');
?>




</head>
<body>
<?php 

require_once('header.php');
?>
<?php
echo "<div class='container-fluid'>
<div class='row' style='margin-top:50px;'>
<div class='col-md-2'>";

require_once('leftpane.php');



echo "</div>

<div class='col-md-10'><div class='t1'>";
?>

<?php


$class_name='8th';
$sub='English';
$mon='Dec';
echo"<h3><center>Class $class_name attendance of $sub subject in $mon month-</center></h3>";

	$query ="select * from class_att where class='$class_name' and subject='$sub' and month='$mon'";
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
		echo"<div class='table-responsive'>";
		echo "<table class='table table-bordered table-hover'  id='example'><tr><thead>";
	for($i=0;$i<$col_count;$i++)
	 {
		
	 $heading_data=mysqli_fetch_field($result);
	   $heading_name= $heading_data->name;
	if($i!=0 && $i!=2&& $i!=3 && $i!=4  && $i<5)	
	echo "<th>$heading_name</th>";
	
	
	if($i>4)
	{$j=$i-4;
		$d="day".$j;
		echo "<th>$d</th>";
	}
		
		
		
	 }
	    echo "<th> Presents</th><th>Absents</th>";
	
	echo"</tr></thead>";
	echo "<tbody>";
	$p=0;
	$a=0;
	$total_p=array();
	$total_a=array();
	$r=0;
	while($data=mysqli_fetch_array($result)) //for printing rows one my one
	{ $total_p[$r]=0;
	$total_a[$r]=0;
		echo "<tr>";
		for($i=0;$i<$col_count;$i++)    //for printing columns            
		{
			if($i!=0 && $i!=2&& $i!=3 && $i!=4)	
			echo "<td>$data[$i]</td>";		
	

if($i>4)
{
			if($data[$i]==1)
			$total_p[$r] =$total_p[$r]+1;
			if($data[$i]==-1)
			$total_a[$r]=$total_a[$r]+1;
		
}		
		}
	   echo "<td> ".$total_p[$r]."</td><td>".$total_a[$r]."</td>";
	
		
 
	echo"<tr/>";
	$r++;
	//}	
	} 
	echo "</tbody>";
	echo "</table></div></div></div>";
	
	
	
	}
	
	
	
	
		
	
	
	
	else
	{
		echo "no rows found";
		}
	}
else 
	echo $query;





$sql1="select rollno, d01,d01,d03,d04,d05,d06,d07,d08,d09,d10,d11,d12,d13,
d14,d15,d16,d17,d18,d19,d20,d21,d22,d23,d24,d25,d26,d27,d28,d29,d30,d31 from class_att ";
$p=0;
$a=0;
$result1=mysqli_query($con_status,$sql1);
	if($result1)
	{
	
	$row_count1=mysqli_num_rows($result1);
	$col_count1=mysqli_num_fields($result1);
	
	
		while($data=mysqli_fetch_array($result1))
		{ 
	
		for($i=1;$i<$col_count1;$i++)
		{
			//echo "$data[$i]";
		//echo "<br/>";
		
		if($data[$i]==1)
	   $p++;
    
	if($data[$i]==(-1))
	   $a++;
   
 //  echo"Total working days are-".($p+$a);

		}
		
		
		
		
		
		}
		
//echo "hello";
/*for($i=0;$i<$len;$i++)
{
//echo "<br/>".$data[$i];
}
*/




/*
$p=0;
$a=0;
for($i=0;$i<$len;$i++)
{
	if($data[$i]==1)
	$p++;
   if($data[$i]==(-1))
	   $a++;
}
echo "<div  class='row'><div class='col-md-offset-4 col-md-7'><br/>Total working days are-".($p+$a);
echo "&nbsp;&nbsp; Number of present are-".$p;
echo "&nbsp;&nbsp; Number of absent are-".$a;
echo "<a href='view_attendance.php'class='btn btn-info'>back</a></div></div>";*/



}
else
echo "Error,check query".$sql;







echo"
</div></div></div>";
?>

<?php 
require_once('footer.php');
?>

</body>
</html>