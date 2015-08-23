<?php
include 'review.php';

function getHeader($name)
{
    echo '<h4 class="panel-title col-sm-5">' . $name . '</h4>
        <div class="col-sm-1">Client</div>
        <div class="col-sm-1">Spouse</div>
        <div class="col-sm-1">Totals</div>
        <div class="col-sm-1">% Gross</div>
        <div class="col-sm-1"><center>Actual</center></div>
        <div class="col-sm-1"><center>Difference</center></div>';
}
?>
<div id="budgetReview">
    <div class = "container theme-showcase">
        <h2>Budget Review</h2>
        <?php getHeader("Income"); ?>
        <div class="panel-body">
            <?php

            function getBudgetReviewForm($CategoryParentType, $CategoryParentOrder)
            {
                $GLOBALS['subtotal'] = 0.0;
                $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
                $clienttotal = 0;
                $spousetotal = 0;
                foreach ($ResultsToReturn as $row)
                {
                    $clienttotal += $row["budgetSelfAmount"];
                    $spousetotal += $row["budgetSpouseAmount"];
                    $subtotal = $clienttotal + $spousetotal;
                }
                if ($CategoryParentType == 'Expense')
                {
                    $GLOBALS['totalExpense'] += $subtotal;
                }
                ?>
                <div class="row">
                    <div class="col-sm-5"><span><?php echo $ResultsToReturn[0]["categoryParentName"] ?></span></div>
                    <div class="col-sm-1">$&nbsp<?php echo number_format($clienttotal) ?></div>
                    <div class="col-sm-1">$&nbsp<?php echo number_format($spousetotal) ?></div>
                    <div class="col-sm-1">$&nbsp<?php echo number_format($subtotal) ?></div>
                    <div class="col-sm-1" ><?php echo number_format($subtotal / $GLOBALS['grossIncome'] * 100.0) ?>&nbsp%</div>
                    <div class="col-sm-1"><center>________</center></div>
                    <div class="col-sm-1"><center>________</center></div>
                </div>
                <?php
            }

            for ($i = 1; $i <= getNumberOfParentCategories("Income"); $i++)
            {
                getBudgetReviewForm("Income", $i);
            }
            ?>
            <div class="row">
                <h4 class="col-sm-7"><u>Gross Income</u></h4>
                <div class="col-sm-1"><u>$&nbsp<?php echo number_format($GLOBALS['grossIncome']); ?></u></div>
            </div>
            <hr>
        </div>
        <?php getHeader("Expense"); ?>
        <div class="panel-body">
            <?php
            for ($i = 1; $i <= getNumberOfParentCategories("Expense"); $i++)
            {
                getBudgetReviewForm("Expense", $i);
            }
            ?>
            <div class="row">
                <h4 class="col-sm-7"><u>Total Expenses</u></h4>
                <div class="col-sm-1"><u>$&nbsp<?php echo number_format($GLOBALS['totalExpense']); ?></u></div>
            </div>
        </div>
        <hr><hr>
        <div class="row"><h4 class="panel-title col-sm-5">Budget Surplus <font color="red">(Deficit)</font></h4>
            <div class="col-sm-3"><span>
                    <?php
                    $GLOBALS['net'] = $GLOBALS['grossIncome'] - $GLOBALS['totalExpense'];

                    if ($GLOBALS['net'] <= 0.0)
                    {
                        echo '<font color="red">($&nbsp' . number_format(abs($GLOBALS['net'])) . ')</font>';
                    } else
                    {
                        echo '$&nbsp' . number_format($GLOBALS['net']);
                    }
                    ?>
                </span>
            </div>
        </div>
        <div class="panel-body pull-right">
            <input type="button" value="Done! Back to Dashboard" class="btn btn-primary" id="backButton">
            <a href="api/api.php?method=userBudgetExcelExport" class="btn btn-primary">Excel</a>
            <input type="button" value="Print" class="btn btn-primary" id="printBudget">
        </div>
        <br>
    </div>
</div>
<script type = "text/javascript">
    $("#printBudget").on("click", function ()
    {
        window.print();
    });

    $("#backButton").on("click", function () {
        window.location.href = "index.php?budgets";
    });

</script>