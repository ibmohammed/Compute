 <?php
      	    

echo "<form name = 'forms' method = 'post' action = ''>";
echo "<input type='hidden' name = 'semester' value = '".$_SESSION['semester']."'>";
echo "<input type='hidden' name = 'class' value = '".$_SESSION['class']."'>";
echo "<input type='hidden' name = 'courseid' value = '".$_SESSION['prog']."'>";
echo "<input type='hidden' name = 'session' value = '".$_SESSION['session']."'>";
echo '<input name="Submit" value=" Back " type="submit"  style="border:thin; color:blue;"/>';
echo "</form>";

 ?>
      	  