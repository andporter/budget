<?php include('review.php'); ?>

<div id="incomeReview">
    <div class = "container theme-showcase">
        <h2>Income Review</h2>
        <?php

        function getIncomeReviewForm($CategoryParentType, $CategoryParentOrder)
        {
            $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
            ?><hr><h4 class="panel-title col-sm-5"><b><?php echo $ResultsToReturn[0]["categoryParentName"] ?></b></h4>
            <div class="col-sm-1">Client</div>
            <div class="col-sm-1">Spouse</div>
            <div class="col-sm-1">Total</div>
            <div class="col-sm-1">Actual</div>
            <div class="col-sm-1">Difference</div>
            <div class="panel-body"><?php
                $subtotal = 0;
                foreach ($ResultsToReturn as $row)
                {
                    $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                    if ($total > 0.0)
                    {
                        ?>
                        <div class = "row">
                            <div class="col-sm-5"><span><?php echo $row["categoryName"] ?></span></div>
                            <div class = "col-sm-1"><span>$&nbsp<?php
                                    echo number_format($row["budgetSelfAmount"]);
                                    ?></span>
                            </div>
                            <div class = "col-sm-1"><span>$&nbsp<?php
                                    echo number_format($row["budgetSpouseAmount"]);
                                    ?></span>
                            </div>
                            <div class = "col-sm-1"><span>$&nbsp<?php
                                    echo number_format($total);
                                    ?></span>
                            </div>
                            <div class="col-sm-1">_________</div>
                            <div class="col-sm-1">_________</div>
                        </div><?php
                        $subtotal += $total;
                    }
                }
                ?>
                <div class="row">
                    <div class="col-sm-7"><h5><u>Total&nbsp<?php echo $ResultsToReturn[0]["categoryParentName"] ?></u></h5></div>
                    <div class="col-sm-1" <?php echo 'id="' . $ResultsToReturn[0]["categoryParentName"] . 'total"' ?>>
                        <u>$&nbsp<?php echo number_format($subtotal) ?></u>
                    </div>
                    <div class="col-sm-2" <?php echo 'id="' . $ResultsToReturn[0]["categoryParentName"] . 'percent"' ?>>
                        <u><?php echo number_format($subtotal / $GLOBALS['grossIncome'] * 100) ?>&nbsp% gross income</u>
                    </div>
                </div>
            </div><?php
        }

        for ($i = 1; $i <= getNumberOfParentCategories("Income"); $i++)
        {
            getIncomeReviewForm("Income", $i);
        }
        ?>
        <hr><hr>
        <div>
            <div class="row">
                <h4 class="panel-title col-sm-7"><b>Gross Income</b></h4>
                <div class="col-sm-1"><span>$&nbsp<?php echo number_format($GLOBALS['grossIncome']) ?></span></div>

            </div>
            <hr><hr>
        </div>
        <div class="panel-body pull-right">
            <input type="button" value="Back" onClick="history.go(-1);
                    return true;" class="btn btn-primary" id="backButton">
            <input type="button" value="Next" class="btn btn-primary" id="toExpenseForm">
        </div>
    </div>
</div>
<script type = "text/javascript">
    $("#toExpenseForm").on("click", function ()
    {
        window.location.href = "index.php?editexpensebudget";
    });

</script>
