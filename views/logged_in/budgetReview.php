<?php include 'review.php'; ?>

<div id="budgetReview">
    <div class = "container theme-showcase">
        <h2>Budget Review</h2>
        <h4 class="panel-title">Income</h4>
        <div class="panel-body">
            <?php

            function getForm($CategoryParentType, $CategoryParentOrder)
            {
                $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
                foreach ($ResultsToReturn as $row)
                {
                    $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                    $subtotal += $total;
                }
                if ($CategoryParentType == 'Expense')
                {
                    $GLOBALS['totalExpense'] += $subtotal;
                }
                ?>
                <div class="row">
                    <div class="col-sm-5"><span><?php echo $ResultsToReturn[0]["categoryParentName"] ?></span>
                    </div>
                    <div class="col-sm-1">$&nbsp<?php echo number_format($subtotal, 0, '.', ',') ?></div>
                    <div class="col-sm-1" ><?php echo number_format($subtotal / $GLOBALS['grossIncome'] * 100.0) ?>&nbsp%</div>
                </div>
                <?php
            }

            for ($i = 1; $i <= 3; $i++)
            {
                getForm("Income", $i);
            }
            ?>
            <hr>
        </div>
        <h4 class="panel-title">Expense</h4>
        <div class="panel-body">
            <?php
            for ($i = 1; $i <= 9; $i++)
            {
                getForm("Expense", $i);
            }
            ?>
            <hr><hr>
        </div>
        <div class="row"><h4 class="panel-title col-sm-5">Budget Surplus <font color="red">(Deficit)</font></h4>
            <div class="col-sm-3"><span>
                    <?php
                    $GLOBALS['net'] = $GLOBALS['grossIncome'] - $GLOBALS['totalExpense'];

                    if ($GLOBALS['net'] <= 0.0)
                    {
                        echo '<font color="red">$&nbsp<' . $GLOBALS['net'] . '</font>';
                    } else
                    {
                        echo '$&nbsp' . $GLOBALS['net'];
                    }
                    ?>
                </span>
            </div>
        </div>
        <div class="panel-body"><input type="button" value="Print" class="btn btn-primary pull-right" onclick="changeForm()" id="nextReview"></div>
        <br>
    </div>
</div>
