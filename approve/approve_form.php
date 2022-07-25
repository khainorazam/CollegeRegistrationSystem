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

<?php
		 $ID = $_GET["ID"];

		 require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     // Retrieve data from database
		 $sql="SELECT * FROM student WHERE id= '{$ID}'";
		 $result = mysqli_query($conn, $sql);
		 //var_dump(mysqli_fetch_assoc($result));

			 $rows=mysqli_fetch_assoc($result);

?>


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

<tr>
<!-- <td></td> -->
<td align="center"><?php echo $rows['name']; ?></td>
<td align="center"><?php echo $rows['ic']; ?></td>
<td align="center"><?php echo $rows['matric']; ?></td>
<td align="center"><?php echo $rows['college']; ?></td>
<td align="center" name="approve-accept-btn"><input type="image" name="approve-submit" src="../.css/image/check-solid.svg" ></td>
<td align="center" name="approve-reject-btn"><a href="reject_student.php?id=<?php echo urlencode($rows['id']) ?>&ic=<?php
echo urlencode($rows['ic']) ?>&matric=<?php
echo urlencode($rows['matric']) ?>&name=<?php
echo urlencode($rows['name']) ?>&college=<?php
echo urlencode($rows['college']) ?>" role="button" onClick="alert('Approval status updated ')" target=""><img src="../.css/image/times-solid.svg" width="25x" height="25px"></a></td>
</tr>

</table>

<td align="center"><input name="id" type="hidden" id="id" value="<?php echo $rows['id']; ?>"></td>
<td align="center"><input name="name" type="hidden" id="name" size="30" value="<?php echo $rows['name']; ?>"></td>
<td align="center"><input name="ic" type="hidden" id="ic" size="15" value="<?php echo $rows['ic']; ?>"></td>
<td align="center"><input name="matric" type="hidden" id="matric"  size="15" value="<?php echo $rows['matric']; ?>"></td>
<td align="center"><input name="college" type="hidden" id="college"  size="15" value="<?php echo $rows['college']; ?>"></td>

</form>
</div>
</div>

<iframe name="hiddenFrame" class="hide"></iframe>
</body>
</html>

<?php

	     mysqli_close($conn);

?>
