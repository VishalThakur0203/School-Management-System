<html>
    <head>
  </head>
    <script>
    function get()
    {
    var num=getElementById("userId").value;
    if(num=="")
    {
document.getElementById("gtm").innerHTML="*Please fill Phone number";
        return false;
    }
    
    if(is_nan(num))
    {
        document.getElementById("gtm").innerHTML="*Please enter digits";
        return false;
    }
    }
        </script>
    <body>
        <?php
    $msg="";
    if(isset($_REQUEST['case']))
    {
        $caseno=$_REQUEST['case'];
        switch($caseno)
        {
            case 101:$msg="User not found"; break;
            case 102:$msg="Password Miss Match"; break;
        }
        
    }
        ?>
 
<?php
  echo"<html>
  <head>
  <style>
  form{
    margin-top:180px;
  }
  </style>
  </head>
  <body>
      <div class='container'>
          <div class='row justify-content-center'>
              <div class='col-md-6'>
                  <form action='process.php' method='post' style='min-height:900px;'>
                      <div class='form-group'>
                          <label for='userid'>UserId:</label>
                          <input type='text' id='userid' name='s1' class='form-control'>
                      </div>
  
                      <div class='form-group'>
                          <input type='hidden' name='hide'>
                      </div>
  <br/>
                      <div class='form-group'>
                          <label for='password'>Password:</label>
                          <input type='password' id='password' name='Password1' class='form-control'><b ><font color='red'>$msg</font></b>
                      </div>
  <br/>
                      <div class='form-group text-right'>
                          <a href='newuser.php'>New user</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='forget.php'>Forget Password</a>
                      </div>
  <br/><br/>
                      <div class='text-center'>
                          <input type='submit' name='submit' value='Login' class='btn btn-primary'>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  
      <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
      <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
  </body>
  
  </html>
  
    
";   
   ?>
   </body>
   </html>
 

