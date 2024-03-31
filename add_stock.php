<?php
require_once("connection.php");
?>

<html>
<head>
<?php
include_once("link.php");
require_once("mylinkfile.php");
?>

<script>
$(document).ready(function()
{
$('#loginform').validate(

{ rules:
    { 	Bill date:
        { required:true,
		
        }
        ,
        title:
        { required:true,
            minlength:6
        },
		assign_file1:
        { required:true,
    
        },
		dte:
        { required:true,
            
        },
	
      }
    }
  );
}
);
</script>
</head>
<body>
<?php
include_once("header.php");

echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>";
echo"<br/><br/>";
//$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(isset($_POST['product_detail']))
{
	$inventory_id=$_POST['iid'];
	
		

	$query1="insert into product_details (iid,product_type,model_no,quantity) values";
	for($i=0;$i<count($_POST['txt1']);$i++)
	{
		$product_type=$_POST['txt1'][$i];
		$model_no=$_POST['txt2'][$i];
		$quantity=$_POST['txt3'][$i];
		
		$query1.="('$inventory_id','$product_type','$model_no','$quantity')";
		if($i<count($_POST['txt1'])-1)
		{
			$query1.=",";
		}
	}
	$result=mysqli_query($con_status,$query1);
	if($result)
	{
		$pid=mysqli_insert_id($con_status);
		echo"$pid";
		echo"success";
$sql="select pid from product_details where iid=".$inventory_id;

$result=mysqli_query($con_status,$sql);
while($rinfo=mysqli_fetch_array($result))
{
	echo $rinfo[0]."<br/>";
}


/*		if(isset($_POST['product_detail']))
		{
			$text1=$_POST['txt1'];
			$quantity=$_POST['txt3'];
			//$quan=$_POST['txt3'][1];
			print_r($quantity);
			print_r($text1);
			//$num=$quantity+$quan;
			//echo"<br/>$num";
			
		
			echo"<table><tr><th>product type</th><th>product name</th><th>quantity</th></tr>";
			for($i=0;$i<count($text1);$i++)
			{
				
				for($j=0,$sn=1;$j<$quantity[$i];$j++,$sn++)
				{
				echo"<tr><td>$sn ".$text1[$i]."</td>
				<td> <input type='text' name='txt1[]'/></td>
				<td><input type='text' name='txt2[]'/></td>
				</tr>";
				}
			}
			
			
			echo"
			</table>";
			
		}
*/

	}
	else
		echo"product_details error";
}


else if(isset($_POST['add_stock']))
{
	//echo"connected";
	//$bill_no=$_POST['b_no'];
	$bill_dte=$_POST['b_date'];
	$entry_dte=$_POST['e_date'];
	//$p_type=$_POST['p_type'];
	$no_items=$_POST['no_item'];
	$bill_amt=$_POST['b_amount'];
	$bill_no=$_FILES['b_no'];
	
	$path1=$_FILES['b_no']['tmp_name'];
	$temp=explode(".",$bill_no['name']);
	$count=count($temp);
	
	$sql="insert into inventory_tb(bill_date,entry_date,total_items,cost)values('$bill_dte','$entry_dte','$no_items','$bill_amt')";
    //echo"$bill_no<br/>";
	//echo"$sql";
	
	if(mysqli_query($con_status,$sql))
	{
		$id=mysqli_insert_id($con_status);
		//echo "$id";
		$path2="bills/$id.".$temp[$count-1];
		//echo $path2;
		if(move_uploaded_file($path1,$path2))
		{

		$sql="update inventory_tb set bill_no='$path2' where iid=$id";
		if(mysqli_query($con_status,$sql))
			echo"success and id is $id";
		//header("Location:add_stock.php?success & case=$id");
		else
		echo "update query error";	
		}
		else
			echo "error ";

	}
		
	else
	{
		echo"query error:$sql";
	}
   
}


echo"

