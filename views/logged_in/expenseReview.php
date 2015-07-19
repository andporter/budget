<?php

function getForm($CategoryParentType, $CategoryParentOrder)
{
    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    if ($_SESSION['user_type'] == "Regular")
    { //join and compare their userId
        $sql = $db_connection->prepare("SELECT b.userId, b.budgetId, cp.categoryParentType, cp.categoryParentOrder, cp.categoryParentName, c.categoryId, c.categoryOrder, c.categoryName, c.categoryHoverToolTip, c.calculatorType, bd.budgetDetailId, bd.budgetSelfAmount, bd.budgetSpouseAmount
                                    FROM categoryParent cp
                                    JOIN category c ON (cp.categoryParentId = c.categoryParentId)
                                    JOIN budgetDetail bd ON (c.categoryId = bd.categoryId)
                                    JOIN budget b ON (bd.budgetId = b.budgetId)
                                    JOIN users u ON (b.userId = u.userId)
                                    WHERE cp.categoryParentOrder = :categoryParentOrder
                                    AND cp.categoryParentType = :categoryParentType
                                    AND b.userId = :userId
                                    AND b.budgetId = :budgetId
                                    AND bd.budgetSelfAmount = :selfAmount
                                    AND bd.budgetSpouseAmount = :spouseAmount
                                    ORDER BY c.categoryOrder");
        $sql->bindParam(':userId', $_SESSION['user_id']);
    } elseif ($_SESSION['user_type'] == "Admin")
    { //does not care to join or compare the userId
        $sql = $db_connection->prepare("SELECT b.userId, b.budgetId, cp.categoryParentType, cp.categoryParentOrder, cp.categoryParentName, c.categoryId, c.categoryOrder, c.categoryName, c.categoryHoverToolTip, c.calculatorType, bd.budgetDetailId, bd.budgetSelfAmount, bd.budgetSpouseAmount
                                    FROM categoryParent cp
                                    JOIN category c ON (cp.categoryParentId = c.categoryParentId)
                                    JOIN budgetDetail bd ON (c.categoryId = bd.categoryId)
                                    JOIN budget b ON (bd.budgetId = b.budgetId)
                                    WHERE cp.categoryParentOrder = :categoryParentOrder
                                    AND cp.categoryParentType = :categoryParentType
                                    AND b.budgetId = :budgetId
                                    ORDER BY c.categoryOrder");
    }
    $sql->bindParam(':categoryParentOrder', $CategoryParentOrder);
    $sql->bindParam(':categoryParentType', $CategoryParentType);
    $sql->bindParam(':budgetId', $_SESSION['user_budgetid']);

    if ($sql->execute())
    {
        $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (empty($ResultsToReturn))
        {
            echo "<div class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error: </strong>" . "This budget doesn't exist, or you don't have permission to view it!";
            echo "</div>";
            echo "</div>";
            exit();
        }
    }
    ?>
    <div>
        <?php
        echo '<h4 class="panel-title>';
        echo '<a href="#' . $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"] . '" aria-expanded="true" aria-controls="' . $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"] . '" ><b>';
        echo $ResultsToReturn[0]["categoryParentOrder"] . ". " . $ResultsToReturn[0]["categoryParentName"];
        echo '</b></a>';
        echo '</h4>';
        ?>
        <div id="<?php echo $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"]; ?>"  >
            <div class='panel-body'>
                <form class='form-horizontal' role='form' id='<?php echo $CategoryParentType . $CategoryParentOrder ?>'>
                    <?php
                    foreach ($ResultsToReturn as $row)
                    {
                        ?>
                        <div class = 'form-group'>
                            <h5 class = 'control-label col-sm-6' for = 'self_<?php echo $row["categoryId"] ?>'><?php echo $row["categoryOrder"] . '. ' . $row["categoryName"] ?></h5>
                            <div class = 'input-group input-group-unstyled'>
                                <div class = 'col-sm-1'>
                                    <p>$ </p>
                                </div>
                                <div class = 'col-sm-3'>
                                    <span><?php echo $row["selfAmount"] + $row["spouseAmount"]; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    echo '<div class="col-sm-6"><h5><u>Total ' . $ResultsToReturn[0]["categoryParentName"] . '</u></h5></div>';
                    echo '<div class="col-sm-6">$ ' . 'SUM' . '</div>';
                    ?>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<div class = 'container theme-showcase'>
    <h1>Functional Expense Review</h1>
    <?php
    getForm("Income", 1);
    getForm("Income", 2);
    getForm("Income", 3);
    getForm("Expense", 1);
    getForm("Expense", 2);
    getForm("Expense", 3);
    getForm("Expense", 4);
    getForm("Expense", 5);
    getForm("Expense", 6);
    getForm("Expense", 7);
    getForm("Expense", 8);
    getForm("Expense", 9);
    ?>
</div>