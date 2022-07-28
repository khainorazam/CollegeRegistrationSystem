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
<th>ID</th>
<th>Name</th> 
<th>IC</th>
<th>Staff ID</th>

</tr>

		</thead>

		<tbody id ="item">
                   
                
        </tbody>

</tr>
</table>


<form name="form1" id = "updateform" method="POST" >
<table class="update-table" border="0">
    <tr>
        <td><strong>ID: </strong></td>
        <td><INPUT id="id" class="update-box" type="text"  size="20"></td>
    </tr>
	<tr>
        <td><strong>Name: </strong></td>
        <td><INPUT id="name" class="update-box" type="text" size="20" style = "text-transform: uppercase"></td>
    </tr>
    <tr>
        <td><strong>IC: </strong></td>
		<td><INPUT id="ic" class="update-box" type="text"  size="15" ></td>
	</tr>
	<tr>
        <td><strong>Staff ID: </strong></td>
		<td><input id="staffID" class="update-box" type="" size="8" style="text-transform:uppercase;"></td>
	</tr>

    <tr>
		<td colspan="2"><br/><button type="submit" id ="update-btn">Update</button>
        <!-- <input type="submit" id = "update-btn" name="button1" value="Update"></td> -->
	</tr>
</table>
</form>

<script>

document.addEventListener("DOMContentLoaded",function(){
            //step 1
            var xht = new XMLHttpRequest();

            //step 2
            xht.open("GET", "http://localhost/CollegeRegistrationSystem/api/accom", true);

            //step 3
            xht.send();

            // xht.onreadystatechange = function(){
            //     if(this.readyState == 4 && this.status == 200){
            //         for (let i = 0; i < item.length; i++) {
            //     document.getElementById("id").innerHTML = item[i].id;
            //     document.getElementById("name").value = item[i].name;
            //     document.getElementById("ic").value = item[i].ic;
            //     document.getElementById("staffID").value = item[i].staffID;
            // }
            //     }

            //     //step 4, with status == 404
            //     else if(this.readyState == 4 && this.status == 404){
            //         alert(this.status + ' resource not found');
            //     }
            // };


            
            // //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    alert(this.responseText);
                    var item = JSON.parse(this.responseText);

                    var content = '';
                    for (let i = 0; i < item.length; i++) {

                        content += "<tr class ='dalam'><td>" + item[i].id + "</td>" + "<td>" + item[i].name + "</td>" +"<td>" + item[i].ic + "</td>" + "<td>" + item[i].staffID + "</td>" ;
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

form1.addEventListener("submit",function(e){
    e.preventDefault();
    // alert("hello");
    // const data = new FormData(form1);

    var id = document.getElementById("id").value;
    var staffid = document.getElementById("staffID").value;
    var name = document.getElementById("name").value;
    var ic= document.getElementById("ic").value;

    alert(id);
    alert(name);
    alert(ic);
    var xht = new XMLHttpRequest();

    xht.open("PUT","http://localhost/CollegeRegistrationSystem/api/updatemanager/" + id + "/" + staffid + "/" + name + "/" + ic,true);
    xht.send();
            
            xht.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const objects = JSON.parse(this.responseText);
                    
                }
            };
    location.reload();

})

//   var el = document.getElementById("submit");
//   if (el){
//     alert("hello");
//     addEventListener('click',function(e){
//     e.preventDefault();
//             const formdata = new FormData(document.getElementById("updateform"));
//             var xht = new XMLHttpRequest();
            
            
//             var id = document.getElementById("staffID").value;
//             var name = document.getElementById("name").value;
//             var ic= document.getElementById("ic").value;

//             alert(id);
//             xht.open("PUT","http://localhost/CollegeRegistrationSystem/api/updatemanager/" + id + "/" + name + "/" + ic,true);
            
            
//             xht.send(formdata);
//             xht.onreadystatechange = function () {
//                 if (this.readyState == 4 && this.status == 200) {
//                     const objects = JSON.parse(this.responseText);
                    
//                 }
//             };
//             location.reload();
            

//         });
//     }
</script>
</div>
</div>
	</body>
	</html>


