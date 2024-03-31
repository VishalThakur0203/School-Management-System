
<?php
require_once("connection.php");
require_once("phpqrcode/qrlib.php");
if(isset($_POST['sub1']))
{
    $name_value=$_POST['text1'];
    $phone_value=$_POST['text2'];
    $email_value=$_POST['text3'];
    $leave_start_value=$_POST['text4'];
    $leave_end_value=$_POST['text5'];
    $leave_type_value=$_POST['text6'];
    $Days_value=$_POST['text7'];
    $reason_value=$_POST['text8'];
	$status = 0;
  
    $query="insert into teacher_leave_ap(Name,Phone_number,Email,Leave_start_date,Leave_end_date,Leave_type,How_many_days,Give_Reason_for_vacation,status) values('$name_value','$phone_value','$email_value','$leave_start_value','$leave_end_value','$leave_type_value','$Days_value','$reason_value','$status')";
    if(mysqli_query($con_status,$query))
	{
        
        header("location:Tchr_leave.php?case=saved");
            
        }
        else
        echo"not inserted";
}

if (isset($_POST['approved']) || isset($_POST['reject'])) 
{
    $id = $_POST['id']; 
    $Day_value = $_POST['text9'];
    $reaso_value = $_POST['text10'];
	//$status = 0;
    if (isset($_POST['approved'])) 
    {
        $sql = "update teacher_leave_ap SET status='1' WHERE id ='$id'";
     }
    elseif (isset($_POST['reject'])) 
    {
        $sql = "update teacher_leave_ap SET status='-1' WHERE id ='$id'";
    } 
     if (mysqli_query($con_status, $sql)) 
    {
        header("location:view.php?case=saved");
    } 
    else 
    echo "Error updating record";
}


/*if (isset($_POST['approved']) || isset($_POST['reject'])) 
{
    $id = $_POST['id']; 
    $Day_value = $_POST['text9'];
    $reaso_value = $_POST['text10'];

    if (isset($_POST['approved'])) 
    {
        $sql = "update teacher_leave_ap SET Aproved='1', Rejected=NULL WHERE id ='$id'";
    } 
    elseif (isset($_POST['reject'])) 
    {
        $sql = "update teacher_leave_ap SET Rejected='-1', Aproved=NULL WHERE id ='$id'";
    }

    if (mysqli_query($con_status, $sql)) 
    {
        header("location:view.php?case=saved");
    } 
    else 
    {
        echo "Error updating record";
    }
}*/


/*if(isset($_POST['sub3']))
{
    $name_value=$_POST['texta'];
    $email_value=$_POST['textb'];
    $phone_number_value=$_POST['textc'];
    $student_id=$_POST['textd'];
    $class=$_POST['texte'];
    $session=$_POST['textf'];
    $Fee=$_POST['textg'];
    $query="insert into student_fee(student_name,E_mail,phone_number,Student_id,class,Session,fees) values('$name_value','$email_value','$phone_number_value',' $student_id','$class',' $session','$Fee')";
    if(mysqli_query($con_status,$query))
	{
        
        header("location:studentFee.php?case=saved");
            
        }
        else
        echo"not inserted";
}*/
if(isset($_POST['sub4']))
{
    $id=$_POST['txt3'];
    $Admission_value=$_POST['txt'];
    $Examination_value=$_POST['txt1'];
    $Transport_value=$_POST['txt2'];
    
    $query="insert into upate_fee(Admission_Fee,Examination_Fee,Transport_Fee) values('$Admission_value','$Examination_value','$Transport_value')";
    //$query="update upate_fee set Admission_Fee where id='$id'";
    if(mysqli_query($con_status,$query))
	{
        header("location:studentFee.php?case=saved");
            echo"saved";
        }
        else
        echo"not inserted";
    }

