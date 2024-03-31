<html>
    <head>
  <style>
     
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
     
    }
    .container {
     
      margin: 10px auto;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    th {
      text-align: left;
    }

    .form-control {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }
    .submit-btn {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  
    </style>
    <?php
        require_once("process.php");

        include_once("link.php");
        ?>
    </head>
    <body>
        <?php
    include_once("header.php");
include_once("connection.php");
    ?>
<script>
   function onPayButtonClick() {
            alert('confirm');
            var confirmed = confirm('Are you sure you want to proceed with the payment?');
            if (confirmed) {
             alert('Payment confirmed');
             
            } else {
                
                alert('Payment canceled');
                window.location.href = 'cancel_payment.php';
                return false; 
            }
        }
  </script>

     
       <?php
       function numberToWords($number) 
       {
           $ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
           $tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
           $hundreds = ["", "One Hundred", "Two Hundred", "Three Hundred", "Four Hundred", "Five Hundred", "Six Hundred", "Seven Hundred", "Eight Hundred", "Nine Hundred"];
      
           $word = "";
       
           if ($number < 20) 
           {
               $word .= $ones[$number];
           } 
           elseif ($number < 100) 
           {
               $word .= $tens[(int)($number / 10)];
               if ($number % 10 > 0) 
               {
                   $word .= " " . $ones[$number % 10];
               }
           } 
           elseif ($number < 1000) 
           {
               $word .= $hundreds[(int)($number / 100)];
               if ($number % 100 > 0) 
               {
                   $word .= " " . numberToWords($number % 100);
               }
           } 
           elseif ($number < 1000000) 
           {
               $word .= numberToWords((int)($number / 1000)) . " Thousand";
               if ($number % 1000 > 0) {
                   $word .= " " . numberToWords($number % 1000);
               }
           } 
           else 
           {
               $word .= "Invalid Input";
           }
       
           return $word;
       }
       
    
       

       if(isset($_POST['num']))
       { 
        $id=$_POST['texta'];
        //$class=$_POST['textb'];
      $sql="select id,class,section,session,name from std_reg where id='$id'";
       if(mysqli_query($con_status,$sql))
{
$data=mysqli_fetch_row(mysqli_query($con_status,$sql));

}

echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>";    
echo"<html>
      <head>
      

        <title>Update Fee Structure</title>
      </head>
      <body>
      <div class='container' style='margin-top:50px; min-height:200px;'>
          <center><h2>Fee Details</h2></center><br/><br/>

          <form action='studentFee.php' method='post'>
            <table>
            <tr>
      <th>student name</th>
      <td><input type='hidden' name='txt1' value='$data[4]' class='form-control'>$data[4]</td></tr>
      <tr>

      <tr>
      <th>Rollno.</th>
      <td><input type='hidden' name='txt' value='$data[0]' class='form-control' >$data[0]
      </td><input type='hidden' name='txt3' class='form-control'></td></tr>
      
      <th>course</th>
      <td><input type='hidden' name='txt4' value='$data[1]' class='form-control'>$data[1]
      </td></tr>
      
      <tr>
      <th>section</th>
      <td><input type='hidden' name='txt1' value='$data[2]' class='form-control'>$data[2]</td></tr>
      <tr>
      <th>Session</th>
      <td><input type='hidden' name='txt2' value='$data[3]'class='form-control'>$data[3]</td></tr>
      <tr>
      
       </table>
           </form>
         </div>
       </body>
       </html>";
       
       if (!empty($data[1])) 
       {
        $sql = "Select Admission_fee, Examination_fee, Tuition_fee,Transportation_Fee from student_payment 
                WHERE Course IN
               (SELECT class from std_reg where id=$data[0])";
        $query_result = mysqli_query($con_status, $sql);
		//$fee=mysqli_fetch_array($query_result);
	    
		//$sum=$fee[0]+$fee[1]+$fee[2]+$fee[3];
		//echo"<br/>$sum";
		
    
        if ($query_result)
			{
            echo "<div class='container'>
            <form action='process.php' method='post' id='paymentForm' onsubmit='return validatePayment()'>
            <input type='hidden' value='$data[0]' name='txt'><br/>
			<input type='hidden' value='$data[1]' name='txt4'>
      
      
      <input type='hidden' name='txt4' value='$data[1]' class='form-control'>";
			//echo"<h3> Fee Structure </h3>";
echo"<table>";
            
			
            $row=mysqli_fetch_row($query_result);
           // print_r($row);

		$query2="select * from fee_payment where Roll_no='$data[0]'";
    //echo"";
		 $query_result2=mysqli_query($con_status,$query2);
		$fee_amt=0;
		while($row_data=mysqli_fetch_array($query_result2))
				{
          $fee_amt +=$row_data[3];
         // echo"$fee_amt";
        }
			//print_r($row[0]);
                echo "<tr><th>Admission Fee:</th><td>" . $row[0] . "</td><br></tr><tr>";
                echo "<th>Examination Fee:</th><td>" . $row[1] . "</td><br></tr><tr>";
                echo "<th>Transport Fee:</th><td>" . $row[2] . "</td><br></tr><tr>";
				//echo "<th>Payed Amount:</th><td>" . $fee_amt . "</td><br></tr><tr>";
			
				
				$total_amount=$row[0]+$row[1]+$row[2] ;
				echo"<th>Total Amount: </th><td>$total_amount</td><tr>";
				echo "<th>Payed Amount:</th><td>" . $fee_amt . "</td></tr>";
				$balance_amt=$total_amount-$fee_amt;
        //echo"$balance_amt";
				//echo"<tr><th>Balanced Amount</th><td>$balance_amt</td></tr>";
                //$total_fee = $row['Admission_Fee'] + $row['Examination_Fee'] + $row['Transport_Fee'];
                echo "<tr><th>Balance Amount:</th><td>" . $balance_amt . " (" . numberToWords($balance_amt) . ")</td></tr>";
        echo "<script>
                function validatePayment() {
                    var balance_amt = $balance_amt;
                    var minimumAmount = balance_amt / 2;
                    var paymentAmount = parseFloat(document.forms['paymentForm']['textp'].value);
                    
                    if (isNaN(paymentAmount) || paymentAmount < minimumAmount || paymentAmount > balance_amt) {
                        alert('Please enter a valid payment amount');
                        return false;
                    }
                    return true;
                }
            </script>";
				if ($balance_amt != 0)
				{
				echo "<tr><th>Enter The Amount you want to Pay</th><td><input type='text' name='textp' class='form-control' ></td></tr>";
                }
				//echo"<tr><th><Balance Amount<th><td>$total_amount </td></tr>";
            echo "</table></br></br>";
			//echo" Balance amount:$balance_amt";

			if ($balance_amt != 0)
			{
			echo "<center><input type='submit' value='Pay' name='r1' class='btn btn-danger'  >";
			}
			
      //echo "<center><input type='submit' value='Pay' name='r1' class='btn btn-danger' >
			echo"
			</form></center></div>";
             
			

			 $query="select * from fee_payment where Roll_no='$data[0]'";
		 $query_result=mysqli_query($con_status,$query);
		 if($query_result)
		 {
			 
			$row_count=mysqli_num_rows($query_result);
			$col_count=mysqli_num_fields($query_result);
				
			if($row_count>0)
			{
				echo "<table class='table'>";
				echo "<tr>";
				for($i=0;$i<$col_count;$i++)
				{
					$temp=mysqli_fetch_field($query_result);
					$col_name=$temp->name;
					echo "<th>$col_name</th>";

				}
       
				echo"<th>Download link</th>";
				echo "</tr>";

				while($row_data=mysqli_fetch_array($query_result))
				{
					echo "<tr>";
for ($i = 0; $i < $col_count; $i++) {
    echo "<td>" . $row_data[$i] . "</td>";
}
echo "<td><a href='fee_receipt.php?data=" . urlencode($row_data[0]) . "'>Download Receipt</a></td>";
echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "data not found";
      }
		 }
		 else
		 {
		 echo "query error";
		 }
			 
			 echo"<script>
                function validatePayment() {
                var totalFee = ;
                    var minimumAmount = totalFee / 2;
                    var paymentAmount = parseFloat(document.forms['paymentForm']['textp'].value);
                    
                    if (isNaN(paymentAmount) || paymentAmount < minimumAmount || paymentAmount > totalFee) {
                        alert('Please enter a valid payment amount');
                        return false;
                    }
                    return true;
                }
            </script>";
        }
    }
  }
        else
        {
          echo"
          <div class='container-fluid' style='margin-top:50px; min-height:600px;'>
                    <div class='row'>
          <div class='col-md-2'><br/><br/><br/>";
     include_once("leftpane.php"); 
     echo"
</div>
<div class='col-md-10'>";
echo"<html>
<head>
  <title>Student Fee Payment Form</title>
</head>
<body>
  <div class='container'>
    <center><h2>Student Fee Payment Form</h2></center><br/><br/>
    <form action='studentFee.php' method='post' >
      <table>
        <tr>
          <th>Roll_number</th>
          <td><input type='text' name='texta' class='form-control' style='width:60%;' required></td>       
       </table><br/><br/><br/>
           <center><input type='submit' name='num' class='btn btn-info'></center>
          </form>";
   echo"</div>
      </body>
      </html>
        ";
  }
  echo"</div></div></div>";
 
?>

<?php
 include_once("footer.php");
        ?>
       
</body>
</html>

