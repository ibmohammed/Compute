
      
<?php
if($all_charts == 1)
{
//$chart_name1 = $piechart;
$chart_name2 = $hrchart;
}
elseif($all_charts == 0)
{
    $chart_name1 = "barchart_values";
   // $chart_name2 = "piechart";
}
?>

<div class="main-panel">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bar chart</h4>
                  <div id="<?php echo $chart_name2;?>" style="width: auto; height: auto;"></div>
                </div>
              </div>
            </div>
          </div>
</div>
           <!-- - End of Dashboard-->