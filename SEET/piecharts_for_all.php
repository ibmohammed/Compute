<?php

if (!isset($_SESSION))
{
  session_start();
  require_once('../../functions/queries.php');
  require_once('../../connections/connection.php');
}

if(isset($_POST["Submit1"]))
{
    //$course_code = $_POST[""];
    $semester = $_POST["semester"];
    $session = $_POST["session"];
    $programme = $_POST["programme"];

    $the_prog = programmes($programme, $logs);
    $prog_name = mysqli_fetch_assoc($the_prog);

    echo $prog_name['programme']. " Result Analysis of Semester ".$semester.", ".$session." Academic Session";
    //$show_chart = 0;
    include('reanalyz.php');	
    echo "<hr><br><hr>";
    include("barchart.php"); 
  }

?>
<hr>
<em style="color:green">Select programme, session, semester, year to view result Result Analysis</em>
<hr>
<form action="" method="post" name="grades" id="grade">
<table class="table table-bordered">  
  <tr>
      <td><span style="font-weight: bold">PROGRAMME:</span></td>
      <td >
      <select name="programme" id="programme" class="form-control">
        <option selected="selected" value="">Select Programme</option>
        <?php //include('dptcode.php') ;
        if($forms_choose == 1){
        $queri = 	prog_function($logs); 
        }elseif($forms_choose == 0){
            $sq = mysqli_query($logs,"SELECT * FROM `departments` WHERE code = '$departmentcode'") or die(mysqli_error($logs));
            $did = mysqli_fetch_assoc($sq);
            $queri = mysqli_query($logs,"SELECT * FROM `programmes` WHERE dept_id LIKE '".$did['dept_id']."'") or die(mysqli_error($logs));
        }

        while($pcd = mysqli_fetch_assoc($queri)){
            ?>
        <option value = "<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
         <?php }?>
      </select>
      </td>
    </tr>
    <tr>
      <td><span style="font-weight: bold">SEMESTER:</span></td>
      <td >
      <select name="semester" class="form-control">
        <option selected="selected" value="">Select Semester</option>
        <option value="1">First Semester</option>
        <option value="2">Second Semester</option>
        <option value="3">Third Semester</option>
        <option value="4">Fourth Semester</option>
      </select>
      </td>
    </tr>
    <tr>
      <td><span style="font-weight: bold">SESSION:</span></td>
      <td >
      <select name="session" class="form-control">
            <option selected="selected" value="">Select Session</option>
      <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
        <?php echo include('includes/sessions.php');?>
        <option>2018/2019</option>
      </select>
       
       </td>
    </tr>



     <tr>
      <td><span style="font-weight: bold">Year:</span></td>
      <td >
      <select name="year" class="form-control">
            <option selected="selected" value="">Select Year</option> 
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
      </select>
       
       </td>
    </tr>


    <tr>
      <td colspan="2">
        <input name="Submit1" type="submit" id="Submit" value="Submit"  class="btn btn-gradient-primary mr-2"/>
      </td>
    </tr>
  </table>
</form>
<br>
<hr>
<br>
<hr>