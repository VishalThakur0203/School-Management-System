
<?php
require_once("connection.php");
?>
<!DOCTYPE html>
<html>
<head>

<style>
  b{
    margin:0 0 0 100px;
  }
  </style>

<?php
include_once("link.php");
require_once("mylinkfile.php");
?>
<link href="" rel='stylesheet'/>
<script>
$(document).ready(function()
{
$('#loginform').validate(

{ rules:
    { 	subject:
        { required:true,
		
        }
        ,
        title:
        { required:true,
            minlength:6
        },
		assign_file1:
        { required:true,
            
        },
		dte:
        { required:true,
            
        },
		

       

      }
    }
  );
}
);
</script>
</head>
<body>
<?php
include_once("header.php");
echo"<br/><br/>";
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>
<div class='container'>

<div class='panel-heading'></div><br/>
<div class='panel-body'>";
echo"<div class='row' style=' margin:0 0 0 350px; font-size:30px;'>
<div class='col-md-12'>
<label>Class Syllabus</label>
</div></div>
<br>";
if(isset($_REQUEST['case']))
{
	$id=$_REQUEST['case'];
	echo "<h4><b>Data Already Exist......</b></h4>";
}

echo"
<form action='data.php' method='post' id='loginform' enctype='multipart/form-data'>
<div class='row'>
<div class='col-md-3'><b>Class:</b></div>
<div class='col-md-5'>
<input type='text' name='clss' class='form-control'/>
</div><br/><br/><br/>
</div>
<!--
<div class='row'><br/>
<div class='col-md-3'><b>Section:</b></div>
<div class='col-md-5'>
<Select name='section' class='form-control'>
<option value='A'>A</option>
<option value='B'>B</option>
<option value='C'>C</option>
</Select>
</div>
</div>-->
<div class='row'>
<div class='col-md-3'><b>Subject:</b></div>
<div class='col-md-5'><input type='text' name='subject' class='form-control'/></div>
</div><br/>
<div class='row'><br/>
<div class='col-md-3'><b>Subject Code:</b></div>
<div class='col-md-5'><input type='text' name='sub_code' class='form-control'/></div>
</div><br/><br/>
<div class='row'>
<div class='col-md-3'><b>Syllabus:</b></div>
<div class='col-md-5'><input type='file' name='syllabus' class='form-control'/></div><br/><br/><br/>
</div><div class='row'><br/><br/>
<div class='col-md-3'><b>Session:</b></div>
<div class='col-md-5'><input type='text' name='session' class='form-control'/></div>
</div><br/>
<div class='row'><br/>
<div class='col-md-3'></div>
<div class='col-md-5'>
<input type='submit' name='std_syllabus' value='upload_syllabus' class='btn btn-info'/>
<input type='reset' name='reset' value='reset' class='btn btn-info'/>


</div>
</div>
</div>
</div>
</div>
</div>
</div></div></div>
<br/>";



?>
<?php
include_once("footer.php");
?>

</body>
</html>