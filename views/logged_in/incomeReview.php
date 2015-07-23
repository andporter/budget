<?php
include('getDB.php');
$total = 0;
$sumtotal = 0;

function getForm($CategoryParentType, $CategoryParentOrder)
{
    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
    ?>
    <h4 class="panel-title">
        <b><?php echo $ResultsToReturn[0]["categoryParentName"]; ?></b>
    </h4>
    <div class="panel-body">
        <?php
        foreach ($ResultsToReturn as $row)
        {
            ?>
            <div class = "row">
                <div class="col-sm-5">
                    <h5><?php echo $row["categoryName"] ?></h5>
                </div>
                <div class = 'col-sm-3'>
                    <span>$&nbsp<?php
                        echo $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                        $total += $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                        ?></span>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="row">
            <div class="col-sm-5"><h5><u>Total&nbsp<?php echo $ResultsToReturn[0]["categoryParentName"]; ?></u></h5></div>
            <div class="col-sm-1"><u>$&nbsp<?php echo $total ?></u></div>
            <div class="col-sm-2"><u><?php echo $total ?>&nbsp%</u></div>
        </div>
    </div>
    <?php
}
?>
<div id="incomeReview">
    <div class = 'container theme-showcase'>
        <h2>Income Review</h2>
        <?php
        for ($i = 1; $i <= 3; $i++)
        {
            $sumtotal += $total;
            $total = 0;
            getForm("Income", $i);
        }
        ?>
        <div>
            <div class="row">
                <h4 class="panel-title col-sm-5">
                    <b>Gross Income</b>
                </h4>
                <div class="col-sm-3">
                    <span>Amount here</span>
                </div>
            </div>
            <div class="row">
                <div class="panel-body col-sm-5">
                    <span>Less Federal and State Income Taxes</span>
                </div>
                <div class="col-sm-3">
                    <span>Amount here</span>
                </div>
            </div>
            <div class="row">
                <h4 class="panel-title col-sm-5">
                    <b>Net Income</b>
                </h4>
                <div class="col-sm-3">
                    <span>Amount here</span>
                </div>
            </div>
            <div class="panel-body">
                <input type="button" value="Next" class="btn btn-primary pull-right" onclick="changeForm()" id="nextReview">
            </div>
        </div>
    </div>
</div>

