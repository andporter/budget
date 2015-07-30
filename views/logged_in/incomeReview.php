<?php include('review.php'); ?>

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
                        <div class = "col-sm-3"><span>$&nbsp<?php
                                $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
                                echo $total;
                                ?></span>
                        </div>
                    </div><?php
                    $GLOBALS['subtotal'] += $total;
                }
                ?>
                <div class="row">
                    <div class="col-sm-5"><h5><u>Total&nbsp<?php echo $ResultsToReturn[0]["categoryParentName"] ?></u></h5></div>
                    <div class="col-sm-1" <?php echo 'id="' . $ResultsToReturn[0]["categoryParentName"] . 'total"' ?>>
                        <u>$&nbsp<?php echo $GLOBALS['subtotal'] ?></u>
                    </div>
                    <div class="col-sm-2" <?php echo 'id="' . $ResultsToReturn[0]["categoryParentName"] . 'percent"' ?>>
                        <u><?php echo number_format($GLOBALS['subtotal'] / $GLOBALS['grossIncome'] * 100) ?>&nbsp%</u>
                    </div>
                </div>
            </div><?php
        }

        for ($i = 1; $i <= 3; $i++)
        {
            $GLOBALS['subtotal'] = 0.0;
            getIncomeReviewForm("Income", $i);
        }
        ?>
        <hr><hr>
        <div>
            <div class="row">
                <h4 class="panel-title col-sm-5"><b>Gross Income</b></h4>
                <div class="col-sm-1"><span>$&nbsp<?php echo $GLOBALS['grossIncome'] ?></span></div>
                <input type="button" value="Next" class="btn btn-primary pull-right" id="toExpenseForm">
            </div>
            <hr><hr>
        </div>
    </div>
</div>
<script type = "text/javascript">
    $("#toExpenseForm").on("click", function ()
    {
        window.location.href = "index.php?editexpensebudget"
    });

</script>
