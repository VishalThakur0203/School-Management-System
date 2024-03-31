<?php
require_once("connection.php");
require_once("data.php");
//require_once("phpqrcode/qrlib.php");
echo "
    <style>
        table {
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
";

echo "
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-2'><br/><br/><br/>";

echo "
        </div>
        <div class='col-md-10'>
";



echo "
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'><br/><br/><br/>
";

$query = "SELECT product_details.pid, product_details.product_type, product_info.id, product_info.product_name,product_info.serial_no,product_info.copy,product_info.issue_date,product_info.return_date,product_info.status FROM product_details INNER JOIN product_info ON product_details.pid = product_info.pid";
$result = mysqli_query($con_status, $query);

if ($result) {
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

    while ($row = mysqli_fetch_array($result)) {
        $_names = ['pen', 'pencil', 'eraser', 'stick'];

        if (in_array(strtolower($row['product_name']), $_names)) {
            continue;
        }

        echo "
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['pid']."</td>
                <td>".$row['product_name']."</td>
                <td>".$row['serial_no']."</td>
                <td>".$row['copy']."</td>
        ";

        for ($i = 0; $i < $row['copy']; $i++) 
        {
            
            $qr_data = "ID:" . $row['id'] . "\nPID: " . $row['pid'] .  "\nproduct_type: " . $row['product_type']."\nProduct: " . $row['product_name'] . "\nSerial_number: " . $row['serial_no'] . "\nstatus: " . $row['status']. "\nIssue_Date: " . $row['issue_date'] . "\nReturn_Date: " . $row['return_date'];
            $qr_file = "images_" . $row['id'] . "_copy_" . ($i + 1) . ".png";
             QRcode::png($qr_data, $qr_file); 
             echo "<td><img src='".$qr_file."' width='100'></br><br/>&nbsp;&nbsp;
             ";
        }

        echo "</tr>";
    }

    echo "</table>";
}

echo "
                </div>
            </div>
        </div>
    </div>
</div>
</div>
";



?>
