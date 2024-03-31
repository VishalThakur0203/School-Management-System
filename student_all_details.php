<?php
require_once("connection.php");
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        .thumbnail {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .thumbnail:hover {
            transform: scale(1.2);
        }

        .student-info {
            margin-top: 20px;
        }

        .student-container {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
        }

        .thumbnail-cell {
            width: 100px;
        }

        .student-info td {
            padding: 10px;
            text-align: left;
        }

        .student-info td b {
            display: block;
            margin-bottom: 5px;
            font-size: 1.2em;
        }
    </style>
</head>

<body>

    <?php
    $sql = "SELECT * FROM `std_reg`";
    $result = mysqli_query($con_status, $sql);
    echo "<center><h2>Students are:</h2></center>";
    ?>

    <div class="col-md-12">
        <div class="student-info">
            <table id="example" class="student-table">
                <thead>
                    <tr>
                        <th>student Image</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Session</th>
                        <th>Gender</th>
                        <th>DOB</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $imgname = $row['pic'];
                        $name = $row['name'];
                        $class = $row['class'];
                        $session = $row['session'];
                        $gender = $row['gender'];
                        $dob = $row['dob'];
                        $imageUrl = "pictures/{$id}.jpg";

                        echo "<tr>";
                        echo "<td class='thumbnail-cell'><img class='thumbnail' src='{$imageUrl}' alt='Image'></td>";
                        echo "<td><b>{$name}</b></td>";
                        echo "<td>{$class}</td>";
                        echo "<td>{$session}</td>";
                        echo "<td>{$gender}</td>";
                        echo "<td>{$dob}</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
<?php
echo"</div></div></div>";
?>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

    <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

</html>


