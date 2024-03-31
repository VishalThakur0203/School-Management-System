<?php
require_once("connection.php");
require_once("link.php");
include_once("header.php");

$query = "SELECT * FROM school";
$query_result = mysqli_query($con_status, $query);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <br /><br /><br />
            <?php include_once("leftpane.php"); ?>
        </div>

        <div class="col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center><h2 class="main-heading">Notes Records</h2></center>
                    </div>
                </div>
            </div>

            <?php
            if ($query_result) {
                $row_data = mysqli_num_rows($query_result);
                $col_data = mysqli_num_fields($query_result);

                if ($row_data > 0) {
                    echo "<table class='table' id='example'>
                            <thead><tr>";

                    while ($abc = mysqli_fetch_field($query_result)) {
                        $col_name = $abc->name;
                        echo "<th>$col_name</th>";
                    }

                    echo "</tr></thead>
                            <tbody>";

                    while ($row_abc = mysqli_fetch_array($query_result)) {
                        echo "<tr>";
                        for ($i = 0; $i < $col_data; $i++)
                            echo "<td>{$row_abc[$i]}</td>";

                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                }
            }
            ?>
            
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
    $(document).ready(function () 
    {
        $('#example').DataTable();
    });
</script>
