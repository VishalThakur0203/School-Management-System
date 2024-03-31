
        <style>
        table {
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        .form-control {
            width: 80px;
        }
       
</style>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">-->



<?php

//require_once("connection.php");
require_once("data.php");
include_once("link.php");
include_once("header.php");

echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>";
if (isset($_POST['update_copy'])) {
    $productId = $_POST['productId'];
    $copyValue = $_POST['copy'];

   $query="update product_info set copy=$copyValue where id=$productId";
   $result=mysqli_query($con_status,$query);
   if($result)
   {
    echo"<h2><center style='color:Red'>success</center></h2>";

   }
   else
   {
    echo"eror";
   }
}

echo "
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-12'><br/><br/><br/>
";

$query = "SELECT product_details.pid, product_details.product_type, product_info.id, product_info.product_name,product_info.serial_no,product_info.copy,product_info.issue_date,product_info.return_date,product_info.status FROM product_details INNER JOIN product_info ON product_details.pid = product_info.pid";
$result = mysqli_query($con_status, $query);

if ($result) 
{
    $row_count = mysqli_num_rows($result);
    $col_count = mysqli_fetch_fields($result);

    echo "
    <table class='table'>
   
        <tr>
            <th>ID</th>
            <th>PID</th>
            <th>Product Name</th>
            <th>Serial No</th>
            <th>Copy</th>
            
            <th>QR Image</th>
        </tr>
    ";

    while ($row = mysqli_fetch_array($result))
     {
        $_names = ['pen', 'pencil', 'eraser','stick'];

        if (in_array(strtolower($row['product_name']), $_names))
         {
            continue;
        }
       // $qr_data = "ID:" . $row['id'] . "\nPID: " . $row['pid'] . "\nProduct: " . $row['product_name'] . "\nSerial_number: " . $row['serial_no'] . "\nIssue_Date: " . $row['issue_date'] . "\nReturn_Date: " . $row['return_date'];
        echo "
        <tr>
            <td>".$row['id']."</td>
            <td>".$row['pid']."</td>
            <td>".$row['product_name']."</td>
            <td>".$row['serial_no']."</td>
            
            <td>
                <form method='post'>
                    <select class='form-control' name='copy' onchange='this.form.submit()'>
                        <option>".$row['copy']."</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <input type='hidden' name='productId' value='".$row['id']."'>
                    <input type='hidden' name='update_copy'>
                </form>
            </td>
    ";
        for ($i = 0; $i < $row['copy']; $i++)
         {
            $qr_data = "ID:" . $row['id'] . "\nPID: " . $row['pid'] .  "\nproduct_type: " . $row['product_type']."\nProduct: " . $row['product_name'] . "\nSerial_number: " . $row['serial_no'] . "\nstatus: " . $row['status']. "\nIssue_Date: " . $row['issue_date'] . "\nReturn_Date: " . $row['return_date'];
            $qr_file = "images_" . $row['id'] . "_copy_" . ($i + 1) . ".png";
            QRcode::png($qr_data, $qr_file);
            echo "<td><img src='".$qr_file."' width='100'></br><br/>&nbsp;&nbsp;
           <a href='download.php?file=".$qr_file."'>Download</a></td>";
        }
    }
    echo "</table>";
}
echo "
    </div>
  </div>
</div></div></div></div>";
include_once("footer.php");
?>
