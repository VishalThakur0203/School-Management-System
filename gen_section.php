<?php
require_once("connection.php");
?>
<html>
<head>
<?php
include_once("link.php");
?>
<script>
function gen_sec()
{


	var total_class=document.getElementById('total_class').value;
	for(var i=1;i<total_class;i++)
	{
		var class_cnt="class_cnt_"+i;
		var class_cnt_value=parseInt(document.getElementById(class_cnt).value);
		var class_name="class_name_"+i;
		var class_name_value=document.getElementById(class_name).value;
	    var class_size="class_size_"+i;
		var class_size_value=parseInt(document.getElementById(class_size).value);

	    var section="section_"+i;
	    var section_v="section_v_"+i;

		var total_section=class_cnt_value/class_size_value;
		var temp1=""+class_cnt_value/class_size_value;
		var temp=temp1.split(".");
	
	//if(temp.length>1)total_section++;
	
	//	var total_section=""+total_section;
		//var temp1=""+total_section;
		//temp1=temp1.split(".");
		if(temp.length>1)
			total_section=parseInt(temp[0])+1;
	var section_list="";
	
for(j=0;j<=total_section;j++)
{var t="";
	switch(j)
	{
		case 1:t="A";break;
	    case 2:t="B";break;
	    case 3:t="C";break;
	    case 4:t="D";break;
	    case 5:t="E";break;
	}
	section_list +=t;
	if(j>0&&j<total_section)
	section_list +="/";
}
	document.getElementById(section).innerHTML=total_section;	
	document.getElementById(section_v).innerHTML=section_list;	
		

/*	var section_temp="";
for(var i=1;i<total_section;i++)
{
	var t="";
	switch(i)
	{
		case 1:t="A";break;
				case 2:t="B";break;
						case 3:t="C";break;
								case 4:t="D";break;
										case 5:t="E";break;
	}
	section_temp  +=t;
	if(i<total_section-1)
	section_temp +="/";
}	
total_section=section_temp;
	*/
	//document.getElementById(section_v).innerHTML=total_section;			
//	alert(total_section);
	//total_section=Math.round(total_section);
//	alert(class_cnt+"="+class_cnt_value+"\n"+class_name+"="+class_name_value+"\n"+class_size+"="+class_size_value+"\n total section="+total_section);
	}
	//var class_name_value=document.getElementsByName("class_name").value;
	//var class_size_value=document.getElementsByName("class_size").value;
	//for(var i=0;i<
	//var len=class_cnt_value.length;
//	alert(total_class);
	/*
	var b=document.getElementbyId('g_sec').value;
	alert(a);
	alert(b);
	*/
	
	//$temp="section_".$class_no;
	return false;
	
}
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
<div class='col-md-10'>";
		 echo"<div class='container'>
		      <div class='row'>
			  <div class col-md-2><center><h3>Generate section</h3></div></center>";
		 
		 $query="SELECT COUNT(id), class FROM std_reg GROUP BY class ";
		 $query_result=mysqli_query($con_status,$query);
		 if($query_result)
		 {
			 
			$row_count=mysqli_num_rows($query_result);
			$col_count=mysqli_num_fields($query_result);
			//echo "$row_count<br/>";
			//echo "col_count=.$col_count"; 			
			if($row_count>0)
			{
				echo "<table class='table'>";
				echo "<tr>";
				for($i=0;$i<$col_count;$i++)
				{
					$temp=mysqli_fetch_field($query_result);
			
					$col_name=$temp->name;
					echo "<th>$col_name</th>";
				}
					echo "<th>class Size</th>";
					echo "<th>No.of sections</th>";
					echo "<th>sections</th>";

				echo "</tr>";
$class_no=1;
echo "<form action='data.php' method='post' >";

			while($row_data=mysqli_fetch_array($query_result))
			{
				echo "<tr>";
//				for($i=0;$i<$col_count;$i++)
        $temp="class_cnt_".$class_no;
			echo "<td>
			<input type='hidden' id='$temp' name='class_cnt[]' value='$row_data[0]'/>".$row_data[0]."</td>";
        $temp="class_name_".$class_no;
	        echo "<td><input type='hidden' id='$temp' name='class_name[]' value='$row_data[1]'/>".$row_data[1]."</td>";
        $temp="class_size_".$class_no;
			echo "<td><select id='$temp' name='class_size[]'>";
			//$section=$_POST['total_section'];
			
			for($i=5;$i<60; $i+=5)
			echo "<option value=$i>$i</option>";
            $temp="section_".$class_no;
			
			echo "</select></td>
			  
			<td><label id='$temp' name='a_$temp'></label></td>";
            $temp="section_v_".$class_no;
			$section="2";
			
			
			echo "<td><label id='$temp' name='section_v[]'></label></td>";
			
			echo "</tr>";
				$class_no++;
				
				}
				echo"<tr>";
			echo "<input type='hidden' id='total_class' name='total_class' value='$class_no'/>$class_no";
			echo"<td></td><td></td><td></td>";
			echo "<td><input type='button' onclick='return gen_sec()' value='calculate'/></td>
			<td><input type='submit' name='g_s' /></td></tr></table></form>";
			//echo "<input type='submit'/></form>";
				
			
			}
			else
			{
				echo "data not found";
			}
			
		 }
		 
		 else
		 {
		 echo "query error";
		 }
		
		echo"</div>
		     </div>
			 </div>
		     </div>
			 </div>
		     </div><br/><br/>";

			

include_once("footer.php");
?>
</body>

</html>