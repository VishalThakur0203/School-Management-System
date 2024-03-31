<?php
require_once("connection.php");
require_once("link.php");
include_once("header.php");
?>

<?php
echo "
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-2'>";
include_once("leftpane.php");
echo "
        </div>
        <div class='col-md-10'>
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>";

$query = "select * from std_reg";
$query_result = mysqli_query($con_status, $query);

if ($query_result) {
    $row_count = mysqli_num_rows($query_result);
    $col_count = mysqli_num_fields($query_result);

    if ($row_count > 0) {
        for ($i = 0; $i < $col_count; $i++) {
            $abc = mysqli_fetch_field($query_result);
            $col_name123 = $abc->name;
            echo "<th>$col_name123</th>";
        }
        echo "</tr>
            </thead>
            <tbody>";

        while ($row_data = mysqli_fetch_array($query_result)) {
            echo "<tr>";
            for ($i = 0; $i < $col_count; $i++) {
                if ($i == 11) {
                    
                } else {
                    echo "<td>$row_data[$i]</td>";
                }
            }
            echo "</tr>";
        }
        echo "</tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>";
    }
}
?>

<?php
include_once("footer.php");
?>
