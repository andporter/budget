<?php

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
                    <h5><?php echo $row["categoryName"]; ?></h5>
                </div>
                <div class = 'col-sm-3'>
                    <span>$&nbsp<?php
                        $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                        $sumtotal += $total;
                        //$percentages[$ResultsToReturn[0]["categoryParentName"] . 'percent'] = number_format($total / $sumtotal * 100.0, 2);
                        echo $total;
                        ?></span>
                </div>
            </div>
            <?php
        }
        $grossIncome += $sumtotal;
        ?>
        <div class="row">
            <div class="col-sm-5"><h5><u>Total&nbsp<?php echo $ResultsToReturn[0]["categoryParentName"]; ?></u></h5></div>
            <div class="col-sm-1" id="<?php echo $ResultsToReturn[0]["categoryParentName"] . 'total'; ?>"><u>$&nbsp<?php
                    $grossIncome += $sumtotal;
                    echo $sumtotal;
                    ?></u></div>
            <div class="col-sm-2" id="<?php echo $ResultsToReturn[0]["categoryParentName"] . 'percent'; ?>"></div>
        </div>
    </div>
    <?php
}
?>
<div id="incomeReview">
    <div class = 'container theme-showcase'>
        <div class="row">
            <h2 class="col-sm-5">Income Review</h2>
            <h4 class="col-sm-1">$&nbsp<?php //echo net income      ?></h4>
            <h4 class="col-sm-1"><?php // echo percentage??      ?>&nbsp%</h4>
        </div>
        <?php
        for ($i = 1; $i <= 3; $i++)
        {
            $total = 0;
            getForm("Income", $i);
        }
        ?>
        <div>
            <div class="row">
                <h4 class="panel-title col-sm-5">
                    <b>Gross Income</b>
                </h4>
                <div class="col-sm-1">
                    <span>$&nbsp<?php echo $grossIncome; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="panel-body col-sm-5">
                    <span>Less Federal and State Income Taxes</span>
                </div>
                <div class="col-sm-1">
                    <span>$&nbsp<?php echo $grossIncome; ?></span>
                </div>
                <div class="col-sm-1">
                    <span><?php // echo percentages[]?? 
        ?>&nbsp%</span>
                </div>
            </div>
            <div class="row">
                <h4 class="panel-title col-sm-5">
                    <b>Net Income</b>
                </h4>
                <div class="col-sm-1">
                    <span>$&nbsp<?php echo $grossIncome; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

