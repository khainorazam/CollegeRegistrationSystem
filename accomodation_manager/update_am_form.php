<?php session_start();
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");
 ?>

<HEAD><TITLE>Update Accomodation Manager Form</TITLE>
<link rel="stylesheet" href="../.css/styleupdate.css">
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

<?php
    

    //var_dump($_SESSION);

    if ($_SESSION['LEVEL'] == '2'){
        require_once("config.php");
        $store = "SELECT * FROM AccomodationManager WHERE staffID = '{$_SESSION['STAFFID']}';";

        $result = mysqli_query($conn, $store)->fetch_assoc();
        $id = $result['id'];
        $name = $result['name'];
        $ic = $result['ic'];
        $matric = $result['staffID'];
    }

    if ($_SESSION['LEVEL'] == '1'){
        if (isset($_GET['name'])) {
            require_once("config.php");
            $store = "SELECT * FROM AccomodationManager WHERE staffID = '{$_GET['name']}';";

            $result = mysqli_query($conn, $store)->fetch_assoc();
			$id = $result['id'];
			$name = $result['name'];
			$ic = $result['ic'];
			$matric = $result['staffID'];
        }
    }



?>

<script>

function validate()
{
  if( document.form1.amName.value == "" )
   {
     alert( "Please provide your name!" );
     document.form1.amName.focus() ;
     return false;
   }

   var x = document.form1.amIC.value;

   if( x == "" )
   {
     alert( "Please provide your IC number!" );
     document.form1.amIC.focus() ;
     return false;
   }

	if (typeof x!=='number' && (x%1)!==0 )
 	{
	  alert("Please enter a correct format of the IC number!");
		document.form1.amIC.focus();
		return false;
 	}


   if( document.form1.amID.value == "" )
   {
     alert( "Please provide your staffID number!" );
     document.form1.amID.focus() ;
     return false;
   }
}

</script>

<form name="form1" method="POST" action="update_am.php" onsubmit="return validate() & alert('New data has been updated !');">
<table class="update-table" border="0">
    <tr>
        <td><INPUT id="input-box" class="update-box" type="hidden" name="id" size="20" value="<?php echo $id?>"></td>
    </tr>
	<tr>
        <td><strong>Name: </strong></td>
        <td><INPUT id="input-box" class="update-box" type="text" name="amName" size="20" value="<?php echo $name?> " style = "text-transform: uppercase"></td>
    </tr>
    <tr>
        <td><strong>IC: </strong></td>
		<td><INPUT id="input-box" class="update-box" type="text" name="amIC" size="15" value="<?php echo $ic?>"></td>
	</tr>
	<tr>
        <td><strong>Staff ID: </strong></td>
		<td><input id="input-box" class="update-box" type="" name="amID" size="8" style="text-transform:uppercase;" value="<?php echo $matric?>"></td>
	</tr>

    <tr>
		<td colspan="2"><br/><input type="submit" id = "update-btn" name="button1" value="Update"></td>
	</tr>
</table>
</form>
</div>
</div>
	</body>
	</html>
