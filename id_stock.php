<html>
<head>
    <?php
    require_once('link.php');
    require_once('connection.php');
    ?>
</head>

<body>
    <?php include_once('header.php');
    echo" <div class='container-fluid'>
    <div class='row'>
        <div class='col-md-2'>";

        include_once('leftpane.php');
       echo" </div>
        <div class='col-md-10'>"; 
        echo"             <div class='container-fluid' style='margin-top:5%; >
            <div class='row'>
              <div class='col-md-12'>
              <div class='panel'>
          <div class='panel-body'>";
$query = 'SELECT category FROM stock_category';
$result = mysqli_query($con_status, $query);
 
    if(isset($_POST['v1']))
    {
     $_a=$_POST['txt1'];
     //echo"$_a";
     $query="insert into stock_category(category) values('$_a')";
     $result=mysqli_query($con_status,$query);
     if($result)
     {
        echo"success";
     }
     else{
        echo"error";
     }
    }
   else{
    echo"
       <form action='id_stock.php' method='POST'>
      <div class='row'>
      <div class='col-md-3'></div>
        <div class='col-md-9'>
         <h1>Stock Category</h1><br /><br />
       </div>
          </div>

          <div class='row'>
            <div class='col-md-3'></div>
             <div class='col-md-5'>
             Category:
           </div>
        </div>
         <div class='row'>
       <div class='col-md-3'></div>
            <div class='col-md-5'>
            <input type='text' name='txt1' class='form-control'>
       </div>
        </div><br><br>
       
           <div class='row'>
           <div class='col-md-4'></div>
            <div class='col-md-8'>
          <input type='submit' value='Submit' name='v1' class='btn btn-info'>
      <input type='reset' value='Reset' class='btn btn-info'>
         </div>
        </div>
       </form>";
       echo"
        </div>
           </div>
                </div></div></div></div></div></div>
                    ";
        }
?>
    <?php include_once('footer.php'); ?>
</body>
</html>



