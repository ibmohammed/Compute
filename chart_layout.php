
      
<?php
if($all_charts == 1)
{
$chart_name1 = $piechart;
$chart_name2 = $hrchart;
}
elseif($all_charts == 0)
{
    $chart_name1 = "barchart_values";
    $chart_name2 = "piechart";
}
?>
<!---
        <div class="row">

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                <div id="<?php //echo $chart_name1;?>" style="width: auto; height: auto;"></div>
                </div>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <div id="<?php //echo $chart_name2;?>" style="width: auto; height: auto;"></div>
                </div>
              </div>
            </div>
        </div>
     -->
<!-- dashboard -->
<div class="main-panel">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pie chart</h4>
                  <div id="<?php echo $chart_name1;?>" style="width: auto; height: auto;"></div>
                </div>
              </div>
            </div>
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