<?php include 'review.php'; ?>
<div id="incomeReview">
    <div class = "container theme-showcase">
        <div class="row">
            <h2 class="col-sm-5">Income Review</h2>
        </div>
        <?php

        function getIncomeReviewForm($CategoryParentType, $CategoryParentOrder)
        {
            $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
            ?><hr><h4 class="panel-title"><b><?php echo $ResultsToReturn[0]["categoryParentName"] ?></b></h4><div class="panel-body"><?php
            foreach ($ResultsToReturn as $row)
            {
                ?>
                    <div class = "row"><div class="col-sm-5"><span><?php echo $row["categoryName"] ?>'</span>
                        </div>
                        <div class = "col-sm-3"><span>$&nbsp<?php $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"]; ?></span>
                        </div>
                    </div><?php
                    $subtotal += $total;
                }
                ?>
                <div class="row">
                    <div class="col-sm-5"><h5><u>Total&nbsp<?php echo $ResultsToReturn[0]["categoryParentName"] ?></u></h5></div>
                    <div class="col-sm-1" <?php echo 'id="' . $ResultsToReturn[0]["categoryParentName"] . 'total"' ?>>
                        <u>$&nbsp<?php echo $subtotal ?></u>
                    </div>
                    <div class="col-sm-2" <?php echo 'id="' . $ResultsToReturn[0]["categoryParentName"] . 'percent"' ?>>
                        <u><?php echo number_format($subtotal / $GLOBALS['grossIncome'] * 100) ?>&nbsp%</u>
                    </div>
                </div>
            </div><?php
        }

        for ($i = 1; $i <= 3; $i++)
        {
            $grossIncome += $subtotal;
            $total = 0;
            getIncomeReviewForm("Income", $i);
        }
        ?>
        <hr><hr>
        <div>
            <div class="row">
                <h4 class="panel-title col-sm-5"><b>Gross Income</b></h4>
                <div class="col-sm-1"><span>$&nbsp<?php echo $grossIncome ?></span></div>
            </div>
            <div class="row">
                <div class="panel-body col-sm-5"><span>Less Federal and State Income Taxes</span></div>
                <div class="col-sm-1"><font color="red"><span>$&nbsp<?php echo $tax; ?></span></font></div>
                <div class="col-sm-1"><font color="red"><span><?php echo number_format($GLOBALS['tax'] / $GLOBALS['grossIncome'] * 100) ?>&nbsp%</span></font></div></div><hr>
                <div class="row">
                <?php $netIncome = $grossIncome - $tax; ?>
                <h4 class="panel-title col-sm-5"><b>Net Income</b></h4>
                <div class="col-sm-1"><span>$&nbsp<?php echo $netIncome; ?></span></div><hr><hr>
                <input type="button" value="Next" class="btn btn-primary pull-right" onclick="changeForm()" id="toExpenseReview">
