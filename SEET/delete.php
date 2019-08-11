<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "logins.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php include("includes/header.php");?>
    <table width="80%" align="center" >
      <tr>
        <td><img src="header1.png" width="100%" height="80" /></td>
      </tr>
    </table>
    <table width="80%" align="center" >
      <tr>
        <td bgcolor="#4F81BD"><marquee behavior="alternate">
          <strong style="color:#FF0000;">Nipoly Consult........</strong>
          </marquee>
            <!-- #BeginDate format:Am1a -->June 24, 2014 9:11 AM<!-- #EndDate --></td>
      </tr>
    </table>
    <table width="80%" align="center">
<tr>
    <td width="2%" rowspan="2" valign="top"><table width="14%">
      <tr>
        <td><a href="editstrec.php"><img src="images/back.png" width="150" height="30" border="0" /></a></td>
      </tr>
    </table></td>
    <td width="63%" rowspan="2" ><table>
                        <tr>
                            <td id="page1">
                          </td>
                        </tr>
                    </table>
					<?php if (isset($_GET['Submit'])){
$prog = $_GET['courseid'];
$sess = $_GET['session'];
$progid = $_GET['code'];
$sql = mysql_query("SELECT* FROM`studentsnm` WHERE `dept`='$prog' AND`session`='$sess'");
?>
                    <span style="font-weight: bold">Delete Student Data</span>
                    <form action="" method="get" name="">
<table align="center" style="text-align: left;color:blue;">
                                <tr>
                                    <td align="left">SEMESTER</td>
                                    <td align="left"><select name="semester">
                                        <option>------</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
										<option>4</option>
										  <option>5</option>
										  <option>6</option>
                                  </select></td>
                                </tr>
                                <tr>
                                    <td align="left">MATRIC NUMBER</td>
                                    <td align="left"><select name="matricno">
                                      <?php while ($row=mysql_fetch_array($sql)){?>
                                      <option><?php echo $row['matno']; ?></option>
                                      <?php }?>
                                    </select></td>
                                </tr>

                                <tr>
                                    <td align="left">SESSION</td>
                                    <td align="left"><select name="session">
                                      <?php //$col=mysql_fetch_array($sql);?>
                                      <option><?php echo $sess; ?></option>
                                              <?php echo include('includes/sessions.php');?>

                                    </select></td>
                                </tr>

        </table>
              <div align="center">
<input name="Submitd" type="submit" id="Submitd" value="Delete">
        </div>
      </form></td>
  </tr>
</table><?php }elseif(isset($_GET['Submitd'])){

$mt= $_GET['matricno'];
$smstr= $_GET['semester'];
$ss= $_GET['session'];
if (!$mt || !$smstr || !$ss){
    echo "<script language = 'javascript'>"."alert(pls enter semester)"."</script>";
    exit;
}
//DELETE FROM `consultdbsnw`.`logintbl` WHERE `logintbl`.`id` = 5
 $del= mysql_query("DELETE FROM consultdbsnw.entrytbl WHERE entrytbl.matric_no like '$mt'");
if (!$del){
    die (mysql_error());
    }
    echo "<script language = 'javascript'>"."alert('Deleted')"."</script>";

}

?>
<?php require("includes/footer.php");?>