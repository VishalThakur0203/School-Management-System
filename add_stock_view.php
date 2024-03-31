<?php
require_once("connection.php");
?>
<html>
<head>
<?php
include_once("link.php");
?>
</head>
<body>
<?php
include_once("header.php");
echo"<br/><br/>";

echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>";
?>
<div class='container'>
<div class='row'>
<div class='col-md-1'></div>
<div class='col-md-10'>
<?php
if(isset($_POST['update']))
		 {
			 //echo "update case ";
			 $iid=$_POST['iid'];
			 $bill_no=$_POST['b_no'];
			 $b_date=$_POST['b_date'];
			 $_date=$_POST['_date'];
			 $item=$_POST['item'];
		$sql="update inventory_tb set bill_no='$bill_no',bill_date='$b_date',entry_date='$_date',total_items='$item' where iid='$iid'";
			if(mysqli_query($con_status,$sql))
				echo "updated";
			else
				echo "query error";

		 }
		 

//$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		

$query="select * from inventory_tb ";
$query_result=mysqli_query($con_status,$query);
if($query_result)
{
	$row_count=mysqli_num_rows($query_result);
	$col_count=mysqli_num_fields($query_result);
	
	if($row_count>0)
	{ 
	echo"<table class='table'>";
	echo"<tr>";
	echo "<th>Update</th>";
		for($i=0;$i<$col_count-1;$i++)
		{
			$temp=mysqli_fetch_field($query_result);
			$col_name=$temp->name;
			echo "<th>$col_name</th>";
        }
		echo"</tr>";
		while($row_data=mysqli_fetch_array($query_result))
		{
			if(isset($_REQUEST['act'])  && $_REQUEST['act']==1 && $_REQUEST['iid']==$row_data[0])
					{
	echo "<form action='add_stock_view.php?pageno=$pageno' method='post'>";
					echo "<tr><td>
					<input type='submit'  name='update' value='update' class=''/>
					<a href='add_stock_view.php?pageno=$pageno' class=''>cancel</a></td>
					<td>$row_data[0]<input type='hidden' name='iid' value='$row_data[0]'/></td>";
						echo "<td><input type='text' name='b_no' class='form-control' value='".$row_data[1]."'/></td>";
					echo "<td><input type='text' name='b_date' class='form-control' value='".$row_data[2]."' /></td>";
					echo "<td><input type='text' name='_date' class='form-control' value='".$row_data[3]."' /></td>";
					echo "<td><input type='text' name='item' class='form-control' value='".$row_data[4]."' /></td>";
					echo "</tr>";
					echo "</form>";
					}
			else
			{
		echo"<tr>";
		echo "<td> 
	<a href='add_stock_view.php?iid=$row_data[0]&act=1'>Edit</a>
    </td>";
		for($i=0;$i<$col_count-1;$i++)
				echo"<td>".$row_data[$i]."</td>";
			echo"</tr>";
			}
		}
	    echo"</table>";	

}

}

else

{

echo "query error";

}

?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
echo"<br/>";
include_once("footer.php");
?>
</body>
</html>