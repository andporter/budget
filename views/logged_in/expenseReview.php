<?php include 'review.php'; ?> 
<div id="expenseReview">
    <div class = "container theme-showcase">
        <h2>Functional Expense Review</h2>
        <?php

        function getExpenseReviewForm($CategoryParentType, $CategoryParentOrder)
        {
            $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
            ?><hr><h4 class="panel-title col-sm-5"><?php echo substr($ResultsToReturn[0]["categoryParentName"], 7) ?></h4>
            <div class="col-sm-1">Client</div>
            <div class="col-sm-1">Spouse</div>
            <div class="col-sm-1">Total</div>
            <div class="col-sm-1">Actual</div>
            <div class="col-sm-1">Difference</div>
            <div class="panel-body">
                <?php
                $subtotal = 0;
                foreach ($ResultsToReturn as $row)
                {
                    $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                    $subtotal += $total;
                    $GLOBALS['totalExpense'] += $total;

                    if ($total > 0.0)
                    {
                        ?>
                        <div class = "row">
                            <div class="col-sm-5"><span><?php echo $row["categoryName"] ?></span></div>
                            <div class = "col-sm-1"><span>$&nbsp<?php echo number_format($row["budgetSelfAmount"]); ?></span></div>
                            <div class = "col-sm-1"><span>$&nbsp<?php echo number_format($row["budgetSpouseAmount"]); ?></span></div>
                            <div class = "col-sm-1"><span>$&nbsp<?php echo number_format($total); ?></span></div>
                            <div class="col-sm-1">_________</div>
                            <div class="col-sm-1">_________</div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="row">
                    <div class="col-sm-7"><h5><u>Total</u></h5></div>
                    <div class="col-sm-1"><u>$&nbsp<?php echo number_format($subtotal) ?></u></div>
                    <div class="col-sm-2"><u><?php echo number_format($subtotal / $GLOBALS['grossIncome'] * 100) ?>&nbsp% gross income</u></div>
                </div>
            </div>
            <?php
        }

        for ($i = 1; $i <= getNumberOfParentCategories("Expense"); $i++)
        {
            getExpenseReviewForm("Expense", $i);
        }
        ?>
        <hr><hr>
        <div class="row"><h4 class="panel-title col-sm-5"><b>Total Expenses</b></h4>
            <div class="col-sm-3"><span>$&nbsp<?php echo number_format($totalExpense) ?></span></div>
        </div>
        <div class="panel-body pull-right">
            <input type="button" value="Back" class="btn btn-primary" onClick="history.go(-1);
                    return true;" id="backButton">
            <input type="button" value="Next" class="btn btn-primary" id="toBudgetReview">
        </div>
        <br>
    </div>
</div>
<script type = "text/javascript">
    $("#toBudgetReview").on("click", function ()
    {
        window.location.href = "index.php?budgetreview=budget";
    });

</script>