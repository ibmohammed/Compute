search_results.php
<?php
$results = "";
$letter = "";
if(isset($_GET['letter']) && strlen($_GET['letter']) == 1){
    $letter = preg_replace('#[^a-z]#i', '', $_GET['letter']);
    if(strlen($letter) != 1){
echo "ERROR: HackAttempt, after filtration thevariable is empty.";
        exit();
    }
    // Connect to database here now
	
 require("includes/header.php");
   
    // SELECT * FROM movies WHERE title LIKE '%$letter'
	
$query = mysql_query(" SELECT * FROM movies WHERE location LIKE '%$letter'");	

    // Use a while loop to append database results into the $resultsvariable ($results .=)
while ($results .= mysql_fetch_array($query)){
echo $results;	
	}

    // Close your database connection here after your while loop closes
    // The line below is only to use for testing purposes before you
	    // attempt to connect to your database and query it, remove this line after initial test

 $results = "PHP recognizes the dynamic ".$letter." and can search MySQL using it";
}
?>
