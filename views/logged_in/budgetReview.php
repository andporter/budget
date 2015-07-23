<?php
include('getDB.php');
$total = 0;
$sumtotal = 0;

function getForm($CategoryParentType, $CategoryParentOrder)
{
    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
    ?>
    <div class="row">
        <div class="col-sm-5">
            <span><?php echo $ResultsToReturn[0]["categoryParentName"]; ?></span>
        </div>
        <div class="col-sm-1">$&nbsp<?php echo $total ?></div>
        <div class="col-sm-1"><?php echo $total ?>&nbsp%</div>
    </div>
    <?php
}
?>
<div id="budgetReview">
    <div class = 'container theme-showcase'>
        <h2>Budget Review</h2>
        <h4 class="panel-title">Income</h4>
        <div class="panel-body">
            <?php
            for ($i = 1; $i <= 3; $i++)
            {
                $sumtotal += $total;
                $total = 0;
                getForm("Income", $i);
            }
            ?>
        </div>
        <h4 class="panel-title">Expense</h4>
        <div class="panel-body">
            <?php
            $sumtotal = 0;
            for ($i = 1; $i <= 9; $i++)
            {
                $sumtotal += $total;
                $total = 0;
                getForm("Expense", $i);
            }
            ?>
        </div>
        <div class="row">
            <h4>Budget Surplus (Deficit)</h4>
        </div>
        <div class="panel-body">
            <input type="button" value="Print" class="btn btn-primary pull-right" onclick="changeForm()" id="nextReview">
        </div>
        <br>
    </div>
</div>