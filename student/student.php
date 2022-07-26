<?php session_start();
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");
 ?>
<html>
	<head>
		<title>Student Page</title>
    <link rel="stylesheet" href="../.css/menu_style.css">
	</head>
	<body>


		<div class="menu-main-container">
			<ul class="navi">
				<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
				<!-- Dropdown hover -->
					<li class="navi"><a>College Registration System</a></li>
				<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
				<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
				<li class="navi" style="float:right"><a href="#about"><?php echo $_SESSION['USER'] ?></a></li>
			</ul>
			<h2 class="menu-title">Student page</h2>

		<div class="menu-container one">

			<div class="menu-item apply">
				<a href="../college/college_form.php"><img class="menu-item-image" src="../.css/image/College.svg" alt="Add"></a>
				<p class="menu-item-title">Apply College</p>
			</div>

			<div class="menu-item update">
				<a href="update_student_form.php"><img class="menu-item-image" src="../.css/image/Update user.svg" alt="Edit"></a>
				<p class="menu-item-title">Update My Data</p>
			</div>


		</div>

		<div class="menu-container two">

			<div class="menu-item view">
				<a href="view_application.php"><img class="menu-item-image" src="../.css/image/View user.svg" alt="View"></a>
				<p class="menu-item-title">View My <br>Application</p>
			</div>

		</div>

		</div>









	<!-- <h1>Student page</h1>

    <a href="../college/college_form.php">Apply College</a> <br/><br/>

	<a href="view_application.php">View Application</a> <br/><br/>

	<a href="update_student_form.php">Update My information</a> <br/><br/>

	<a href="../main.php">Go Back</a> <br/><br/> -->

	</body>
	</html>
