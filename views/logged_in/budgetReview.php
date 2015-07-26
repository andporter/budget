<?php
$grossIncome = 0.0;
function getForm($CategoryParentType, $CategoryParentOrder)
{
    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
    foreach ($ResultsToReturn as $row)
    {
        $total += $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
        $grossIncome += $total;
        $percentage[$ResultsToReturn[0]["categoryParentName"] . 'percent'] = number_format($total / $grossIncome * 100.0, 2);
    }
    ?>
    <div class="row">
        <div class="col-sm-5">
            <span><?php echo $ResultsToReturn[0]["categoryParentName"]; ?></span>
        </div>
        <div class="col-sm-1">$&nbsp<?php echo number_format($total, 0, '.', ',') ?></div>
        <div class="col-sm-1"><?php echo number_format($total / $grossIncome * 100) ?>&nbsp%</div>
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
            for ($i = 1; $i <= 9; $i++)
            {
                $sumtotal += $total;
                $total = 0;
                getForm("Expense", $i);
            }
            ?>
        </div>
        <div class="row">
            <h4 class="panel-title col-sm-5">Budget Surplus <font color="red">(Deficit)</font></h4>
            <div class="col-sm-3">
                <span><?php
                    if ($total <= 0.0)
                    {
                        echo '<font color="red">$&nbsp' . $sumtotal . '<font>';
                    } else
                    {
                        echo $sumtotal;
                    }
                    ?></span>
            </div>
        </div>
        <div class="panel-body">
            <input type="button" value="Print" class="btn btn-primary pull-right" onclick="changeForm()" id="nextReview">
        </div>
        <br>
    </div>
</div>