if (isset($_POST['pay'])) {
   $Session = $_POST['session'];
    $sql = "insert into student_payment(Session, Course, Admission_fee, Examination_fee, Tuition_fee, Transportation_Fee, Fee_type,TotalAmount) VALUES ";
    for ($r=0;$r < count($_POST['class']); $r++) 
    {
   $class = $_POST['class'][$r];
     $admission_fee = $_POST['admission_fee'][$r];
     $exam_fee = $_POST['exam_fee'][$r];
   $tuition_fee = $_POST['tuition_fee'][$r];
  $trans_fee = $_POST['trans_fee'][$r];
    $Fee_Type = $_POST['Fee_Type'][$r];
   //$TotalAmount=$trans_fee + $tuition_fee;
    $sql.= "('$Session','$class','$admission_fee','$exam_fee','$tuition_fee','$trans_fee','$Fee_Type','$TotalAmount')";
     if ($r < count($_POST['class']) - 1)
    $sql.= ",";
     header("location:student_payment.php?saved");
    }
    $c_status = mysqli_query($con_status, $sql);
    }
    ?>

    <?php
    if (isset($_POST['submit1'])) {
    $rollno_list = $_POST['rollno'];
    $sub = $_POST['r1'];
    $count1 = $_POST['stu_count'];
    $class = $_POST['class'];
    $section=$_POST['sec'];
    $ET=$_POST['semester'];
    $status = array();
    for ($i = 0; $i < $count1; $i++) {
        $temp = "marks" . $i;
       
        $status[$i] = $_POST[$temp];
    }
    
    $marks_status = array();
    for ($i = 0; $i < $count1; $i++) {
   


        $sql = "select * from marks_upload where Class='$class' and section='$section' and subject='$sub' and Exam_type='$ET' and Roll_No=" . $rollno_list[$i];
        

        $result = mysqli_query($cnt, $sql);
        $num = mysqli_num_rows($result);
        
        $case=$_POST['case'];

        if ($case == "insert") {

            $query = "insert into marks_upload(Class,Roll_No,section,subject,Exam_type,marks) values
    ('" . $class . "'," . $rollno_list[$i] . ",'" . $section . "','" . $sub . "','". $ET ."'," . $status[$i] . ")";


            if (mysqli_query($cnt, $query))
            header("Location:demo_marks_uploading.php?case=saved");//$marks_status[$i] = $rollno_list[$i] . "= done";
            else
                $marks_status[$i] = $rollno_list[$i] . "=marks not updated,check query-" . $query;
        } else {

        $query="update marks_upload set marks='$status[$i]'  where class='$class' and Roll_no='$rollno_list[$i]' and subject='$sub'";

        if (mysqli_query($cnt, $query))
        $marks_status[$i] = $rollno_list[$i] . "=marks updated ";
        else
        $marks_status[$i] = $rollno_list[$i] . "=marks not updated,check query-" . $query;

                
        }
    }
        
    for ($i = 0; $i < count($marks_status); $i++) {
        echo $marks_status[$i] . "<br/>";
    }
}









//Ankita's data page



 if(isset($_POST['g_s']))
{
	$class_cnt=$_POST['class_cnt'];
    $class_name=$_POST['class_name'];
	$class_size=$_POST['class_size'];
    //print_r($class_cnt);	 
    //print_r($class_name);	 
	//print_r($class_size);	 
 $count=count($class_cnt);
    //echo $count;
 for($i=0;$i<$count;$i++)
 {
	 $temp_name=$class_name[$i];
	 
	 $temp_class_cnt=$class_cnt[$i];
	 
	 $temp_class_size=$class_size[$i];
	

	$size=0;
//echo "<br/>";
$sql="";
	 if($temp_class_cnt>$temp_class_size)
	 {
		 $total_section=$temp_class_cnt/$temp_class_size;
		 $temp1="".$total_section;
		 $temp1=explode(".",$temp1);
		 $len=count($temp1);
		 if($len>1)
			 $total_section=$temp1[0]+1;
		 
		 //echo "<b>$total_section  ----<b/>";
		 $section=array("A","B","C","D","E","F");
		 for($s=0;$s<$total_section;$s++)
		 {
			 
			 if($s<$total_section-1)
				 $size=$temp_class_size;
			 else{
				 $temp=$temp_class_size *$s;
				 $size=$temp_class_cnt-$temp;
				 
				 }
			 $section_v=$section[$s];
			 
			 $offset=$s*$size;
			 $sql1="select id from std_reg where class='$temp_name' limit $offset,$size";
			 $query1=mysqli_query($con_status,$sql1);
			 
			 $section_roll_list=array();
			 $sno=0;
			 while($slist=mysqli_fetch_array($query1))
			 {
				 $section_roll_list[$sno]=$slist[0];
				 $sno++;
				 $sql3="update std_reg set section='$section_v' where id=$slist[0]";
				 mysqli_query($con_status,$sql3);
				 
				 
			 }
			 
			 $new_s_list=implode("/",$section_roll_list);
			 




			 
			$sql= "insert into class_section(class,class_size,section,stu_rollno_list) values('$temp_name',$size,'$section_v','$new_s_list')";
			//echo "$sql<br/>";

	 $result=mysqli_query($con_status,$sql);
	 if($result)
	 {
		 echo" inserted--->$sql";
	 }
	 else
	 {
		 echo"query error $sql";
	 }



		 }
	 

	 }
	 else 
	 {	 
 //$size=$temp_class_cnt;
 $size=$temp_class_cnt;
 
 			 $sql1="select id from std_reg where class='$temp_name' limit $offset,$size";
			 $query1=mysqli_query($con_status,$sql1);
			 
			 $section_roll_list=array();
			 $sno=0;
			 while($slist=mysqli_fetch_array($query1))
			 {
				 $section_roll_list[$sno]=$slist[0];
				 $sno++;
				 $sql3="update std_reg set section='$section_v' where id=$slist[0]";
				 mysqli_query($con_status,$sql3);
				 
				 
			 }

 	 $new_s_list=implode("/",$section_roll_list);
		
 
 	 $sql= "insert into class_section(class,class_size,section,stu_rollno_list) values('$temp_name',$size,'A','$new_s_list')";
        
		echo $size."<br/>";

	 }
	 
	 $result=mysqli_query($con_status,$sql);
	 if($result)
	 {
		 echo" inserted--->$sql";
	 }
	 else
	 {
		 echo"query error $sql";
	 }
	 
	  
 }
 /*$result=mysqli_query($con_status,$sql);
	 if($result)
	 {
		 echo" inserted";
	 }
	 else
	 {
		 echo"query error $sql";
	 }
 */
	 
}

