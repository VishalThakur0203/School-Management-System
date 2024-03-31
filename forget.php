<html>
   <head>
    <script>
        function otp_f(num)
{
	var num1=num;
	var v1=document.getElementById('c1').value;
	if(!v1.match(num1))
	{
		alert('Incorrect OTP');
		return false;
		}
		else
			return true;
}
function match_password()
{
	var p1=document.getElementById('text3').value;
	var p2=document.getElementById('text4').value;
	if(!p1.match(p2))
	{
		alert("password mismatch");
		return false;
		}
		else
		{
		return true;
		}
	}
        </script>
     
       
    
 <?php
        require_once("process.php");
        ?>
        <?php
        include_once("link.php");
        ?>
         <?php
    include_once("header.php");
    include_once("connection.php");
     ?>
      
      <?php

        
  $NEW_OTP="";       
if(isset($_POST['a2']))
{
$emailid=$_POST['text1'];
$num="";
$sql="select * from infom where E_mail='$emailid'";
$query_result=mysqli_query($con_status,$sql);
if($query_result)
{
    $num=mysqli_num_rows($query_result);
}
else
{
echo $sql;
}
if($num==0)
{
echo"invalid email";
}
else
{
    $NEW_OTP=rand(1000,9999);
    echo"new otp is-".$NEW_OTP;
    $sql="update infom set OTP=$NEW_OTP where E_mail='$emailid' ";
    $result=mysqli_query($con_status,$sql);
    if($result)
    {

        echo "
        <html>
        <head>
        <style>
        body {
            text-align: center;
            margin: 0;
            padding: 0;
            
            background-color: #f4f4f4;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 10% auto;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type=submit] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
 </style>
        </head>
         <body>
      <form action='forget.php?act=2' method='post' onsubmit='return otp_f($NEW_OTP)' style='min-height:600px;'>
       <b> <div class='login-container'>
        <div class='row'>
        <div class='col-md-12'>
         OTP:<input type='text' name='c1' id='c1' class='form-control' style='width:100%;'>
        <input type='submit' value='submit' name='c2' class='btn btn-info'>
    </div>
    </div>
    </div>
    </form>
   </body>
    </html>";
}
else
          {
	echo "OTP not inserted";
          }
    }
}
 elseif(isset($_POST['c2']))
 {
       echo"$NEW_OTP--";
    echo "<html>
    <head>
    <title>Reset Password</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            padding: 0;
            
            background-color: #f4f4f4;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 10% auto;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type=submit] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        
    </style>
</head>
<body>
    <b>
        <form action='forget.php?act=3' method='post' onsubmit='return match_password()' style='min-height: 500px;'>
            <div class='login-container'>
                <br/><br/><br/>
                <div class='row'>
                    <div class='col-md-12'>
                        <label for='text3'>Create a New Password:</label>
                        <input type='password' name='b1' id='text3' class='form-control' required>
                        <br/><br/>
                        <label for='text4'>Re-Enter your Password:</label>
                        <input type='password' name='b3' id='text4' class='form-control' required>
                        <br/><br/>
                        <input type='submit' value='Set a Password' class='btn btn-info' name='b2'>
                    </div>
                </div>
            </div>
        </form>
    </b>
</body>
</html>
";
 }
 else
 {
    echo "<html>
    <head>
    <style>
    body{
    justify-content: center;
    align-items: center;
    margin: 0;
    background-color: #f4f4f4;
}

.container {
    margin-top:10%;
   padding: 100px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width:40%; 
    heigth: 40px;
 
}



input[type=submit] {
    background-color: blue;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

</style>
    </style>

   </head>
    <body>
   
    <form action='forget.php?act=1' method='post' style='min-height:500px;'>
    <div class='container'>
    <div class='row'>
    <div class='col-md-12'>
   
  Enter your email:<input type='text' name='text1' class='form-control' style='width: 100%;'><br/><br/>
    <center> <input type='submit' value='OK' name='a2' class='btn btn-info'></br></center>
   
    </div>
    </div>
    </div>
    </form>
    
    </body>
    </html>";   
 }
 ?>
 <?php

  include_once("footer.php");
  ?>
 
 