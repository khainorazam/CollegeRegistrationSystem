<?php
session_start();
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php"); ?>

<HTML>
<HEAD>
   <TITLE>Accomodation Manager List</TITLE>
   <link rel="stylesheet" href="../.css/viewstyle.css">
<HEAD>
<BODY>
<?php

	     $studentName = $_POST["amName"];
	     $studentIC = $_POST["amIC"];
	     $studentMatric = $_POST["amID"];
  		 $ID = $_POST["id"];

	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     $sql = "UPDATE accomodationmanager SET name = '$studentName', ic = '$studentIC', staffID = '$studentMatric' WHERE id = '$ID'" ;

	     if (mysqli_query($conn, $sql)) {
			echo '<ul class="navi">';
				echo '<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>';
				//<!-- Dropdown hover -->
				echo '<li class="navi"><a>College Registration System</a></li>';
				echo '<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>';
				echo '<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>';
				echo '<li class="navi" style="float:right"><a href="#about">';
				echo $_SESSION['USER'];
				echo '</a></li>';
			echo '</ul>';


			echo '<div class="parent">';
			echo '<div class="div2">';
			echo '<h1 class="tajuk">View Accommodation Managers Details</h1>';
			echo'</div>';

   			echo '<div class="div1">';


			   echo '<TABLE class="table3" BORDER="1" width="600" cellspacing="0" cellpadding="3">';

			   echo '<TR class="header"><TH>No</TH><TH>Accomodation Manager Name</TH><TH>Staff ID</TH><TH>IC Number</TH></TR>';
      
        
         $sql2 = "SELECT * FROM AccomodationManager";
         $result = mysqli_query($conn, $sql2);

     	 if (mysqli_num_rows($result) > 0) {
     	 // output data of each row
     	 while($row = mysqli_fetch_assoc($result)) {
     	 echo "<TR class=dalam>\n";
            echo "<TD align=left>", $row["id"], "</TD>",
                  "<TD align=left>", $row["name"], "</TD>",
                  "<TD>",    $row["staffID"],"</TD>",
                  "<TD>", $row["ic"], "</TD>\n";
            echo "</TR>\n";
     	 }
    	 } else {
     	 echo "0 results";
     	 }

        mysqli_close($conn);
      

		echo '</TABLE>';
		echo '</div>';
		echo '</div>';

			 }

			else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
          mysqli_close($conn);



  ?>
