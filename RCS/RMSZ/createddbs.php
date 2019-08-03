<?php 
if (isset($_GET['upload']))
{	
	?>
	<table class="table table-bordered">
	<tr>
	<td align="center">
	<?php include("idexcreate.php");
	
	echo "You are about to import a backup file, <br> <b>Note:</b> <i style='color:red'>This will overwrite the existing records.</i><br> Do you wish to continue importing?<br/>";
	echo "<a href='createddbs.php?yes'>".
	"<button class='btn btn-gradient-primary mr-2'>Yes</button>".
	"</a>".
	"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	"<a href='createddbs.php?no'>"."<button class='btn btn-gradient-primary mr-2'>Cancel</button>".
	"</a>";
	?>
	</td>
	</tr>
	<table>
	<?php 
}
elseif(isset($_GET['yes']))
{
	?>
	<?php include("includes/header.php");
$dbname = $database_logs;
	// create db 
	$createdb = mysqli_query($conn,"CREATE DATABASE `$dbname` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
	if ($conn)
	{
		// drop database
		$drop = mysqli_query($conn,"DROP DATABASE $dbname"); 
		$createdb = mysqli_query($conn,"CREATE DATABASE `$dbname` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");

		//  Table structure for table `colleges`

		$colleges = mysqli_query($conn,"DROP TABLE IF EXISTS `colleges`");
		$colleges1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `colleges` (
		`college_id` int(11) NOT NULL AUTO_INCREMENT,
		`college` text NOT NULL,
		`collegecode` varchar(10) NOT NULL,
		PRIMARY KEY (`college_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1");

		// -- Table structure for table `coresult`

		$coresult= mysqli_query($conn,"DROP TABLE IF EXISTS `coresult`");
		$coresult1= mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `coresult` (
		`sn` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(60) NOT NULL,
		`matric_no` char(255) NOT NULL,
		`code` varchar(10) NOT NULL,
		`unit` int(11) NOT NULL,
		`score` varchar(5) NOT NULL,
		`grade` varchar(5) NOT NULL,
		`points` varchar(10) NOT NULL,
		`programme` varchar(255) NOT NULL,
		`semester` varchar(255) NOT NULL,
		`session` varchar(255) NOT NULL,
		`stat` int(1) NOT NULL,
		`year` int(11) NOT NULL,
		PRIMARY KEY (`sn`),
		UNIQUE KEY `matric_no` (`matric_no`,`code`,`semester`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1");

		//Table structure for table `course`

		$course= mysqli_query($conn,"DROP TABLE IF EXISTS `course`");
		$course1= mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `course` (
		`sn` int(11) NOT NULL AUTO_INCREMENT,
		`prog_id` varchar(255) NOT NULL,
		`unit` int(2) NOT NULL,
		`semester` int(2) NOT NULL,
		`code` varchar(255) NOT NULL,
		`title` varchar(255) NOT NULL,
		`sessions` varchar(40) NOT NULL,
		`staff_id` int(11) NOT NULL,
		PRIMARY KEY (`sn`),
		UNIQUE KEY `Programme` (`prog_id`,`semester`,`code`,`sessions`)
		) ENGINE=InnoDB AUTO_INCREMENT=769 DEFAULT CHARSET=latin1");

		//Table structure for table `departments`

		$departments= mysqli_query($conn,"DROP TABLE IF EXISTS `departments`");
		$departments1= mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `departments` (
		`dept_id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(255) NOT NULL,
		`code` varchar(20) NOT NULL,
		`schl_id` int(11) NOT NULL,
		PRIMARY KEY (`dept_id`),
		UNIQUE KEY `name` (`name`) USING BTREE
		) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1");

		//Table structure for table `entered`

		$entered = mysqli_query($conn,"DROP TABLE IF EXISTS `entered`");
		$entered1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `entered` (
		`sn` int(11) NOT NULL AUTO_INCREMENT,
		`code` varchar(10) NOT NULL,
		`unit` int(11) NOT NULL,
		`prog_id` varchar(255) NOT NULL,
		`semester` varchar(255) NOT NULL,
		`session` varchar(255) NOT NULL,
		PRIMARY KEY (`sn`)
		) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=latin1");

		//Table structure for table `logintbl`

		$logintbl = mysqli_query($conn,"DROP TABLE IF EXISTS `logintbl`");
		$logintbl1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `logintbl` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`username` varchar(255) NOT NULL,
		`password` varchar(2810) NOT NULL,
		`progs` varchar(255) NOT NULL,
		`t_user` int(11) NOT NULL,
		`status` varchar(11) NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE KEY `username` (`username`,`password`)
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1");

		//Table structure for table `programmes`

		$programmes = mysqli_query($conn,"DROP TABLE IF EXISTS `programmes`");
		$programmes1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `programmes` (
		`prog_id` int(11) NOT NULL AUTO_INCREMENT,
		`programme` varchar(255) NOT NULL,
		`dept_id` int(11) NOT NULL,
		PRIMARY KEY (`prog_id`),
		UNIQUE KEY `dep` (`programme`)
		) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1");

		// Table structure for table `results`

		$results = mysqli_query($conn,"DROP TABLE IF EXISTS `results`");
		$results1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `results` (
		`sn` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(60) NOT NULL,
		`matric_no` char(255) NOT NULL,
		`code` varchar(10) NOT NULL,
		`unit` int(11) NOT NULL,
		`score` varchar(5) NOT NULL,
		`grade` varchar(5) NOT NULL,
		`points` varchar(10) NOT NULL,
		`prog_id` varchar(255) NOT NULL,
		`semester` varchar(255) NOT NULL,
		`session` varchar(255) NOT NULL,
		`stat` int(1) NOT NULL,
		PRIMARY KEY (`sn`),
		UNIQUE KEY `matric_no` (`matric_no`,`code`,`semester`)
		) ENGINE=InnoDB AUTO_INCREMENT=22760 DEFAULT CHARSET=latin1");

		//Table structure for table `schools`

		$schools = mysqli_query($conn,"DROP TABLE IF EXISTS `schools`");
		$schools1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `schools` (
		`schl_id` int(11) NOT NULL AUTO_INCREMENT,
		`school` text NOT NULL,
		`schoolcode` varchar(10) NOT NULL,
		`college_id` int(11) NOT NULL,
		PRIMARY KEY (`schl_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1");

		//Table structure for table `session`

		$session = mysqli_query($conn,"DROP TABLE IF EXISTS `session`");
		$session1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `session` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`session` varchar(100) NOT NULL,
		`semester` varchar(100) NOT NULL,
		`status` varchar(100) NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1");

		//Table structure for table `staff`

		$staff = mysqli_query($conn,"DROP TABLE IF EXISTS `staff`");
		$staff1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `staff` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`names` varchar(100) NOT NULL,
		`number` varchar(50) NOT NULL,
		`contact` varchar(15) NOT NULL,
		`dept_id` int(11) NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE KEY `number` (`number`)
		) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1");

		//Table structure for table `studentsnm`

		$studentsnm = mysqli_query($conn,"DROP TABLE IF EXISTS `studentsnm`");
		$studentsnm1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `studentsnm` (
		`sn` int(11) NOT NULL AUTO_INCREMENT,
		`names` varchar(255) NOT NULL,
		`matno` varchar(255) NOT NULL,
		`prog_id` varchar(255) NOT NULL,
		`year` int(11) NOT NULL,
		`images` varchar(255) NOT NULL,
		`session` varchar(255) NOT NULL,
		`status` int(1) NOT NULL,
		`stat` int(1) NOT NULL,
		`Withdrwan` int(1) NOT NULL,
		`sex` varchar(2) NOT NULL,
		UNIQUE KEY `sn` (`sn`),
		UNIQUE KEY `matno` (`matno`)
		) ENGINE=InnoDB AUTO_INCREMENT=2039 DEFAULT CHARSET=latin1");


		//Table structure for table `students_log`

		$students_log = mysqli_query($conn,"DROP TABLE IF EXISTS `students_log`");
		$students_log1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `students_log` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`matric_no` varchar(100) NOT NULL,
		`password` varchar(20000) NOT NULL,
		`status` varchar(30) NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE KEY `matric_no` (`matric_no`)
		) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1");


		//Table structure for table `usertype`

		$usertype = mysqli_query($conn,"DROP TABLE IF EXISTS `usertype`");
		$usertype1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `usertype` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`type` varchar(100) NOT NULL,
		`status` varchar(50) NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1");

		// prompt 
		echo "<br><br><br><br><br><br><br><br> <table align='center' border='1' bordercolor = 'sky blue'><tr><td  align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Database Creation Succesful<br > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click Ok To complete Upload&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>";
		echo "</td></tr><tr><td align='right' bgcolor='#D6D6D6'><br><a href = 'backups.php'><button> &nbsp;&nbsp; Ok  &nbsp;&nbsp;</button></a> &nbsp;&nbsp;&nbsp;&nbsp;<br><br></td></tr></table>";
	}
}elseif(isset($_GET['no']))
{
	header('location:index.php');
	
}?>