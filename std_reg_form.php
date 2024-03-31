<?php
require_once("connection.php");
?>
<html>
<head>

    
<script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
  
<?php
include_once("link.php");
 
	 require_once("mylinkfile.php");    
	   ?>  
   <script>
  $(document).ready(function()
  {
  $('#registration').validate(
  
  { rules:
	  { 	class:
		  { required:true,
		  
		  }
		  ,
		  session:
		  { required:true,
		  
		  }
		  ,
		  pic:
		  {
			required:true,
		  }
		 ,
		 n1:
		 {
			required:true,
		 }
  ,
  gender:   
  {
	required:true,

  }
  ,
  dob:   
  {
	required:true,

  }
  ,
  email:
  {
	required:true,
  }
  ,
  pno:
  {
	required:true,
  }
  ,
  s_address:
  {
	required:true,
  }
  ,city :
  {
	required:true,
  }
  ,
  state :
  {
	required:true,
  }
  ,
	
	
		}
	  }
	);
  }
  );
</script>

<?php
include_once('header.php');
echo"
<div class='container-fluid'>
<div class='row' >
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");

echo"
</div>
<div class='col-md-10'>
<div class='panel panel-info'>
<div class='panel-heading'>";
//require_once("calender1.php");
echo"
<center><h2>Student Registration Form</h2></center></div><br/>";
echo"
<div class='panel-body'>
<!--row 1-->
<form action='data.php' method='post' id='registration' enctype='multipart/form-data'  >
<h4>Enrollment</h4>
<div class='row'><br/>
<div class='col-md-3'><b>class</b></div>
<div class='col-md-3'>
<select name='class' class='form-control'>
<option value=''>select class</option>
<option value='9th'>9th</option>
<option value='10th'>10th</option>
<option value='11th'>11th</option>
<option value='12th'>12th</option>
</select>
</div>
<div class='col-md-3'><b>session</b></div>
<div class='col-md-3'><input type='text'  name='session' value='2023-24' class='form-control'/></div>
</div>
<hr/>
<h4>Personal Info</h4>
<!--<div class='row'><br/>
<div class='col-md-3'><b>Upload Your Picture</b></div>
<div class='col-md-3'><input type='file' name='pic' class='form-control'/></div>
</div><br/>-->
<div class='row'><br/>
<div class='col-md-3'><b>Name</b></div>
<div class='col-md-3'><input type='text' placeholder='First Name' name='n1' class='form-control'/></div>
<div class='col-md-3'><input type='text' placeholder='Middle Name' name='n[]' class='form-control'/></div>
<div class='col-md-3'><input type='text' placeholder='Last Name' name='n[]' class='form-control'/></div>
</div><br/>
<!--row 2-->
<div class='row'><br/>
<div class='col-md-3'><b>Gender</b></div>
<div class='col-md-3'>
<input type='radio' name='gender' value='male'/>Male
<input type='radio' name='gender'checked value='female'/>Female
</div><br/>
<div class='col-md-3'><b>Date of birth</b></div>
<div class='col-md-3'><input type='date' name='dob' class='form-control'/></div>
</div>
<hr/>
<!--row3-->
<h4>Contact Information</h4>
<div class='row'><br/>
<div class='col-md-3'><b>Email Id</b></div>
<div class='col-md-3'>
<input type='text' name='email' class='form-control'/></div>
<div class='col-md-3'><b>Mobile Number</b></div>
<div class='col-md-3'><input type='text' name='pno' class='form-control'/></div>
</div>
<hr/>
<h4>Address</h4>
<div class='row'><br/>
<div class='col-md-12'><input type='text' placeholder='Street Address' name='s_address' class='form-control'/></div>
</div><br/>
<div class='row'><br/>
<div class='col-md-6'><input type='text' placeholder='City' name='city' class='form-control'/></div>
<div class='col-md-6'><input type='text' placeholder='State' name='state' class='form-control'/></div>
</div><br/>
<div class='row'><br/>
<div class='col-md-6'><input type='text' placeholder='Country' name='country' class='form-control'/></div>
<div class='col-md-6'><input type='text' placeholder='PIN code' name='pincode' class='form-control'/></div>
</div>

<hr/>
<h4>Documents</h4>
<div class='row'><br/>
<div class='col-md-3'><b>Upload Your Picture</b></div>
<div class='col-md-3'><input type='file' name='pic' class='form-control'/></div>
<div class='col-md-3'><b>Upload Aadhaar Card</b></div>
<div class='col-md-3'><input type='file' name='adhar' class='form-control'/></div>
</div></br>

<hr/>
<!--submit row-->
<div class='row'><br/><br/><br/>
<div class='col-md-4'></div>
<div class='col-md-2'>
<input type='reset' name='reset' value='Reset' class='btn btn-info'/></div>
<div class='col-md-2'>
<input type='submit' name='std_reg' value='Submit' class='btn btn-info'/></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>";
include_once("footer.php");
?>


</body>

</html>