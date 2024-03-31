<html>
  <head>
  <style>
body {

   
  }

  .container {
   
   
    padding: 20px;
    border-radius: 8px;
    
  }

  table {
    width: 100%;
   
  }

  th,td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
  }
  .form-control {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
  }

</style>


<?php
require_once("link.php");
include_once("header.php");
?>
</head>
<body>
<?php
echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>
<div class='container>
<div class='row'>
<div class='col-md-12'>
<form  action='data.php' method='post' style='min-height:500px;' >
<br/><br/>
<table border='0'>
<tr>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Session:</th><td><input type='text'class='form-control' style='width:70%' name='session'></tr>

</table></br><br/><br/>

<table border='0'>
<tr><th>Class</th><th>Admission fee</th><th>Examination Fee</th><th>Tuition Fee</th><th>TransportationFee  Per/km</th><th>Fee_Type</th><th>Total Amount</th></tr>
";
$class_list = array("LKG","UKG","1st","2nd","3rd","4th","5th","6th","7th","8th","9th","10th","11th","12th");
for($i=0;$i<count($class_list);$i++)
{
echo "<tr>
<td> <input type='hidden' name='class[]' value='$class_list[$i]'/>$class_list[$i]</td>
<td> <input type='text' name='admission_fee[]' class='form-control'></td>
<td> <input type='text' name='exam_fee[]' class='form-control'></td>
<td> <input type='text' name='tuition_fee[]' class='form-control'></td>
<td> <input type='text' name='trans_fee[]'class='form-control'></td>
<td> <select name='Fee_Type[]' class='form-control'>
<option value='1'>Annually</option>
<option value='2'>Biannually</option>
<option value='4'>Quarterly</option>
<option>monthly</option>

</td>
<td><input type='text' class='form-control'><td>
</tr>";
}
echo"</table>
<br/><br/><br/><br/>
<center><input type='submit' name='pay' value='Ok' class='btn btn-info'></center>
</form>
</div></div></div>";
?>
<?php
include_once("footer.php");
?>
</body>
</html>