<!DOCTYPE html PUBLIC-//W3C//DTD XHTML 1.0 Transitional//EN"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Manage Students Manage Couses Ma</title>
</head>

<body>

<div align="justify" style="width:1000px;">

	<div>
		<div>
			<img alt="rmshead" height="120" src="newhd.png" width="950" /></div>
		<div style="width:1000px; height:20px;border-radius:5px;border:solid; border-color:navy;">
			Welcome !!!</div>
		<div style="border-style: solid; border-color: navy; border-width: medium; float:left; width:232px; font-size:small; ">
		<ul>
			<li><a href="RMS_index.php?std"><strong>Manage Students</strong></a><ul><?php
if(isset($_GET['std'])){

// input records 
		echo '<li><a  target="_new" href="regstudents.php">Register Student</a></li>';
		echo '<li><a  target="_new" href="editstudent.php" >Edit Students</a></li>';

		
}		

 ?>
	</ul>	</li>
			<li><a href="RMS_index.php?course"><strong>
			Manage Couses</strong></a>
			<ul><?php
if(isset($_GET['course'])){

// input records 
		echo '<li><a href="coursereg.php"  target="_new">Register Courses</a></li>';
		echo '<li><a href="updatecourse.php"  target="_new">Edit Courses</a></li>';

		
}		

 ?>
	</ul>	
			</li>
			
			<li><a href="RMS_index.php?score"><span ><strong>Input Scores</strong></a>
		<ul><?php
if(isset($_GET['score'])){

// input records 
		echo '<li><a href="enterresult.php"  target="_new">HND/ND Records</a></li>';
		echo '<li><a href="enterresultphnd.php"  target="_new">PREHND Records</a></li>';
		echo '<li><a href="enterresultpgd.php"  target="_new">PGD Records</a></li>';
		
}		

 ?>
	</ul>	</li>
			<li><a href="RMS_index.php?edit">Edit Scores</a>
			<ul><?php
if(isset($_GET['edit'])){

// input records 
		echo '<li><a href="editresults.php"  target="_new">Edit HND/ND Records</a></li>';
		echo '<li><a href="editresultsphnd.php"  target="_new">Edit PREHND Records</a></li>';
		echo '<li><a href="editresultspgd.php"  target="_new">Edit PGD Records</a></li>';
		
}		

 ?>
	</ul>	
			</li>
			<li><a href="RMS_index.php?print">Print Results</a>
			<ul><?php
if(isset($_GET['print'])){

// input records 
		echo '<li><a href="viewabm.php"  target="_new">HND/ND(Academic Board)</a></li>';
		echo '<li><a href="views.php"  target="_new">HND/ND(Notice Board)</a></li>';
		echo '<li><a href="viewabmphnd.php"  target="_new">PREHND(Academic Board)</a></li>';
		echo '<li><a href="viewsphnd.php"  target="_new">PREHND(Notice Board)</a></li>';
		echo '<li><a href="viewabmpgd.php"  target="_new">PGD(Academic Board)</a></li>';
		echo '<li><a href="viewspgd.php"  target="_new">PGD(Notice Board)</a></li>';
}		

 ?>
	</ul>	
			</li>
			<li><a href="RMS_index.php?attend">Mark and Attendance</a>
			<ul><?php
if(isset($_GET['attend'])){

// input records 
		echo '<li><a href="scoresheet.php"  target="_new">With Practical Col.</a></li>';
		echo '<li><a href="scoresheet2.php"  target="_new">Without Practical Col.</a></li>';
}		

 ?>
	</ul>	
			</li>
			<li><a href="analysis.php">Analysis</a></li>
			
			<li><a href="manuallist.php">Manual List</a></li>
			<li><a href="RMS_index.php?gradlist">Graduation List</a>
			<ul><?php
if(isset($_GET['gradlist'])){

// input records 
		echo '<li><a href="grad.php?id=3"  target="_new">3 Semester Graduation List</a></li>';
		echo '<li><a href="grad.php?id=6"  target="_new">6 Semester Graduation List</a></li>';
}		

 ?>
	</ul>	
	
			</li>
			<li><a href="RMS_index.php?user">Manage Users</a><ul><?php
if(isset($_GET['user'])){

// input records 
		echo '<li><a href="adduser.php"  target="_new">Add New User</a></li>';
		echo '<li><a href="edituser.php"  target="_new">Edit User</a></li>';
}		

 ?>
	</ul>	
			</li>
			<li><a href="backups2.php">Records Backup</a></li>
			<li><a href="#">Exit</a></li>
			
			
			</ul>
		</div>
	</div>
</div>

</body>

</html>