else if(isset($_POST['std_reg']))
{
	$class=$_POST['class'];
	$session=$_POST['session'];
	$name=$_POST['n1'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];
	$email=$_POST['email'];
	$pno=$_POST['pno'];
	$s_address=$_POST['s_address'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$country=$_POST['country'];
	$pincode=$_POST['pincode'];
    $pic=$_FILES['pic'];
    $address=$s_address."&nbsp;,&nbsp;".$city."&nbsp;,&nbsp;".$state."&nbsp;,&nbsp;".$country."&nbsp;,&nbsp;".$pincode;

    $path1=$_FILES['pic']['tmp_name'];
    $temp=explode(".",$pic['name']);
    $count=count($temp);

	$query1="insert into std_reg(class,session,name,gender,dob,email,phno,address)
	values('$class','$session','$name','$gender','$dob','$email','$pno','$address')";
	//echo"$query1";
	if(mysqli_query($con_status,$query1))
	 {
        $id=mysqli_insert_id($con_status);
        $path2="pictures/$id.".$temp[$count-1];
        if(move_uploaded_file($path1,$path2))
        {
            $sql="update std_reg set pic='$path2' where id=$id";
            if(mysqli_query($con_status,$sql))
            {
                echo"success";
            }
            else
            echo"error";
        }
     }
		else
			echo "upload error";
    }

else if(isset($_POST['std_syllabus']))
{
    $class = $_POST['clss']; 
    $subject = $_POST['subject'];
    $sub_code = $_POST['sub_code'];
    $session = $_POST['session'];
    $syllabus = $_FILES['syllabus'];
    
    $path1 = $syllabus['tmp_name']; 
    $temp = explode(".", $syllabus['name']);
    $count = count($temp);
    

    $sql1 = "SELECT * FROM std_syllabus WHERE class='$class' AND subject='$subject'";
    $result = mysqli_query($con_status, $sql1);
    $num = mysqli_num_rows($result);
    if($num > 0)
    {
        echo "Data already exists"; 
    }
    else
    {
        $sql = "INSERT INTO std_syllabus (class, subject, sub_code, session) VALUES ('$class', '$subject', '$sub_code', '$session')";
        $result = mysqli_query($con_status, $sql);
        if($result)
        {
            $id = mysqli_insert_id($con_status);
            $path2 = "syllabus/$id.".$temp[$count - 1];
            
            if(move_uploaded_file($path1, $path2))
            {
                $sql = "UPDATE std_syllabus SET syllabus='$path2' WHERE id=$id";
                
                if(mysqli_query($con_status, $sql))
                    echo "Syllabus uploaded successfully";
                else
                    echo "Error updating syllabus in the database";   
            }
            else
                echo "Error uploading syllabus file";
        }
        else
            echo "Error executing SQL query";
    }
}

else if(isset($_POST['upload']))
{ 
    $class=$_POST['clss'];
	//$assign=$_POST['assign'];
	$section=$_POST['section'];
	$subject=$_POST['subject'];
	$title=$_POST['title'];
	$sub_date=$_POST['dte'];
	$assign_file=$_FILES['assign_file1'];
	
	$path1=$_FILES['assign_file1']['tmp_name'];
	$temp=explode(".",$assign_file['name']);
	$count=count($temp);
	
	$sql="insert into assign_upload(class,section,subject,title,sub_date)values('$class','$section','$subject','$title','$sub_date')";
	//echo"$query<br/>";
	//exit;
	$result=mysqli_query($con_status,$sql);
	if($result)
	{
		$id=mysqli_insert_id($con_status);
		$path2="assignments/$id.".$temp[$count-1];
		if(move_uploaded_file($path1,$path2))
		{

		$sql="update assign_upload set assign='$path2' where tid=$id";
		if(mysqli_query($con_status,$sql))
		echo"success";
		else
		echo "update query error";	
		}
		else
			echo " uploading error ";
	}
	else
		echo"query error/connection error";
}

else if(isset($_POST['submit']))
{ 
    $name=$_POST['name1'];
	$email=$_POST['email1'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];
	$mob_no=$_POST['mob_no'];
	$org=$_POST['a'];
	$year=$_POST['b'];
	$sql="insert into personal_info(name,email_id,gender,dob,mobile_no)values('$name','$email','$gender','$dob','$mob_no')";
	$result=mysqli_query($con_status,$sql);
	$tid=0;
	if($result)
	{
		$tid=mysqli_insert_id($con_status);
		//echo"success";
		$sql2="insert into experience(tid,organisation,exp_year) values";
	    for($i=0;$i<count($org);$i++)
		{
			$sql2.="($tid,'".$org[$i]."','".$year[$i]."')";
			if($i<count($org)-1)
			$sql2.=",";
		}
	$status=mysqli_query($con_status,$sql2);
	if(!$status)
	{
		echo $sql2;
	}
	else
	{
		echo" saved";
	}
	
	}
	else
	{
		echo"error";
	}
	
	
	
	
	
	
	
	//$org=$_POST['a'];
	//$year=$_POST['b'];
	//print_r($org);
	//print_r($year);

	}
	
	
function myupload($file,$file_no,$col_name,$id)
{
	$path1=$file['tmp_name'];
	$file_exp=explode(".",$file['name']);
	$count=count($file_exp);
	$path2="f".$file_no."/$id.".$file_exp[$count-1];
	
	move_uploaded_file($path1,$path2);
	$str="$col_name='".$path2."'";
     return $str;	
}

if(!empty($_POST['dc']))
{
    $Receipt = $_POST['receipt'];
    $Student_name = $_POST['student_name'];
    $course =$_POST['course'];
    $section =$_POST['section'];
     $paid=$_POST['paid'];
  $query="insert into dc(Receipt,student_name,course,section,paid) values('$Receipt','$Student_name','$course',' $section','$paid')";
  if(mysqli_query($con_status,$query))
  {
	$id=mysqli_insert_id($con_status);
      header("location:newdemo.php?case=saved");
          
      }
      else
      echo"not inserted";
    }



	//include_once("link.php");
	//include_once("header.php");
	if (isset($_POST['add_stock'])) {
		$pidValues = $_POST['pid'];
		$quantityValues = $_POST['sno'];
		$p_type = $_POST['p_type'];
	
		for ($i = 0; $i < count($p_type); $i++) {
			$pid = $pidValues[0];
			$quantity = $quantityValues[$i];
			$ptype =($p_type[$i]); 
	
			$query = "INSERT INTO product_info (pid, product_name, serial_no) VALUES ('$pid', '$ptype', '$quantity')";
			$result = mysqli_query($con_status, $query);
	
			$lastInsertId = mysqli_insert_id($con_status);
	//print_r($p_type);
	//exit;
			$updateCopy = 0;
	
			if (strcasecmp($ptype, 'laptop') === 0) 
			{
				$updateCopy = 2;
			} elseif (strcasecmp($ptype, 'desk') === 0) 
			{
				$updateCopy = 1;
			} elseif (strcasecmp($ptype, 'computer') === 0) 
			{
				$updateCopy = 4;
			}
			elseif (strcasecmp($ptype, 'lecturestand') === 0) 
			{
				$updateCopy = 1;
			}
			elseif(strcasecmp($p_type,'books')==0)
			{
				$updateCopy=1;

			}

			$updateQuery = "UPDATE product_info SET copy = '$updateCopy' WHERE id = $lastInsertId";
			mysqli_query($con_status, $updateQuery);
	
			if ($result) {
				$path = 'images/';
				$query = "SELECT id, serial_no FROM product_info WHERE id = $lastInsertId";
				$result = mysqli_query($con_status, $query);
	
				if ($result) {
					while ($row = mysqli_fetch_array($result)) 
					{
						$id = $row['id'];
						echo "Your id-->"; print_r($id);
						$date = date('d,M,Y');
						$qrcode = $path . "qr_" . $id . ".png";
						QRcode::png("$id$date", $qrcode, 'H', 4, 4);
						echo "<img src='" . $qrcode . "'><br>";
					}
				}
			} else 
			{
				echo "Error";
			}
		}
	}
	
?>	
	







    
   


