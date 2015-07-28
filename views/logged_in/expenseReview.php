<?php

include 'review.php';
echo '<div id="expenseReview"><div class = "container theme-showcase"><h2>Functional Expense Review</h2>';

function getForm($CategoryParentType, $CategoryParentOrder)
{
    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
    echo '<hr><h4 class="panel-title"><b>' . $ResultsToReturn[0]["categoryParentName"] . '</b></h4><div class="panel-body">';
    foreach ($ResultsToReturn as $row)
    {
        $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
        $subtotal += $total;
        $GLOBALS['totalExpense'] += $total;
        echo '<div class = "row"><div class="col-sm-5"><span>' . $row["categoryName"] . '</span></div><div class = "col-sm-3"><span>$&nbsp' . $total;
        echo '</span></div></div>';
    }
    echo '<div class="row"><div class="col-sm-5"><h5><u>Total&nbsp' . $ResultsToReturn[0]["categoryParentName"] . '</u></h5></div>
            <div class="col-sm-1"><u>$&nbsp' . $subtotal . '</u></div><div class="col-sm-2"><u>' . number_format($subtotal / $GLOBALS['grossIncome'] * 100) . '&nbsp%</u></div></div></div>';
}

for ($i = 1; $i <= 9; $i++)
{
    $total = 0;
    getForm("Expense", $i);
}

echo '<hr><hr><div class="row"><h4 class="panel-title col-sm-5"><b>Total Expenses</b>
            </h4><div class="col-sm-3"><span>$&nbsp' . $totalExpense . '</span></div></div><div class="panel-body">
            <input type="button" value="Next" class="btn btn-primary pull-right" onclick="changeForm()" id="nextReview"></div><br></div></div>';
?>