<html>
<head>

</head>
<body>
<?php
include("link.php");
require_once("header.php");
?>

    
<?php
require_once("data.php");
echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>";
echo"
<div class='container'>

<form action='view.php' method='post'>
</br/></br><br/><br/>
<div class='col-md-4'></div><div class='col-md-8'>
<input type='hidden'></td>
Name<input type='text' name='name' id='name' required>
<input type='submit' name='GO' value='find' >

</form>
</div>
</div>
";
echo"
<div class='container'>
<div class='row'>
<div class='col-md-12'>
<form action='view.php' method='post'>
</br/></br><br/><br/>
<div class='col-md-12'>
<input type='hidden'></td>

<input type='submit' name='v1' value='Accepted list' >
<input type='submit' name='v2' value='rejected list' >
<input type='submit' name='v3' value='waiting list' >
</form>
</div>
</div>
</div>
";
if(isset($_POST['v1']))
{

  $query="Select Name,Email,status from teacher_leave_ap WHERE status='1' ";
  $result = mysqli_query($con_status, $query);
    if ($result) 
    {
     if (mysqli_num_rows($result)>0)
     echo "<center><h2>Accepted Leave Applications</h2></center>";
     echo "
     <table class='table table-bordered table-hover'>
         <tr><thead>
             <th>Name</th><th>E_mail</th><th>Status</th>
       </thead>  <tbody></tr>";

     while ($row_data_accepted = mysqli_fetch_array($result)) {
         echo "
             <tr>
                 <td>".$row_data_accepted['Name']."</td>
                 <td>".$row_data_accepted['Email']."</td>
                 <td>".$row_data_accepted['status']."</td>
             </tr></tbody>";
     }
     echo "</table>";
    }
    }

    if(isset($_POST['v2']))
{

  $query="Select Name,Email,status from teacher_leave_ap WHERE status='-1' ";
  $result = mysqli_query($con_status, $query);
    if ($result) 
    {
     if (mysqli_num_rows($result)>0)
     echo "<center><h2>Rejected Leave Applications</h2></center>";
     echo "
     <table class='table'>
         <tr>
             <th>Name</th><th>E_mail</th><th>Status</th>
         </tr>";

     while ($row_data_rejected = mysqli_fetch_array($result)) {
         echo "
             <tr>
                 <td>".$row_data_rejected['Name']."</td>
                 <td>".$row_data_rejected['Email']."</td>
                 <td>".$row_data_rejected['status']."</td>
             </tr>";
     }
     echo "</table>";
    }
    }
    if(isset($_POST['v3']))
    {
    
      $query="Select Name,Email,status from teacher_leave_ap WHERE status='0' ";
      $result = mysqli_query($con_status, $query);
        if ($result) 
        {
         if (mysqli_num_rows($result)>0)
         echo "<center><h2>Waiting Leave Applications</h2></center>";
         echo "
         <table class='table'>
             <tr>
                 <th>Name</th><th>E_mail</th><th>Status</th>
             </tr>";
    
         while ($row_data_accepted = mysqli_fetch_array($result)) {
             echo "
                 <tr>
                     <td>".$row_data_accepted['Name']."</td>
                     <td>".$row_data_accepted['Email']."</td>
                     <td>".$row_data_accepted['status']."</td>
                 </tr>";
                }

                echo "</table>";
            } 
                
            
            echo"no record";
        
    
    }

echo"<div class='col-md-12'>";
if(isset($_POST['GO']))
 {
    $name = $_POST['name']; 

    $query2 = "select * FROM teacher_leave_ap WHERE Name='$name'";
    $result = mysqli_query($con_status, $query2);
    if ($result) 
    {
     if (mysqli_num_rows($result)>0)
 
      while ($row = mysqli_fetch_assoc($result)) 
      {
        echo"<style>
        
    </style>
    <table class='table table-bordered table-hover'>
    <tr><thead><th>Name</th><th>E_mail</th><th>start</th><th>End</th><th>Status</th></thead><tbody></tr>
    <tr><td>".$row['Name']."</td>
    <td>".$row['Email']."</td>
     <td>".$row['Leave_start_date']."</td>
     <td>".$row['leave_end_date']."</td>
     <td>".$row['status']."</td>
     </tbody> </tr>
</table> ";
      }
       else{
        echo "
        This record is not submit";

       }
    }
    echo"</div>";
}


$query = "select * from teacher_leave_ap";
$query_result = mysqli_query($con_status, $query);
if ($query_result) 
{
   
    $row_count = mysqli_num_rows($query_result);
    $col_count = mysqli_num_fields($query_result);

    if ($row_count > 0) {
        echo "
        <div class='table-responsive'>
            <table class='table table-bordered table-hover' style='width: 100%;'>";
        echo "<tr><thead>";
    
        for ($i = 0; $i < $col_count; $i++) {
            $abc = mysqli_fetch_field($query_result);
            $col_name123 = $abc->name;
            echo "<th>$col_name123</th>";
        }
        echo "<th></th><th>Approved</th><th>Reject</th>";
        echo "</thead></tr>";
        while ($row_data = mysqli_fetch_array($query_result)) {
            $id = $row_data['id'];
            echo "<tbody><tr>";
    
            for ($i = 0; $i < $col_count; $i++) {
                if ($i == 0) {
                    echo "<td>".$row_data[$i]."</td>";
                } else {
                    echo "<td>$row_data[$i]</td>";
                }
            }
            echo "<form action='data.php' method='post'>
                      <td>
                        <input type='hidden' name='id' value='$id'>
                      </td>
                      <td>
                        <input type='submit' value='Accept' name='approved'>
                      </td>
                      <td>
                        <input type='submit' value='Reject' name='reject'>
                      </td>
                  </form>";
    
            echo "</tr></tbody>";
        }
        echo "</table></div></div></div>
        </div></div></div></div>";
    }
}
?>
<?php
echo" </div></div></div></div>";
require_once("footer.php");
?>
</body>
</html>




