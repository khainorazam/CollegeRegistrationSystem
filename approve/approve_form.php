<?php
session_start();

?>
	<html>
	<head><title>Approving Student Data</title>
	<link rel="stylesheet" href="../.css/styles_approve.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<head>
	<body>
  <div class="approve-main-container">

		<ul class="navi">
			<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
			<!-- Dropdown hover -->
				<li class="navi"><a>College Registration System</a></li>
			<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
			<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
			<li class="navi" style="float:right"><a href="#about"><?php echo $_SESSION['USER'] ?></a></li>
		</ul>


	<div class="approve-student-page">

	<div class = "approve-header"><h1>Approve Student Data Form</h1></div>

<!-- <?php
		 $ID = $_GET["ID"];

		 require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     // Retrieve data from database
		 $sql="SELECT * FROM student WHERE id= '{$ID}'";
		 $result = mysqli_query($conn, $sql);
		 //var_dump(mysqli_fetch_assoc($result));

			 $rows=mysqli_fetch_assoc($result);

?> -->


<form name="form1" method="post" action="approve_student.php" onsubmit=" alert('Approval status updated !');" target="">
<table name ="table-approve" id="tableapprove" border="0" cellspacing="5" cellpadding="0">

<tr>
<!-- <td align="center" name="hide-approve">&nbsp;</td> -->
<td align="center"><strong>Name</strong></td>
<td align="center"><strong>IC</strong></td>
<td align="center"><strong>Matric</strong></td>
<td align="center"><strong>College</strong></td>
<td align="center" colspan="2"><strong>Action</td>
</tr>


</thead>
                <tbody id ="item">
                   
                
                </tbody>

<!-- <tr>
<!-- <td></td> -->
<!-- <td align="center"><?php echo $rows['name']; ?></td>
<td align="center"><?php echo $rows['ic']; ?></td>
<td align="center"><?php echo $rows['matric']; ?></td>
<td align="center"><?php echo $rows['college']; ?></td> -->
<!-- <td align="center" name="approve-accept-btn"><input type="image" name="approve-submit" src="../.css/image/check-solid.svg" ></td>
<td align="center" name="approve-reject-btn">
	<a href="reject_student.php?id=<?php echo urlencode($rows['id']) ?>&ic=<?php
echo urlencode($rows['ic']) ?>&matric=<?php
echo urlencode($rows['matric']) ?>&name=<?php
echo urlencode($rows['name']) ?>&college=<?php
echo urlencode($rows['college']) ?>" 
role="button" onClick="alert('Approval status updated ')" target=""><img src="../.css/image/times-solid.svg" width="25x" height="25px"></a></td> -->
<!-- </tr> --> -->

</table>

<!-- <td align="center"><input name="id" type="hidden" id="id" value="<?php echo $rows['id']; ?>"></td>
<td align="center"><input name="name" type="hidden" id="name" size="30" value="<?php echo $rows['name']; ?>"></td>
<td align="center"><input name="ic" type="hidden" id="ic" size="15" value="<?php echo $rows['ic']; ?>"></td>
<td align="center"><input name="matric" type="hidden" id="matric"  size="15" value="<?php echo $rows['matric']; ?>"></td>
<td align="center"><input name="college" type="hidden" id="college"  size="15" value="<?php echo $rows['college']; ?>"></td> -->

</form>
</div>
</div>

<script>


document.addEventListener("DOMContentLoaded",function(){
            //step 1
            var xht = new XMLHttpRequest();

			<?php
				 $ID = $_GET["ID"];
			 ?> 

            //step 2
            xht.open("GET", "http://localhost/CollegeRegistrationSystem/api/students_apprej_list/" + $ID, true);
			
            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    alert(this.responseText);
                    
                    var item = JSON.parse(this.responseText);

                    var content = '';
                    
                        content += "<tr><td>" + item[i].id + "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].college + "</td>"
						+ "<td align="center" name="approve-accept-btn"><input type="image" name="approve-submit" src="../.css/image/check-solid.svg" ></td>" + 
						"<<td align="center" name="approve-reject-btn"><a href="reject_student.php?id=<?php echo urlencode($rows['id']) ?>&ic=<?php
echo urlencode($rows['ic']) ?>&matric=<?php
echo urlencode($rows['matric']) ?>&name=<?php
echo urlencode($rows['name']) ?>&college=<?php
echo urlencode($rows['college']) ?>" role="button" onClick="alert('Approval status updated ')" target=""><img src="../.css/image/times-solid.svg" width="25x" height="25px"></a></td>";
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


document.getElementById("submit").addEventListener('click',function(e){
    e.preventDefault();
            var xht = new XMLHttpRequest();
            
            var id = document.getElementById("id").value;
            var bn = document.getElementById("bn").value;
            var cn= document.getElementById("cn").value;
            var iid = document.getElementById("iid").value;
            var desc = document.getElementById("desc").value;
            var cat = document.getElementById("cat").value;
            var sp = document.getElementById("sp").value;
            var bp = document.getElementById("bp").value;
            
            alert(id);
            xht.open("PUT","http://localhost/thewhoa/api/bid/" + id,true);
            xht.send();
            
            
            
            
            xht.send(JSON.stringify({
                "biddername":bn,"contactnum":cn,
                "mybidprice":bp,"itemid":iid,
                "description":desc,
                "category":cat,"startprice":sp
            }));
            xht.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const objects = JSON.parse(this.responseText);
                    
                }
            };
            location.reload();
            

        });
   

</script>

<iframe name="hiddenFrame" class="hide"></iframe>
</body>
</html>


