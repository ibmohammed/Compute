<?php 
function insert_entered($conn, $code, $cunits, $prgrm, $semst, $sesn)
{
	$qry= mysqli_prepare($conn,"INSERT INTO `entered` 
					(`code`, `unit`, `prog_id`, `semester`, `session`
					)VALUES(?,?,?,?,?)"
				)or die(mysqli_error($conn));
	mysqli_stmt_bind_param($qry, "sssss", $code, $cunits, $prgrm, $semst, $sesn);
	$me = mysqli_stmt_execute($qry);
	return $me;
}

function insert_result($con, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn){
	$resultsss =	mysqli_prepare($con,"INSERT IGNORE INTO `results`  
	(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`prog_id`, `semester`, `session`) 
	VALUES(?,?,?,?,?,?,?,?,?,?
	) 
	") or die(mysqli_error($con)); 
	mysqli_stmt_bind_param($resultsss, "sssissssss", $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn);
	
return $resultsss;
}


function insert_prev_result($con, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn,$curent_sess,$co_spill){
	$resultsss =	mysqli_prepare($con,"INSERT IGNORE INTO `prev_results`  
	(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`prog_id`, `semester`, `session`, `curent_sess`, `co_spill`) 
	VALUES(?,?,?,?,?,?,?,?,?,?,?
	) 
	") or die(mysqli_error($con)."kl"); 
	mysqli_stmt_bind_param($resultsss, "sssissssssss", $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn,$co_spill);
	
return $resultsss;
}


function update_prev_result($con, $score,$grade1,$point,$co_spill,$smatno,$code){
	

    $resultsss =	mysqli_prepare($con,"UPDATE `prev_results` 
    SET 
	`score` =  ?,
	`grade` =  ?,
	`points` = ?, 
	`co_spill` = ?
    WHERE  
	`matric_no` = ? &&  
	`code` = ?
	") or die(mysqli_error($con)); 
	mysqli_stmt_bind_param($resultsss, "ssssss", $score,$grade1,$point,$co_spill,$smatno,$code);


	
return $resultsss;
}

function update_result($con, $score,$grade1,$point,$curent_sess, $co_spill,$smatno,$code){
	$resultsss =	mysqli_prepare($con,"UPDATE `results` 
    SET 
	`score` =  ?,
	`grade` =  ?,
	`points` = ?, 
	`session` = ?
	`co_spill` = ?
    WHERE  
	`results`.`matric_no` = ? &&  
	`results`.`code` = ?
	") or die(mysqli_error($con)); 
	mysqli_stmt_bind_param($resultsss, "sssssss", $score,$grade1,$point,$curent_sess, $co_spill,$smatno,$code);

return $resultsss;
}



function get_student_name($con, $smatno){
	$namee = mysqli_query($con, "SELECT `names` 
	FROM `studentsnm` WHERE `matno` = '$smatno'") or die(mysqli_error($con)."hhjk");

	return $namee;
}?>