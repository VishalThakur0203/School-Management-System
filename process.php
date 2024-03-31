<?php
require_once("connection.php");


if(isset($_POST['counter']))
{
	echo "insert case<br/>";
	//$id_value=$_POST['mnr'];
	$name_value=$_POST['r1'];
	$email_value=$_POST['emailo'];
	$phone_value=$_POST['r3'];
    $Gender_value=$_POST['r4'];
	$class_value=$_POST['r6'];
	$img_value=$_FILES['r5'];
	/*echo "r1 =$name_value<br/>";
	echo "r2 =$email_value<br/>";
	echo "r3 =$phone_value<br/>";
	echo "r4 =$Gender_value<br/>";
	//echo " r5=$Aadhar_value<br/>";
	echo "r6=$class_value";*/
	$img_name=$img_value['name'];  //UPDATE `infom` SET `id`='[value-1]',`Name`='[value-2]',`E_mail`='[value-3]',`Phone_number`='[value-4]',`Images`='[value-5]',`Gender`='[value-6]',`Password`='[value-7]',`OTP`='[value-8]' WHERE 1
    $path1=$img_value['tmp_name'];       //$path1=$file['tmp_name'];
	$fxn=explode(".",$img_name);
	$len=count($fxn);

	$query="insert into infom(Name,E_mail,Phone_number,Gender,Password) values('$name_value','$email_value','$phone_value','$Gender_value','$class_value')";
	//$query="update 'infom' set 'Name'='$name_value','E_mail'='$email_value','Phone_number'='$phone_value','Gender'='$Gender_value' where 'Password'='$class_value'";
	if(mysqli_query($con_status,$query))
	{
	$id=mysqli_insert_id($con_status);
	echo "id is-".$id;
	$path2="img/$id.".$fxn[$len-1];
	$sql="update infom set Images='$path2' where id=$id";
	if(move_uploaded_file($path1,$path2))
	{
	  echo $path1;
	  echo "<br/>".$path2;
	}
	//header("Location:newuser.php?case=saved");
	echo "data inserted";
	}
	else
	{
echo "not inserted";  
header("Location:err_page.php?eno=101");
	}
}
if(isset($_POST['submit']))
{
	//echo "insert";
	//$id_volumn2=$_POST['hide'];
	$user_id=$_POST['s1'];
	$Password=$_POST['Password1'];
	$pwd="46678";
	//$sql="SELECT en_pwd FROM `new_regis` where email='$profile_id' or id='$profile_id'";
	$query4="SELECT en_pwd FROM `login` where User_id='$user_id' or on_pswd='$Password'";
	//echo"$query4";
	$result=mysqli_query($con_status,$query4);
	if($result)
	{
		$num=mysqli_num_rows($result);
		if($num>0)
		{
			$row=mysqli_fetch_row($result);
			$sys_pwd=$row[0];
			echo $sys_pwd;
			echo "<br/>";
			echo $Password;
			echo "<br/>";
			$user_en_pwd=md5($Password);
			echo $user_en_pwd;
			print_r($row);
			//exit;
			if($user_en_pwd==$sys_pwd)
			{
					header("Location:student_payment.php?case=101");
			}
			else{
			header("Location:page.php?case=102");	
		}	
		}
		else
		{
		
			header("Location:page.php?case=101");
		}
		
		
	}
else
{
	echo "query error-".$sql;
	
}
}
	

	//print_r($result);

	/*if(isset($_POST['nikhil']))
	{
		$email=$_POST['num1'];
		$email_id=$_POST['num1'];
		$query5="insert into g_new(id,ENTER_YOUR_EMAIL) values('$email_id','$email')";
		if(mysqli_query($con_status,$query5))
	{
		header("Location:newuser.php?case=saved");
		echo "data inserted";
		}
		else
		{
			echo "not inserted";  
			header("Location:err_page.php?eno=101");
		}
	}*/


//for ist button i.e(number)
/*if(isset($_POST['a2']))
{
//echo "insert case<br/>";
$id_volumn=$_POST['ram'];
$enterpn_value=$_POST['a1'];
//echo"ram=$id_volumn</br>
//a1=$enterpn_value";
$query1="insert into pas_emp(id,pass_wrd) values('$id_volumn','$enterpn_value')";
if(mysqli_query($con_status,$query1))
	{
		header("Location:jk.php?case=saved");
		echo "data inserted";
		}
		else
		{
			echo "not inserted";  
			header("Location:err_page.php?eno=101");
		}
	}

//for 2nd button i.e(otp)
	if(isset($_POST['c2']))
	{
		$id_volumn1=$_POST['c1'];
		$otp_value=$_POST['otp'];
		$query2="insert into OTP(id,OTP) values('$id_volumn1','$otp_value')";
		if(mysqli_query($con_status,$query2))
		{
			header("Location:newuser.php?case=saved");
			echo "data inserted";
			}
			else
			{
				echo "not inserted";  
				header("Location:err_page.php?eno=101");
			}
	}*/

  if(isset($_POST['r1']))
	 {
	  $rollno=$_POST['txt'];
	  $amount=$_POST['textp'];
	  //echo$amount;
	  $date1=Date('d-M-Y');
	  //echo $date1;
	  $course=$_POST['txt4'];
	  echo "$course";
//exit;
	  $query="insert into fee_payment(Roll_no,Course,Fee,Date) values('$rollno','$course','$amount','$date1')";
	  if(mysqli_query($con_status,$query))
	  {
  header("Location:studentFee.php?case=saved");
		}
		else
 {
		echo "not inserted";
}    
}

	?>
