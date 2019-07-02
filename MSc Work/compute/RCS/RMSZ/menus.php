<?php 

// Input Result Menu
		if(isset($_GET['entresbyc'])){
		echo '<h3>Score Sheet</h3>';
		include('enterresultbycourse.php');
		
		}elseif(isset($_GET['entrespgd'])){
		echo '<h3>Score Sheet</h3>';
		include('enterresultpgd.php');

		}elseif(isset($_GET['entresphnd'])){
		echo '<h3>Score Sheet</h3>';
		include('enterresultphnd.php');
		
		}elseif(isset($_GET['entres'])){
		echo '<h3>Score Sheet</h3>';
		include('enterresult.php');
		
		}elseif(isset($_GET['ress'])){
		echo '<h3>Input Scores</h3>';
		include('enterresultsnew.php');

		}elseif(isset($_GET['csv'])){
		echo '<h3>Upload Scores</h3>';
		include('csvres.php');
		
//Student Registration Menu

		}elseif(isset($_GET['regs'])){
		echo '<h3>Register New Student</h3>';
		include('regstudents.php');
		
		}elseif(isset($_GET['edits'])){
		echo '<h3>Edit Students Record</h3>';
		include('editstudent.php');
		
		}elseif(isset($_GET['csvn'])){
		echo '<h3>Upload Students Record</h3>';
		include('csvnames.php');

// Course Registration Menu

		}elseif(isset($_GET['courser'])){
		echo '<h3>Course Registration</h3>';

		include('coursereg.php');


		}elseif(isset($_GET['updtcourse'])){

		echo '<h3>Edit Courses</h3>';

		include('updatecourse.php');


		}elseif(isset($_GET['csvc'])){

		echo '<h3>Import Courses</h3>';

		include('csvcourses.php');

// Edit Result Menu

		}elseif(isset($_GET['editres'])){

		echo '<h3>Edit Result</h3>';

		include('editresults.php');
		
		
		}elseif(isset($_GET['editrespgd'])){

		echo '<h3>Edit PGD Results</h3>';

		include('editresultspgd.php');
		
		}elseif(isset($_GET['editresphnd'])){

		echo '<h3>Edit PRE-HND Results</h3>';

		include('editresultsphnd.php');

	// view Result Menu
		
		
	}elseif(isset($_GET['vwstdr'])){

		echo '<h3> Students Records</h3>';

		include('viewstudent.php');
	

	
		}elseif(isset($_GET['viewabm'])){

		echo '<h3> Academic Board Result Sheet</h3>';

		include('viewabm.php');
		
		}elseif(isset($_GET['viewabmpgd'])){

		
		echo '<h3>PGD  Academic Board Result Sheet</h3>';

		include('viewabmpgd.php');
		
		
		}elseif(isset($_GET['viewabmphnd'])){

		echo '<h3>PRE-HND Academic Board Result Sheet</h3>';

		include('viewabmphnd.php');
		
			
		}elseif(isset($_GET['views'])){

		echo '<h3>Notice Board Result Sheet</h3>';

		include('views.php');
		
		}elseif(isset($_GET['viewspgd'])){

		
		echo '<h3>PGD Notice Board Result Sheet</h3>';

		include('viewspgd.php');
		
		
		}elseif(isset($_GET['viewsphnd'])){

		echo '<h3>PRE-HND Notice Board Result Sheet</h3>';

		include('viewsphnd.php');
		
		
		// Markk and attaendence
		}elseif(isset($_GET['scoresheet'])){

		echo '<h3>Mark and Attendance Sheet </h3>';

		include('scoresheet.php');
		
		}elseif(isset($_GET['scoresheet2'])){

		echo '<h3>Mark and Attendance Sheet </h3>';

		include('scoresheet2.php');
		
// Analysis
	
	}elseif(isset($_GET['analysis'])){

		echo '<h3>View Result Analysis</h3>';

		include('analysis.php');

}elseif(isset($_GET['analysis1'])){

		echo '<h3>View Result Analysis</h3>';

		include('analysis1.php');
		
// Manual List
	}elseif(isset($_GET['manuallist'])){

		echo '<h3>Score Entering Sheet</h3>';

		include('manuallist.php');
		
		//add user
		}elseif(isset($_GET['adduser'])){

		echo '<h3>Add New User</h3>';

		include('adduser.php');
		
		}elseif(isset($_GET['edituser'])){

		echo '<h3>Edit User</h3>';

		include('edituser.php');
		
		// backups
		}elseif(isset($_GET['backups2'])){

		echo '<h3>Manage Records</h3>';

		include('backups2.php');
		
		
		// transcripts
		}elseif(isset($_GET['trans1'])){

		echo '<h3>View Transcript</h3>';

		include('transcrips.php');
		
		}elseif(isset($_GET['trans2'])){

		echo '<h3>View Transcript</h3>';

		include('transcripspgd.php');
		
		}elseif(isset($_GET['trans3'])){

		echo '<h3>View Transcript</h3>';

		include('transcripsphnd.php');
		
		}elseif(isset($_GET['resultsheets'])){

		echo '<h3>View Individual Result</h3>';

		include('resultsheets.php');
		
		}elseif(isset($_GET['resultsheetsphnd'])){

		echo '<h3>View Individual Result</h3>';

		include('resultsheetsphnd.php');
		
		}elseif(isset($_GET['resultsheetspgd'])){

		echo '<h3>View Individual Result</h3>';

		include('resultsheetspgd.php');
		
		}elseif(isset($_GET['carryover'])){

		echo '<h3>Input Carryover  Scores</h3>';

		include('carryover.php');
		
		
		}elseif(isset($_GET['carryoverphnd'])){

		echo '<h3>Input Carryover  Scores</h3>';

		include('carryoverphnd.php');
		
		
		}elseif(isset($_GET['carryoverpgd'])){

		echo '<h3>Input Carryover  Scores</h3>';

		include('carryoverpgd.php');
		
		}elseif(isset($_GET['viewsco'])){

		echo '<h3>View Carryover Records</h3>';

		include('viewsco.php');
		
		}elseif(isset($_GET['viewscopgd'])){

		echo '<h3>View Carryover Records</h3>';

		include('viewspgdco.php');
		
		}elseif(isset($_GET['viewscophnd'])){

		echo '<h3>View Carryover Records</h3>';

		include('viewsphndco.php');
		
		}elseif(isset($_GET['editresultsspill'])){

		echo '<h3>Input Spill Over</h3>';

		include('editresultsspill.php');
		
		
		}elseif(isset($_GET['editresultsspillphnd'])){

		echo '<h3>Input Spill Over</h3>';

		include('editresultsphndspill.php');
		
		}elseif(isset($_GET['editresultsspillpgd'])){

		echo '<h3>Input Spill Over</h3>';

		include('editresultspgdspill.php');
		
		}elseif(isset($_GET['viewsspill'])){

		echo '<h3>View Spill Over Result</h3>';

		include('viewsspill.php');
		
		}elseif(isset($_GET['viewspgdspill'])){

		echo '<h3>View Spill Over Result</h3>';

		include('viewspgdspill.php');
		
		}elseif(isset($_GET['viewsphndspill'])){

		echo '<h3>View Spill Over Result</h3>';

		include('viewsphndspill.php');
		
		}elseif(isset($_GET['group'])){

		echo '<h3>Group Programmes in a Department</h3>';

		include('groupprog.php');
		
		}elseif(isset($_GET['addviewwdit'])){

		echo '<h3>Edit Courses</h3>';
		include('addviewedit.php');
		
		}elseif(isset($_GET['newcourse'])){

		echo '<h3>Add New Programme</h3>';
		include('newcourse.php');
		
		}elseif(isset($_GET['deletes'])){
		
		echo '<h3>Edit Student Records</h3>';
		
		include('deletes.php');
		
		}elseif(isset($_GET['deleter'])){

		echo '<h3>Delete Records</h3>';
		include('deleter.php');
		
		}elseif(isset($_GET['deleterr'])){

		echo '<h3>Delete Semester Scores</h3>';
		include('deleterr.php');
		
		}elseif(isset($_GET['newpro'])){

		echo '<h3>Import New Prog.</h3>';
		include('newprog.php');

		}elseif(isset($_GET['editgroup'])){

		echo '<h3>Edit Programmes.</h3>';
		include('editgroup.php');
		
		// overwrite		
		}elseif(isset($_GET['overwrite'])){

		echo '<h3>Overwrite Result.</h3>';
		include('overwrite.php');

		
	}elseif(isset($_GET['consider'])){

		echo '<h3>Consider Scores</h3>';
		include('consider.php');
		
	}elseif(isset($_GET['alloc'])){

		echo '<h3>Allocate Courses</h3>';
		include('alloc.php');
	}
		
	//	editresultsspill.php
	//	viewsspill
		
		
		
		?>