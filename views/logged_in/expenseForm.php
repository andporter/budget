<?php

function getForm($CategoryParentType, $CategoryParentOrder)
{
    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $sql = $db_connection->prepare("SELECT cp.categoryParentType, cp.categoryParentOrder, cp.categoryParentName, c.categoryOrder, c.categoryName, c.categoryHoverToolTip
                                    FROM categoryParent cp
                                    LEFT JOIN category c ON c.categoryParentId = cp.categoryParentId
                                    WHERE cp.categoryParentOrder = :categoryParentOrder and cp.categoryParentType = :categoryParentType
                                    ORDER BY c.categoryOrder");
    $sql->bindParam(':categoryParentOrder', $CategoryParentOrder);
    $sql->bindParam(':categoryParentType', $CategoryParentType);


    if ($sql->execute())
    {
        $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        print_r($sql->errorInfo());
        $ResultsToReturn;
    }

    echo "<div class='panel panal-content panel-primary'>";
    echo "<div class='panel-heading'>";
    echo "<h3 class='panel-title'>" . $ResultsToReturn[0][categoryParentOrder] . ". " . $ResultsToReturn[0][categoryParentName] . "</h3>";
    echo "</div>";
    echo "<div class='panel-body'>";
    echo "<form class='form-horizontal' role='form'>";

    foreach ($ResultsToReturn as $row)
    {
        echo "<div class = 'form-group'>";
        echo "  <label class = 'control-label col-sm-7' for = 'self_" . $row[categoryOrder] . str_replace(' ', '_', $row[categoryName]) . "'> " . $row[categoryOrder] . '. ' . $row[categoryName] . "</label>";
        echo "  <div class = 'col-sm-5 input-group input-group-unstyled'>";
        echo "      <span class='input-group-addon glyphicon glyphicon-info-sign' rel='tooltip' title='" . $row[categoryHoverToolTip] . "'></span>";
        echo "      <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Self $$' value='' required data-parsley-required-message = '' id = 'self_" . $row[categoryOrder] . str_replace(' ', '_', $row[categoryName]) . "'></input>";
        echo "      <span class='input-group-addon glyphicon glyphicon-modal-window'></span>";
        echo "      <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Spouse $$' value='' required data-parsley-required-message = '' id = 'spouse_" . $row[categoryOrder] . str_replace(' ', '_', $row[categoryName]) . "'></input>";
        echo "      <span class='input-group-addon glyphicon glyphicon-modal-window'></span>";
        echo "  </div>";
        echo "</div>";
    }

    echo "<div class='form-group'>";
    echo "<div class='col-sm-offset-2 col-sm-10'>";
    echo "<button type='submit' class='btn btn-primary pull-right'>Next</button>";
    echo "</div>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
}
?>

<body>

    <div class='container theme-showcase'>
        <?php
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


    <script type="text/javascript">
        
        $(function () {
            $("[rel=tooltip]").tooltip({placement: 'right'});
        });

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }

    </script>
</body>