<?php include 'review.php'; ?>

<div id="budgetReview">
    <div class = "container theme-showcase">
        <h2>Budget Review</h2>
        <h4 class="panel-title col-sm-7">Income</h4>
        <div class="col-sm-1">Actual</div>
        <div class="col-sm-1">Difference</div>
        <div class="panel-body">
            <?php

            function getBudgetReviewForm($CategoryParentType, $CategoryParentOrder)
            {
                $GLOBALS['subtotal'] = 0.0;
                $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
                foreach ($ResultsToReturn as $row)
                {
                    $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                    $GLOBALS['subtotal'] += $total;
                }
                if ($CategoryParentType == 'Expense')
                {
                    $GLOBALS['totalExpense'] += $GLOBALS['subtotal'];
                }
                ?>
                <div class="row">
                    <div class="col-sm-5"><span><?php echo $ResultsToReturn[0]["categoryParentName"] ?></span>
                    </div>
                    <div class="col-sm-1">$&nbsp<?php echo number_format($GLOBALS['subtotal']) ?></div>
                    <div class="col-sm-1" ><?php echo number_format($GLOBALS['subtotal'] / $GLOBALS['grossIncome'] * 100.0) ?>&nbsp%</div>
                    <div class="col-sm-1">_________</div>
                    <div class="col-sm-1">_________</div>
                </div>
                <?php
            }

            for ($i = 1; $i <= 3; $i++)
            {
                getBudgetReviewForm("Income", $i);
            }
            ?>
            <div class="row">
                <h4 class="col-sm-5"><u>Gross Income</u></h4>
                <div class="col-sm-1"><u>$&nbsp<?php echo $GLOBALS['grossIncome'] ?></u></div>
            </div>
            <hr>
        </div>
        <h4 class="panel-title col-sm-7">Expense</h4>
        <div class="col-sm-1">Actual</div>
        <div class="col-sm-1">Difference</div>
        <div class="panel-body">
            <?php
            for ($i = 1; $i <= 9; $i++)
            {
                getBudgetReviewForm("Expense", $i);
            }
            ?>
            <div class="row">
                <h4 class="col-sm-5"><u>Total Expenses</u></h4>
                <div class="col-sm-1"><u>$&nbsp<?php echo $GLOBALS['totalExpense'] ?></u></div>
            </div>
        </div>
        <hr><hr>
        <div class="row"><h4 class="panel-title col-sm-5">Budget Surplus <font color="red">(Deficit)</font></h4>
            <div class="col-sm-3"><span>
                    <?php
                    $GLOBALS['net'] = $GLOBALS['grossIncome'] - $GLOBALS['totalExpense'];

                    if ($GLOBALS['net'] <= 0.0)
                    {
                        echo '<font color="red">-&nbsp$&nbsp' . number_format(abs($GLOBALS['net'])) . '</font>';
                    } else
                    {
                        echo '$&nbsp' . $GLOBALS['net'];
                    }
                    ?>
                </span>
            </div>
        </div>
        <div class="panel-body"><input type="button" value="Print" class="btn btn-primary pull-right" id="printBudget"></div>
        <br>
    </div>
</div>
<script type = "text/javascript">
    $("#printBudget").on("click", function ()
    {
        window.print();
    });

</script>