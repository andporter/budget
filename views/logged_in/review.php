<?php

$grossIncome = 0.0;
$tax = 0.0;
$totalExpense = 0.0;
$subtotal = 0.0;
$total = 0.0;
$net = 0.0;

include'getDB.php';

// get gross income for all reviews
for ($i = 1; $i <= 3; $i++)
{
    $ResultsToReturn = getDB('Income', $i);
    foreach ($ResultsToReturn as $row)
    {
        $grossIncome += $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
    }
}

// get federal and state withholdings (for net income review)
for ($i = 1; $i <= 2; $i++)
{
    $ResultsToReturn = getDB('Expense', $i);
    foreach ($ResultsToReturn as $row)
    {
        $tax += $row["budgetSelfAmount"] + $row["budgetSpouseAmount"];
    }
}
?>