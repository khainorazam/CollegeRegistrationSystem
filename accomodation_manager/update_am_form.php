<?php session_start();
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");
 ?>

<HEAD><TITLE>Update Accomodation Manager Form</TITLE>
<!-- <link rel="stylesheet" href="../.css/viewstyle.css"> -->
<link rel="stylesheet" href="../.css/styleupdate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</HEAD>
<BODY>

  <ul class="navi">
    <li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
    <li class="navi"><a>College Registration System</a></li>
    <li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
    <li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
    <li class="navi" style="float:right"><a href="#about"><?php echo $_SESSION['USER'] ?></a></li>
  </ul>

<div class="profile-card">
<div class="card-header">
<h2>Update Accomodation Manager Info</h2>
<p>Please fill in the following information:<br><br>

<table class="table2" border="1" cellspacing="0" cellpadding="3">

<!-- Print table heading -->
<thead>
<tr class="header">
<th>Name</th> 
<th>IC</th>
<th>Staff ID</th>

</tr>

		</thead>

		<tbody id ="item">
                   
                
        </tbody>

</tr>
</table>
<script>

document.addEventListener("DOMContentLoaded",function(){
            //step 1
            var xht = new XMLHttpRequest();

            //step 2
            xht.open("GET", "http://localhost/CollegeRegistrationSystem/api/accom", true);

            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    alert(this.responseText);
                    var item = JSON.parse(this.responseText);

                    var content = '';
                    for (let i = 0; i < item.length; i++) {

                        content += "<tr class ='dalam'><td>" + item[i].name + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].staffID + "</td>" ;
                        console.log(item);
                    }
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

<form name="form1">
<table class="update-table" border="0">
    <tr>
        <td><INPUT id="input-box" class="update-box" type="hidden" id="id" size="20" ></td>
    </tr>
	<tr>
        <td><strong>Name: </strong></td>
        <td><INPUT id="input-box" class="update-box" type="text" id="name" size="20" style = "text-transform: uppercase"></td>
    </tr>
    <tr>
        <td><strong>IC: </strong></td>
		<td><INPUT id="input-box" class="update-box" type="text" id="ic" size="15" ></td>
	</tr>
	<tr>
        <td><strong>Staff ID: </strong></td>
		<td><input id="input-box" class="update-box" type="" id="staffID" size="8" style="text-transform:uppercase;"></td>
	</tr>

    <tr>
		<td colspan="2"><br/><input type="submit" id = "update-btn" name="button1" value="Update"></td>
	</tr>
</table>
</form>

<script>
  document.getElementById("update-btn").addEventListener('click',function(e){
    e.preventDefault();
            var xht = new XMLHttpRequest();
            
            var id = document.getElementById("staffID").value;
            var name = document.getElementById("name").value;
            var ic= document.getElementById("ic").value;
            
            xht.open("PUT","http://localhost/CollegeRegistrationSystem/api/updatemanager/" + id,true);
            xht.send();
            
            
            
            
            xht.send(JSON.stringify({
                "name":name,"ic":ic
            }));
            xht.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const objects = JSON.parse(this.responseText);
                    
                }
            };
            location.reload();
            

        });
</script>
</div>
</div>
	</body>
	</html>
