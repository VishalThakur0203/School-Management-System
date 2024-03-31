<html>
  <head>
 
<?php
  require_once("link.php");  
    ?>
 
    
 <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
  


<?php  
    require_once("mylinkfile.php");    
     ?>  
 <script>
$(document).ready(function()
{
$('#leave').validate(

{ rules:
    { 	text1:
        { required:true,
		
        }
        ,
      text2:
        { required:true,
          minlength:10
      }
,
text3:
        { required:true,
         
        }
,
text4:
        { required:true
        }
,
text5:
        { required:true
        }
,
text6:
        { required:true
        }
,
text7:
        { required:true
        }
        ,
        text8:
        { required:true
        }


        

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

echo"
<div class='container-fluid'>
<div class='row'>
<div class='col-md-2'><br/><br/><br/>";
include_once("leftpane.php");
echo"
</div>
<div class='col-md-10'>
 <div class='container-fluid'  style='margin-top:5%;  font-family:'Poppins', Arial, sans-serif;'>
            <div class='row '>
            <div class='col-md-12'>
           <div class='panel'>
           <div class='panel-body'>
         <form action='data.php' method='post' id='leave'>

         <div class='row'>
          <div class='col-md-3'></div><div class='col-md-9'>
            <h1>Leave Application Form</h1><br/><br/>
           </div></div>
          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          Full Name:<input type='text' class='form-control' placeholder='Enter name' style='width:100%;' name='text1'>
          </div></div><br>

          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          Phone Number:<input type='text'class='form-control' style='width:100%;' name='text2'>
          </div></div></br>


         <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          E-Mail:<input type='text'class='form-control' placeholder='Enter email'style='width:100%;' name='text3'>
          </div></div></br>


          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          Leave Start Date:<input type='date'class='form-control' style='width:100%;' name='text4'>
          </div></div></br>


          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          Leave End Date:<input type='date'class='form-control' style='width:100%;' name='text5'>
          </div></div></br>

          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          Leave Type:<select class='form-control' style='width:100%;' name='text6' >
          <option value='sick-leave'>Sick Leave</option>
          <option value='vacation-leave'>Vacation Leave</option>
          <option value='personal-leave'>Personal Leave</option>
          <option value='other'>Other</option>
      </select>
          </div></div></br>

          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          Number of Days:<input type='number'class='form-control' style='width:100%;' name='text7'>
         </div></div></br></br>
          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          Reason for Leave:
          </div></div>
          <div class='row'>
          <div class='col-md-3' ></div><div class='col-md-5'>
          <textarea  name='text8' rows='4'  class='form-control'></textarea>
          </div></div><br><br>

          

          <div class='row'>
          <div class='col-md-4' ></div><div class='col-md-8'>
          <input type='submit' value='submit' name='sub1' class='btn btn-info'>
          <input type='reset' value='reset'  class='btn btn-info'>
          <a type='button' class='btn btn-info' href='view.php'>View</a>
</div></div>

</form> 
</div>
 </div>
 </div>
 </div>
 </div></div></div></div>
 </html>

";
?>
<?php

?>

<?php
include_once("footer.php");
?>

</body>
</html>



