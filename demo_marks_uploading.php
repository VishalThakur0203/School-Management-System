<?php
    $c_status = require_once('connection.php');
    ?>
    
<html>
<head>
   <?php
    require_once("link.php");
    include_once('header.php');
?>
</head>
<?php
echo"<div class='container-fluid'><div class='row' style='margin-top:70px; min-height:600px;'>
";
echo"<div class='col-md-2'>";

include_once("leftpane.php");
echo "</div>";



echo"<div class='col-md-8'>";
?>
<body>

    <?php 

    if (isset($_POST['Select1']) || isset($_POST['edit_marks'])) {
      $class1 = $_POST['class'];
        $sub = $_POST['r1'];
        $section1=$_POST['sec'];
        $ET=$_POST['semester'];
   
        $flag=false;
if(isset($_POST['edit_marks']))
$flag=true;
if($flag==false)
{
        $sql = "select * from marks_upload where Class='$class1' and section='$section1' and subject='$sub' and Exam_type='$ET'";
       //echo $sql;
        //exit;
        $query_result = mysqli_query($con_status, $sql);
    
        $num = mysqli_num_rows($query_result);
    
        if ($num > 0) {
            echo"<h2>Marks Already Uploaded</h2>
            <div class='container'>
            <div class='row'>
            <div class='col-md-12'>
            <form action='demo_marks_uploading.php' method='post'>
            <h4>
<input type='hidden' name='class' value='$class1'/>$class1 |
<input type='hidden' name='sec' value='$section1'/>$section1 |
<input type='hidden' name='r1' value='$sub'/>$sub

&nbsp;&nbsp;&nbsp; <input type='submit' name='edit_marks' value='edit' class='btn btn-info'/>
</h4>
           
            </form>
            
            </div></div><br/>";

        }
    }
    
    
    $case="insert";
    if($flag==true)
    {
        echo "edit case";
        $case="edit";
    }

        $sql = "select Roll_No,name from class_" . $class1 ."";
        $result = mysqli_query($con_status, $sql);

        if ($result) 
        {
          $row_count=mysqli_num_rows($result);
	$col_count=mysqli_num_fields($result); 
echo "<hr/>
  <table><tr>
    <form action='data.php?class=$class1' method='post'>";
     
   echo" <input type='hidden' name='case' value='$case'/>
    ";
            echo "<div class='row'>
            <h1>Marks Upload</h1>
    <div class='col-md-12'>
    <input type='hidden' value='$class1' name='class'>$class1 |<input type='hidden' name='sec' value='$section1'/>$section1 |
    <input type='hidden' value='$sub' name='r1'>$sub |<input type='hidden' value='$ET' name='semester'>$ET
    
    
    </div>
    </div>";
            $sno = 0;
            while ($data = mysqli_fetch_array($result)) {
                 
                $temp = "marks" . $sno;

                $sql2 = "select marks from marks_upload where Class='$class1' and section='$section1' and subject='$sub' and Exam_type='$ET' and Roll_no=$data[0]";
                $query2=mysqli_query($con_status,$sql2);
                $num=mysqli_num_rows($query2);
$temp_marks=0;
if($num>0)
{
    $row2=mysqli_fetch_row($query2);
    $temp_marks=$row2[0];
}
                echo "<div class='row'>
        <div class='col-md-4'><br/>
	 <input type='hidden' class='form-control' name='rollno[]' value=$data[0]/>$data[0]
	 </div>
     <div class='col-md-4'><br/>
     &nbsp;&nbsp;&nbsp;&nbsp;$data[1] <!-- ---sno=$sno  $temp; -->
     </div>
    <div class='col-md-4'><br/>
    <input type='text' name='$temp' class=' form-control' value='$temp_marks' placeholder='Marks'  id='marks' > 
    </div>
    </div>";
                $sno++;
            }

            echo "<input type='hidden' name='stu_count' value=$sno />";
        }
        
        
        echo "<br/>
   
    <center><input type='submit' name='submit1' class='btn btn-info ' style='width: 30%;' Value='Submit' id='submit' ></center>
    ";

        echo "</form>
        </table>
        
        </div>
     </div>";
     
}


    
else {
    echo" <div class='row' style='margin-left:120px;'>
    <center>
    <div class='col-md-6'>
    <div class='panel-heading'>
    <br/>";
        echo "<form action='demo_marks_uploading.php' method='post'>
        <center><h1 style='color:#2ded7a;'>Marks Uploading</h1></center>";
        if(isset($_REQUEST['case']))
        echo"<center><h3>Marks Saved</h3></center>";

        echo" <div class='row'>
        <div class='col-md-12'>
        <div class='panel-heading'>
        <br/>";
    echo"<div class='row' >
    <div class='col-md-12'>
    <select name='class'  class='btn btn-info form-control' id='class' onchange='this.form.submit()'>
    <option value=''disabled selected hidden>Select Class</option>";
    $sql="select distinct class from class_info";
    $result=mysqli_query($con_status,$sql);
    $num=mysqli_num_rows($result);
    $status="";
                  while($data=mysqli_fetch_row($result))
                   {
     if(isset($_POST['class']) && $data[0]==$_POST['class'])
     {
         $status="selected";
         
     }
     else
         $status="";
         
     
                echo "<option value='$data[0]' $status>  $data[0] </option>";
                  }
    echo"</select>
    </div>
    </div>";
        echo "<br/>";
        if(isset($_POST['c']))
		   {$c=$_POST['c'];
		   echo "class=$c";
		   echo "<input type='hidden' name='s1' value='$c'/>";
		   }
           
        echo "<div class='row'>
    <div class='clo-md-12'>
    <select name='sec' class='btn btn-info form-control' id='section'>
    <option value=''disabled selected hidden>Select Section</option>";
    if(isset($_POST['class']))
    {$c=$_POST['class'];
    echo "class=$c";
    
    $sql="select distinct section from class_info where class='$c'";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
    
    while($data1=mysqli_fetch_row($result1))
        {
     echo "<option value='$data1[0]'>  $data1[0] </option>";
       }
    }
   echo" </select>
    </div>
    </div>";
        echo "<br/>";
        echo " <div class='row'>
    <div class='col-md-12'>
    <select name='r1' class='btn btn-info form-control' id='subject' >
    <option value=''disabled selected hidden>Select Subject</option>";
    if(isset($_POST['class']))
    {$c=$_POST['class'];
    //echo "class=$c";
   $sql="select subject from class_info where class='$c'";
   
  // echo "$sql";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);
    
    while($data1=mysqli_fetch_row($result1))
        {

     echo "<option value='$data1[0]'>  $data1[0] </option>";
       }
    
    }
    
    
    echo"</select>
    </div>
    </div>";
    echo "<br/>";
    echo " <div class='row'>
<div class='col-md-12'>
<select name='session' class='btn btn-info form-control' id='session' >
<option value=''disabled selected hidden>Select Session</option>";
if(isset($_POST['class']))
{$c=$_POST['class'];
//echo "class=$c";
$sql="select distinct session from class_info where class='$c'";

// echo "$sql";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);

while($data1=mysqli_fetch_row($result1))
    {

 echo "<option value='$data1[0]'>  $data1[0] </option>";
   }

}



echo"</select>
</div>
</div>";

echo "<br/>";
echo " <div class='row'>
<div class='col-md-12'>
<select name='semester' class='btn btn-info form-control' id='semester' >
<option value=''disabled selected hidden>Select Semester</option>";
if(isset($_POST['class']))
{
    $c=$_POST['class'];
//echo "class=$c";
$sql="select distinct semester from class_info where class='$c'";

// echo "$sql";
$result1=mysqli_query($con_status,$sql);
$num1=mysqli_num_rows($result1);

while($data1=mysqli_fetch_row($result1))
{
echo "<option value='$data1[0]'>  $data1[0] </option>";
}

}


echo"</select>
</div>
</div>";

        echo " <br/>
   <center>
    <input type='submit' name='Select1' class='btn btn-info form-control' Value='Submit' style='width: 20%; color:black;' id='select' >
    </center>
    </form>
    </center>
    ";
    
      echo "</div>
      </div>
      </div>";

      echo"</div>
      </div>
      </div>";
      
        echo "</div>
      ";
        
   echo"</div>";
    }
    ?>
    <?php
   
   include_once('footer.php');
   ?>
</body>
</html>