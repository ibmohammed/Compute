<select name="programme" id="programme">
         			<option selected="selected"></option>
         			
         			 <?php include('dptcode.php') ;
                        
            $queri = mysql_query("SELECT * FROM `dept` WHERE 
            prog = '$departmentcode' && `dep` LIKE '%National Diploma%'") 
            or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){          ?>
            
               <option><?php echo $pcd['dep'];?></option>
                         <?php }?>
              
          </select>
          
 <select name="session">
	<option></option>
	</select>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>

</body>

</html>
