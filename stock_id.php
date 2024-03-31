<?php
require_once("connection.php");
include_once("link.php");
include_once("header.php");
include_once('phpqrcode/qrlib.php');
?>
<style>
    table
    {
        width:100%;
    }
    </style>

<?php
echo "<div class='container-fluid'>
    <div class='row' style='margin-top:50px;'>";
echo "<div class='col-md-2'>";
include_once('leftpane.php');
echo "</div>
<div class='col-md-10'>";

if (isset($_POST['v1'])) 
{

    $id =mysqli_real_escape_string($con_status, $_POST['v2']);
    /*$query = "SELECT inventory_tb.iid,product_info.pid,product_info.product_name,product_info.serial_no,product_info.status
              FROM inventory_tb
              JOIN product_info ON product_info.id = inventory_tb.iid
              WHERE product_info.id =$id";*/
              $query="SELECT t1.pid,product_name,serial_no,status,issue_date,return_date ,t2.iid FROM product_info t1 ,product_details t2 where t1.id=$id and t1.pid=t2.pid;";
     $result = mysqli_query($con_status, $query);
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
     {
        echo "
        <table border='1'>
            <tr>
            <th>iid</th>
                <th>product_id</th>
                <th>product_name</th>
                <th>Serial_no</th>
                <th>status</th>
                <th>Qr</th>
            </tr>
        ";
        $row = mysqli_fetch_array($result);
        { 
            $qr_data = "IiD: " . $row['iid'] ."\nProduct_id: " . $row['pid'] . "\nProduct Name: " . $row['product_name'] . "\nSerial Number: " . $row['serial_no']. "\nStatus: " . $row['status']. "\nIssue_date: " . $row['issue_date']. "\nReturn Date: " . $row['return_date'];
            $qr_file = "images/" . $row['iid'] . ".png"; 
        
            QRcode::png($qr_data, $qr_file);
        
            echo "
            <tr>
                <td>".$row['iid']."</td>
                <td>".$row['pid']."</td>
                <td>".$row['product_name']."</td>
                <td>".$row['serial_no']."</td>
                <td>".$row['status']."</td>
                <td><img src='".$qr_file."'> </td>
            </tr>";
        }
        
        echo "</table>
    <center><a href='stock_id.php'>Back</a></center></div></div></div>";
    } else 
    {
        echo "No records <center><a href='stock_id.php'>Back</a></center></div></div></div>";
    }
}

else{

echo "<div class='container'>
        <div class='row'>
            <div class='col-md-4'></div>
            <div class='col-md-8'>
                <form action='stock_id.php' method='post'>
                    <table>
                        <tr>
                <th>Enter Id 
                 <td><input type='text' name='v2' class='form-control' style='width:300px';></td>
                 </tr>
        </table>
           </br>
             <input type='submit' name='v1'>
                </form>
            </div>
        </div>
    </div>
</div>";
}
?>
<?php
include_once("footer.php");
?>
