 <html>
   <head>
   <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css'>
</head>
<style>
        span
        {
            color:red;
            font-size:15px;
        }
        
            </style>
<script>  
  /* function otp_k(otp)
{
	var num1=num;
	var v2=document.getElementById('c1').value;
	if(!v2.match(num1))
	{
		alert('Incorrect OTP');
		return false;
		}
		else
			return true;
}*/


function match_otp(otp)
{
	var v2=otp;
	var v1=document.getElementById('otp').value;
	if(!v1.match(v2))
	{
	alert('OTP Mismatch');	
	return false;
	}
	else
			return true;
}
/*function password_match()
{
	
	var p1=document.getElementById('text33').value;
	var p2=document.getElementById('text34').value;
	if(!p1.match(p2))
	{
	alert('Password Mismatch');	
	return false;
	}
	else
			return true;
}*/





function myfun()
{
    var a=document.getElementById("user_name").value;
    //var b=document.getElementById("user_name1").value;
    if(a=="")
    {
        document.getElementById("message").innerHTML="*Please fill username";
        return false;
    }
    if(a.length<3)
    {
        document.getElementById("message").innerHTML="*error name is too short*";
        return false;
    }
    if(!/^[A-Z]+$/.test(a))
    {
document.getElementById("message").innerHTML="*only capital letters*";
return false; 
    }
}
function myfun1()
{
    var main=document.getElementById("phone_user").value;
    if(main=="")
    {
        document.getElementById("mes").innerHTML="*Please fill Phone number";
        return false;
    }

    if(/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/.test(main))
    {
        document.getElementById("mes").innerHTML="*Please enter correct number";
        return false;
    }
}

    </script>
 <body>

 
 <?php
        $num=require_once("process.php");
        ?>
        <?php
        include_once("link.php");
        ?>
         <?php
    include_once("header.php");
     ?> 
     <?php
     if(isset($_POST['nikhil']))
     {   $emailid=$_POST['emailo'];
        $sql="select * from infom where E_mail='$emailid'";
        $query_result=mysqli_query($con_status,$sql);
        $num=mysqli_num_rows($query_result);
        if($num==0)
        {
            $NEW_OTP=rand(1000,9999);
            $sql="insert into infom(E_mail,OTP) values('$emailid','$NEW_OTP')";
		    $result=mysqli_query($con_status,$sql);
          if($result)
		  {
			 $id=mysqli_insert_id($con_status); 
			 echo $id;
            echo "new otp is-".$NEW_OTP;

         //onsubmit=\"return myfun1()\"   
      
        echo"<html>
        <head>
       </head>
        <body>
        
        </style>
        <center>
        <div class='login-container'>
        <div class='row'>
        <div class='col-md-12'>                                                                
        <form action='newuser.php?&Eid=$id' method='post' onsubmit='return match_otp($NEW_OTP)'style='min-height:500px;'>
        <table>
        <tr><th>OTP</th><td><input type='text' name='otp' id='otp'></td></tr>
        <tr><td><input type='hidden' value='$emailid' name='email_v' ></td></tr>
        <tr><td><input type='submit' value='ok' name='b1' class='btn btn-info'>
        </table></form>
        </div>
        </div>
        </div>
        </center>
        </body>
        </html>";
     }
     else
			  echo "OTP ,Email not inserted";
    }
    else
	{
		echo "<center>User Already Exist<br/><center>";
		echo "<center><div class='login-container'>
        <div class='row'>
        <div class='col-md-12'> 
        <a href='page.php' class='btn btn-info'>Back</a>
        </div>
        </div>
        </div>
        </center>";
	}
}
elseif(isset($_POST['b1']))
{
    $eid=$_REQUEST['Eid'];
    
    $emailid=$_POST['email_v'];
    
    
	/*$to = $emailid;
$subject = "testing mail";
$txt = "Hello php!";
$headers = "From: gurcharanit@gmail.com";

mail($to,$subject,$txt,$headers);*/
    
    
    
    
    
    echo"<html>
    <head>
    <style>
    </style>
    </head>
    <body>
    <div class='container'>
    <div class='row'>
    <div class='col-md-12'>                                              
    <form action='process.php' method='post' onsubmit='return password_match()'  enctype='multipart/form-data' style='min-height:500px;'>
    <table>
  <tr><th>Name:</th>
  <td>
  <input type='text' name='r1' id=\"user_name\" class='form-control'style='width: 300px;' >
  <input type='hidden' value='$eid' name='eid'></td></tr>
  <tr><td><input type='hidden' id='mnr'>
        <span id=\"message\"></span><br><br></td></tr>

         
        <tr><th>E-mail:</th><td><input type='hidden' name='emailo' value='$emailid' class='form-control'style='width: 300px;'>$emailid<br><br>
        </td></tr></br>
       
       
        <tr><th>Phone no.:</th>
       <td> <input type='text' name='r3' id=\"phone_user\"class='form-control'style='width: 300px;'>
      <span id=\"mes\"></span><br><br></td></tr><br/>
        

        
      <tr><th>Gender:</th>
        <td><input type='radio' name='r4' value='Male'>
        Male<input type='radio'name='r4' value='Female'>Female<br><br></td></tr>
      


        <tr><th>Aadhar Card:</th>
        <td><input type='file'name='r5'><br><br></td></tr>
        

        
        <tr><th>Password:</th>
        <td><input type='text' name='r6' style='width:300px;' class='form-control'></td></tr>
      
         <tr><td><br/><br/><br/><br/>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='counter' style='width:300px; height:60px;'></td></tr>
      
       
       </table> 
    </form>
    </div></div></div>
    </body>
    </html>";
}
 
    else
    {
        echo"<html>
        <head>
        <style>
        body {
            text-align: center;
            
            background-color: #f4f4f4;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            margin: 10% auto;
            
        }

       

    </style>
       </head>
        <body>
        <div class='login-container'>
        <div class='row'>
        <div class='col-md-12'>
        <form action='newuser.php' method='post' >
        <table>
        <tr><th>Enter Your Email</th><td><input type='text' name='emailo' class='form-control' style='width:200%'></td></tr>
       </table><br/><br>
        <input type='submit' value='ok' name='nikhil' class='btn btn-info' >
        </form>
        </div>
        </div>
        </div>       
        </body>
        </html>";
    }
     
include_once("footer.php");
   ?>
   </body>
   </html>
  