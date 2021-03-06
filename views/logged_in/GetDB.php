<?php

function getNumberOfParentCategories($type)
{
    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $sql = $db_connection->prepare("SELECT COUNT(CategoryParentOrder) "
            . "FROM categoryParent "
            . "WHERE categoryParentType = '" . $type . "'");
    if ($sql->execute())
    {
        $result = $sql->fetchAll(PDO::FETCH_COLUMN);
        return $result[0];
    }
}

function getDB($CategoryParentType, $CategoryParentOrder)
{
    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    if ($_SESSION['user_type'] == "Admin") //admin user, does not care to join or compare the userId
    {
        $sql = $db_connection->prepare("SELECT b.userId, b.budgetId, '0' isBaseline, cp.categoryParentType, cp.categoryParentOrder, 
                                        cp.categoryParentName, c.categoryId, c.categoryOrder, c.categoryName, c.categoryHoverToolTip, 
                                        c.calculatorType, bd.budgetDetailId, bd.budgetSelfAmount, bd.budgetSpouseAmount
                                        FROM categoryParent cp
                                        JOIN category c ON (cp.categoryParentId = c.categoryParentId)
                                        JOIN budgetDetail bd ON (c.categoryId = bd.categoryId)
                                        JOIN budget b ON (bd.budgetId = b.budgetId)
                                        WHERE cp.categoryParentOrder = :categoryParentOrder
                                        AND cp.categoryParentType = :categoryParentType
                                        AND b.budgetId = :budgetId
                                        ORDER BY c.categoryOrder");
    } else //not admin user, join and compare their userId to filter to only show the logged in user's budget
    {
        $sql = $db_connection->prepare("SELECT b.userId, b.budgetId, b.isBaseline, cp.categoryParentType, cp.categoryParentOrder, 
                                        cp.categoryParentName, c.categoryId, c.categoryOrder, c.categoryName, c.categoryHoverToolTip, 
                                        c.calculatorType, bd.budgetDetailId, bd.budgetSelfAmount, bd.budgetSpouseAmount
                                        FROM categoryParent cp
                                        JOIN category c ON (cp.categoryParentId = c.categoryParentId)
                                        JOIN budgetDetail bd ON (c.categoryId = bd.categoryId)
                                        JOIN budget b ON (bd.budgetId = b.budgetId)
                                        JOIN users u ON (b.userId = u.userId)
                                        WHERE cp.categoryParentOrder = :categoryParentOrder
                                        AND cp.categoryParentType = :categoryParentType
                                        AND b.userId = :userId
                                        AND b.budgetId = :budgetId
                                        ORDER BY c.categoryOrder");

        $sql->bindParam(':userId', $_SESSION['user_id']);
    }

    $sql->bindParam(':categoryParentOrder', $CategoryParentOrder);
    $sql->bindParam(':categoryParentType', $CategoryParentType);
    $sql->bindParam(':budgetId', $_SESSION['user_budgetid']);

    if ($sql->execute())
    {
        $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    if (empty($ResultsToReturn))
    {
        echo "<div class=\"container theme-showcase\"><div class=\"alert alert-danger\" role=\"alert\"><strong>Error: </strong>" . "This budget doesn't exist, or you don't have permission to view it!</div></div>";
        exit();
    }
    return $ResultsToReturn;
}
