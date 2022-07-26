<?php
session_start(); // Start up your PHP Session

//echo $_SESSION["Login"]; //for session tracking purpose, can delete
//echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");

if ($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 2) {   //only user with access level 1 and 2 can view

?>

	<html>
	<head>
		<title>Viewing Student Data</title>
		<link rel="stylesheet" href="../.css/viewstyle.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<head>
	<body>
		<ul class="navi">
    	<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
    	<!-- Dropdown hover -->
      <li class="navi"><a>College Registration System</a></li>
    	<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
    	<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
    	<li class="navi" style="float:right"><a href="#about"><?php echo $_SESSION['USER'] ?></a></li>
    </ul>

	<div class="parent">

		<div class="div2">
		<h1 class="tajuk">View Student Details</h1>
		</div>

	<div class="div1">


	

	<!-- Search field -->
	<form name="form1" method ="POST" action="view_search.php">

			<input class="search-box" type="text" name="studentMatric" placeholder="Insert Matric Number" size="30">
			<button type="submit"<i class="fa fa-search" class="button2" ></i></button>

	</form>

	<!-- Start table tag -->
	<table class="table2" width="600" border="1" cellspacing="0" cellpadding="3">

	<!-- Print table heading -->
	<thead>
	<tr class="header">
	<th >No</th>
	<th >Name</th> <!--Student table-->
	<th >IC</th>
	<th >Matric</th>
	<th >Application Status</th>

	<?php if ($_SESSION["LEVEL"] == 1) {?> <!--Application Manager and Admin edit report-->
	<th >Update</th>
	<th >Delete</th>
	<?php } ?>

	</tr>
	</thead>
	<tbody id ="item">
                   
                
    </tbody>
	
	<?php if ($_SESSION["LEVEL"] == '1') {?>
			<!--only user with access level 1 can view update and delete button-->
			<!-- <td class="dalam2" align="center"> <a href="../student/update_student_form.php" target="_blank"><img src="../.css/image/Update user.svg" alt="Update Icon" style="width:42px;height:42px;"></a> </td>
			<td class="dalam2" align="center"> <a href="../student/delete_student_form.php" target="_blank"><img src="../.css/image/delete.svg" alt="Delete Icon" style="width:42px;height:42px;"></a> </td> -->
			<td align="center" > <a href="../student/update_student_form.php?name=<?php echo urlencode($rows['matric'])?>" target="_blank"><img src="../.css/image/Update user.svg" alt="Update Icon" style="width:42px;height:42px;"></a></td>
			<td align="center" > <a href="../student/delete_student_form.php?name=<?php echo urlencode($rows['matric'])?>" target="_blank" ><img src="../.css/image/delete.svg" alt="Delete Icon" style="width:42px;height:42px;"></a> </td>
		</tr>


		<?php }
	}
	?>

	</table>

	

	<br><br>
	<!-- <a href="../student/view_student.php">Click here to view all applications</a> <br/><br/> -->


	

		</div>
	</div>

	<script>
document.addEventListener("DOMContentLoaded",function(){
            //step 1
            var xht = new XMLHttpRequest();
			

            //step 2
            xht.open("GET", "http://localhost/CollegeRegistrationSystem/api/student_detail_list/",	true);
		
            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    alert(this.responseText);
                    var item = JSON.parse(this.responseText);

                    

						if(item[i].college == null){
							item[i].college = "N/A";
						}

						if (item[i].approvalstatus == '1'){
							item[i].approvalstatus = "Approved";
						}
						else if(item[i].approvalstatus == '0'){
							item[i].approvalstatus = "Pending";
						}
						else{
							item[i].approvalstatus = "Rejected";
						}


						content += "<tr class ='dalam'><td>" + [i + 1]+ "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].college + "</td>" + "<td>" 
						+ item[i].approvalstatus + "</td>";
						console.log(item);
					
                    document.getElementById("item").innerHTML = content;
                }

                //step 4, with status == 404
                else if(this.readyState == 4 && this.status == 404){
                    alert(this.status + ' resource not found');
                }
            };
        }
    )	
</script>


	</body>
	</html>
