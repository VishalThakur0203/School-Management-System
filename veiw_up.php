<?php
require_once("link.php");
include_once("header.php");
?>
<?php
require_once("connection.php");
require_once("data.php");

echo "
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");

echo "
        </div>
        <div class='col-md-10'>";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $Admission = $_POST['a_fee'];
    $Examination = $_POST['e_fee'];
    $Transport = $_POST['t_fee'];
    $Course = $_POST['u_fee'];
    $transport = $_POST['m_fee'];
    
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($con_status, $id);
    $Admission = mysqli_real_escape_string($con_status, $Admission);
    $Examination = mysqli_real_escape_string($con_status, $Examination);
    $Transport = mysqli_real_escape_string($con_status, $Transport);
    $Course = mysqli_real_escape_string($con_status, $Course);
    $transport = mysqli_real_escape_string($con_status, $transport);

    // Debug: Display input values
    echo "Debug: Input values - Admission: $Admission, Examination: $Examination, Transport: $Transport, Course: $Course, Transport: $transport<br>";

    // Construct the SQL query
    $sql = "UPDATE student_payment 
            SET Admission_fee='$Admission', Examination_fee='$Examination', Transportation_Fee='$Transport', Course='$Course' 
            WHERE Session=$id";

    // Debug: Display the SQL query
    echo "Debug: SQL Query: $sql<br>";

    // Execute the SQL query
    if (mysqli_query($con_status, $sql)) {
        echo "Updated successfully";
    } else {
        echo "Update failed: " . mysqli_error($con_status);
    }
}

// Fetch data from the student_payment table
$query = "SELECT * FROM student_payment";
$query_result = mysqli_query($con_status, $query);

if ($query_result) {
    $row_count = mysqli_num_rows($query_result);
    $col_count = mysqli_num_fields($query_result);

    if ($row_count > 0) {
        echo "<form style='min-height:900px;' action='veiw_up.php' method='post'><table class='table'>";
        echo "<tr>";

        echo "<th>edit/update</th>";
        for ($i = 0; $i < $col_count; $i++) {
            $abc = mysqli_fetch_field_direct($query_result, $i);
            $col_name123 = $abc->name;
            echo "<th>$col_name123</th>";
        }
        echo "</tr>";

        while ($row_data = mysqli_fetch_array($query_result)) {
            echo "<tr>";

            if (isset($_REQUEST['act']) && $_REQUEST['act'] == 1 && $_REQUEST['id'] == $row_data[0]) {
                echo "<td>
                        <input type='submit' value='Update' name='update'>
                        <a href='#'>Delete</a>
                      </td>
                      <td><input type='hidden' value='" . $row_data[0] . "' name='id'></td>
                      <td><input type='text' name='a_fee' value='" . $row_data[1] . "'></td>
                      <td><input type='text' name='e_fee' class='form-control' value='" . $row_data[2] . "'></td>
                      <td><input type='text' name='t_fee' class='form-control' value='" . $row_data[3] . "'></td>
                      <td><input type='text' name='m_fee' class='form-control' value='" . $row_data[4] . "'></td>
                      <td><input type='text' name='u_fee' class='form-control' value='" . $row_data[5] . "'></td>";
            } else {
                echo "<td>
                        <a href='veiw_up.php?id=" . $row_data[0] . "&act=1'>Edit</a>
                        <a href='veiw_up.php?id=" . $row_data[0] . "&act=2'>Delete</a>
                      </td>";
                for ($i = 1; $i < $col_count; $i++) { // Start from 1 to skip the ID column
                    echo "<td>{$row_data[$i]}</td>";
                }
            }

            echo "</tr>";
        }
        echo "</table></form>";
    }
    echo "</div></div></div>";
    include("footer.php");
}
?>