<div class='container-fluid' style='margin-top:'>";
/*
if (isset($_POST['product_info'])) {
    // Assuming you have a database connection established

    // Retrieve the entered values from the form
    $pid = $_REQUEST['r1'];
    $p_type = $_REQUEST['p_type'];
    $p_size = $_REQUEST['p_name'];
	//$_a =$_REQUEST['txt1'];
    
    $updateQuery = "UPDATE product_info SET copy = '2' WHERE id = 409";
    
    // Prepare the statement
    $stmt = mysqli_prepare($con_status, $updateQuery);

    // Bind the parameters
    //mysqli_stmt_bind_param($stmt, 'ii', $sno, $pid);

    // Execute the update query
    $result = mysqli_stmt_execute($stmt);

}
*/
// Rest of your HTML/PHP code

if(isset($_POST['product_info'])) 
{
    $pid = $_REQUEST['r1'];
    $p_type = $_REQUEST['p_type'];
    $p_size = $_REQUEST['p_name'];
	//$_a =$_REQUEST['txt1'];
    echo "<div class='row'>
        <div class='col-md-6'><b></b></div>
        <div class='col-md-6'>

		<form action='data.php' method='POST' id='addStockForm'> new product_info ";
       
   print_r($pid);
    echo "<br/>p_type=";
    print_r($p_type);
    echo "<br/>";
    print_r($p_size);
$s_no=0;
    for ($pno = 0; $pno < count($p_type); $pno++)
	 {
        echo "<h3>$p_type[$pno]</h3>";
      echo "";
 
        echo "<table>";
        $size = $p_size[$pno];
        
        for ($i = 0, $j = 1; $i < $size; $i++, $j++)
		 {
			$s_no++;
            echo "<tr><td>$j</td><td><input type='hidden' name='p_type[]' value='$p_type[$pno]'></td><td><input type='text'  name='sno[]' value='$s_no' /></td></tr>";
        }
		echo"<input type='hidden' name='pid[]' value='$pid'>$pid";
        echo "</table>";
     
    } 
	echo"<input type='submit' name='add_stock'></form>";
	echo"</div></div></div></div></div></div>";
}


else if(isset($_POST['product_detail']))
{
	
	echo"
	<div class='row'>
<div class='col-md-6'><b></b></div>
<div class='col-md-6'>
<input type='hidden' name='pid' value='$pid' class='form-control'/><b></b>
</div>
</div><br/>
<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>

<b><center><h2><u>Product information</u><h2></center></b><br/>

<form action='add_stock.php' method='post' id='loginform' >
<div class='row'>
<div class='col-md-6'><b></b></div>
<div class='col-md-6'>

</div></div>
";


if(isset($_POST['product_detail']))
{
	$text1=$_POST['txt1'];
	$quantity=$_POST['txt3'];
	//$quan=$_POST['txt3'][1];
	//print_r($quantity);
	//print_r($text1);
	//$num=$quantity+$quan;
	//echo"<br/>$num";
	

	echo"<table><tr><th>product type</th><th>product name</th><th>quantity</th></tr>";
	for($i=0;$i<count($text1);$i++)
	{
		for($j=0,$sn=1;$j<$quantity[$i];$j++,$sn++)
		{
		echo"<tr><td>$sn ".$text1[$i]."</td>
		<td> <input type='text' name='p_type[]'class='form-control'/></td>
		<td><input type='text' name='p_name[]'class='form-control'/></td>
		<td><input type='hidden' name='r1' value='$pid'/>$pid</td>
		</tr>";
		}
	}
	
	
	echo"
	</table>";
	
}

	

echo"<br/><br/>
<div class='row'><br/>
<div class='col-md-6'></div>
<div class='col-md-6'>
<input type='submit' name='product_info' value='submit' class='btn btn-info'/>
<input type='reset' name='reset' value='Reset' class='btn btn-info'/>
</form>

</div>
</div><br/>";

echo"
</div>
</div>
</div>
</div></div>
<br/><br/>";
}
	
	

// product detail forms

