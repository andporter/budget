<?php

include 'review.php';
echo '<div id="incomeReview"><div class = "container theme-showcase"><div class="row"><h2 class="col-sm-5">Income Review</h2></div>';

function getForm($CategoryParentType, $CategoryParentOrder)
{
    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
    echo '<hr><h4 class="panel-title"><b>' . $ResultsToReturn[0]["categoryParentName"] . '</b></h4><div class="panel-body">';
    foreach ($ResultsToReturn as $row)
    {
        echo '<div class = "row"><div class="col-sm-5"><span>' . $row["categoryName"] . '</span></div><div class = "col-sm-3"><span>$&nbsp';
        $total = $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
        //$percentages[$ResultsToReturn[0]["categoryParentName"] . "percent'] = number_format($total / $sumtotal * 100.0, 2);
        echo $total . '</span></div></div>';
        $subtotal += $total;
    }
    echo '<div class="row"><div class="col-sm-5"><h5><u>Total&nbsp' . $ResultsToReturn[0]["categoryParentName"] . '</u></h5></div>
        <div class="col-sm-1" id="' . $ResultsToReturn[0]["categoryParentName"] . 'total' . '"><u>$&nbsp' . $subtotal .
    '</u></div><div class="col-sm-2" id="' . $ResultsToReturn[0]["categoryParentName"] . 'percent"><u>' . number_format($subtotal / $GLOBALS['grossIncome'] * 100) . '&nbsp%</u></div></div></div>';
}

for ($i = 1; $i <= 3; $i++)
{
    $grossIncome += $subtotal;
    $total = 0;
    getForm("Income", $i);
}
echo '<hr><hr><div><div class="row"><h4 class="panel-title col-sm-5"><b>Gross Income</b></h4><div class="col-sm-1"><span>$&nbsp' . $grossIncome . '</span></div></div>
      <div class="row"><div class="panel-body col-sm-5"><span>Less Federal and State Income Taxes</span></div><div class="col-sm-1"><font color="red"><span>$&nbsp' . $tax . '</span></div>
      <div class="col-sm-1"><span>' . number_format($GLOBALS['tax'] / $GLOBALS['grossIncome'] * 100) . '&nbsp%</span></font></div></div><hr><div class="row">';
$netIncome = $grossIncome - $tax;
echo '<h4 class="panel-title col-sm-5"><b>Net Income</b></h4><div class="col-sm-1"><span>$&nbsp' . $netIncome . '</span></div><hr><hr><input type="button" value="Next" class="btn btn-primary pull-right" onclick="changeForm()" id="toExpenseReview">';
?>

