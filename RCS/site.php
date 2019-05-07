<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    class students{
      var $name;
      var $matnumber;
      var $gpa;


      function __connector($name,$matnumber,$gpa){

        $this->name = $name;
        $this->matnumber = $matnumber;
        $this->gpa = $gpa;

      }
    }

    $stdnt = new students("Khaleel Ibrahim","HNDCS/08/012",3.67);
    echo $stdnt->name;
    echo $stdnt->matnumber;
    echo "good morning";
?>

  </body>
</html>