else if (isset($_POST['add_stock']))
{
echo"
<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<div class='panel panel-info'>
<div class='panel-heading'><b><center><h2><u>Product Details</u><h2></center></b></div><br/>
<div class='panel-body'>";

echo"
<form action='add_stock.php' method='post' id='loginform' enctype='multipart/form-data'>
<div class='row'>
<div class='col-md-6'><b>inventory_id:</b></div>
<div class='col-md-6'>
<input type='hidden' name='iid' value='$id' class='form-control'/><b>$id</b>
</div>
</div><br/>";

if(isset($_POST['add_stock']))
{
	$no_items=$_POST['no_item'];
	echo"$no_items";
	/*$query="Select product_type from product_details";
	
	$query_result=mysqli_query($con_status,$query);
	print_r($query_result;
	if($query_result)*/
	//{
//$_a=$_REQUEST['txt1'];
//echo"$_a";
$query="select Category from stock_category";
$result=mysqli_query($con_status,$query);
if($result)
{
	$categories=mysqli_fetch_row($result);
	//print_r($category);
}

	echo"<table><tr><th>product type</th><th>model no</th><th>quantity</th></tr>";
	for($i=0;$i<$no_items;$i++)
	{
		echo"<tr><td><select name='txt1[]' class='form-control'>";
		while ($row = mysqli_fetch_array($result)) {
			echo '<option>' . $row['Category'] . '</option>';
		}
		mysqli_data_seek($result, 0);
		echo"</td>
		<td><input type='text' name='txt2[]' class='form-control'/></td>
		<td><input type='text' name='txt3[]'class='form-control'/></td>
		
		</form></tr>";
	}
}
	echo"
	</table>";
	
//}

echo"<br/>
<div class='row'><br/>
<div class='col-md-3'></div>
<div class='col-md-6'>
<input type='submit' name='product_detail' value='submit' class='btn btn-info'/>
<input type='reset' name='reset' value='Reset' class='btn btn-info'/>
</div></div>
</div>
</div>";

echo"
</div>
</div>
</div>
</div></div></div>
</div>
</div><br/>";
}



// ADD STOCK FORMS

else{
	
echo"

<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<div class='panel panel-info'>

<div class='panel-heading'><b><center><h2><u>Add stock</u><h2></center></b></div><br/>
<div class='panel-body'>";

echo"
<form action='add_stock.php' method='post' id='loginform' enctype='multipart/form-data'>
<div class='row'>
<div class='col-md-6'><b>Bill number:</b></div>
<div class='col-md-6'>
<input type='file' name='b_no' class='form-control'/>
</div>
</div><br/>
<div class='row'>
<div class='col-md-6'><b>Bill date:</b></div>
<div class='col-md-6'>
<input type='date' name='b_date' class='form-control'/>
</div>
</div><br/>

<div class='row'><br/>
<div class='col-md-6'><b>Entry date:</b></div>
<div class='col-md-6'>
<input type='date' name='e_date' class='form-control'/>
</div>
</div><br/>
<!--
<div class='row'><br/>
<div class='col-md-6'><b>Product type:</b></div>
<div class='col-md-6'>
<Select name='p_type' class='form-control'>
<option value='A'>Select</option>
<option value='Sationary'>Sationary</option>
<option value='furniture'>furniture</option>
<option value='electronics'>electronics</option>
</Select>
</div>
</div><br/>
-->

<div class='row'><br/>
<div class='col-md-6'><b>No of items:</b></div>
<div class='col-md-6'><input type='text' name='no_item'  class='form-control'/></div></div>
</div><br/>


<div class='row'><br/>
<div class='col-md-6'><b>Bill amount:</b></div>
<div class='col-md-6'><input type='text' name='b_amount' class='form-control'/></div>
</div><br/>
<div class='row'><br/>
<div class='col-md-4'></div>
<div class='col-md-8'>



</div>
</div>
<input type='submit' name='add_stock' value='Add stock' class='btn btn-info'/>
<input type='reset' name='reset' value='Reset' class='btn btn-info'/>
<a href='add_stock_view.php'  class='btn btn-info'>view/edit</a>
<a href='id_stock.php'  class='btn btn-info'>select Category</a>";

echo"
</div>
</div>
</div>
</div>
</div></div>
</div>
</div>
</div>
<br/>";
}

?>
<?php
include_once("footer.php");
?>

</body>
</html>