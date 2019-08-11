<!DOCTYPE html>
<html>
<head>
<script>
var btns = "";
var letters ="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var letterArray = letters.split("");
for(var i = 0; i < 26; i++){
    var letter = letterArray.shift();
 btns += '<button class="mybtns" onclick="alphabetSearch(\''+letter
+'\');">'+letter+'</button>';
}
function alphabetSearch(let){
  window.location = "search_results.php?letter="+let;
}
</script>
</head>
<body>
<script> 
document.write(btns);
</script>
</body>
</html>

