<?php //include('includes/header.php');?>
<table align="center">
  <tr>
    <td align="center"><a href="index.php">
      <input type="submit" name="button2" id="button2" value="Back" />
    </a></td>
  </tr>
  <tr>
    <td><font color="#green" class="center">To import backup, chose a file than click submit</font></td>
  </tr>
</table>
<?php

if (isset($_POST['button']))
{

  try 
  {

    $fname = $_FILES['file']['name'];
    //	echo 'upload file name: '. $fname. ' ';
    $chk_ext = explode(".",$fname);
    if(strtolower(end($chk_ext)) == "sql")
    {
      echo 'upload file name: '. $fname. ' ';
      $filename = $_FILES['file']['tmp_name'];
      //$handle = fopen($filename, "r");

      $templine = '';// temporary variable used to store current query
      $Lines = file($fname); //Read in entire file
      foreach($Lines as $line)//Loop through each line
      {
        if(substr($line,0,2) == '--' || $line == '') // skip it if it a comment
        continue;
        $templine .= $line; //add this line to the current segment
        if(substr(trim($line),-1, 1) == ';') // if it has a semi colunm at the end, its the end of the query
        {
          //include('includes/header.php');
          mysqli_query($logs, $templine) or die(mysqli_error($logs)); ////perfom the query
          $templine = ''; // reset temp variable to empty
        }
      }
        echo "Tables imported successfully";
    }
  } 
  catch(Exception $e) 
  {
    throw $e;
  }
}?>

<br /><br />
<table width="347" align="center">
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
      <table width="339">
          <td align="center">
            <strong>Choose file</strong> <br />     
            <input name="file" type="file" id="csv"  class="form-control"/>
          </td>
        </tr>
      </table>
     <input type="submit" name="button" id="button" value="Submit" />
     </form>
    </td>
  </tr>
</table>