<?php
require_once('Calculator.php');
 $formname;
function getForm($CategoryParentType, $CategoryParentOrder) {
    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $sql = $db_connection->prepare("SELECT u.userId, b.budgetId, cp.categoryParentType, cp.categoryParentOrder, cp.categoryParentName, c.categoryId, c.categoryOrder, c.categoryName, c.categoryHoverToolTip, c.calculatorType, bd.amount, bd.spouseAmount
                                    FROM categoryParent cp
                                    JOIN category c ON (cp.categoryParentId = c.categoryParentId)
                                    JOIN budgetDetail bd ON (c.categoryId = bd.categoryId)
                                    JOIN budget b ON (bd.budgetId = b.budgetId)
                                    JOIN users u ON b.userId = u.userId
                                    WHERE cp.categoryParentOrder = :categoryParentOrder
                                    AND cp.categoryParentType = :categoryParentType
                                    AND u.userId = :userId
                                    AND b.budgetId = :budgetId
                                    ORDER BY c.categoryOrder;");

    $sql->bindParam(':categoryParentOrder', $CategoryParentOrder);
    $sql->bindParam(':categoryParentType', $CategoryParentType);
    $sql->bindParam(':userId', $_SESSION['user_id']);
    $sql->bindParam(':budgetId', $_SESSION['user_budgetid']);

    if ($sql->execute()) {
        $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
//        print_r($ResultsToReturn);
        
    $formname = $CategoryParentType . $CategoryParentOrder;   
    } else {
        exit("You do not have permission to edit this budget!");
    }
    ?>
    <style>
        #budgetTitles{
            color: white;
        }   

    </style>

    <div class='container theme-showcase'>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-primary">
                <div class="panel-heading">

                    <?php
                    echo'<h3 class="panel-title" id="budgetTitles">';
                    echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#' . $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"] . '" >';

                    echo $ResultsToReturn[0]["categoryParentOrder"] . ". " . $ResultsToReturn[0]["categoryParentName"];

                    echo '</a>';
                    echo'</h3>';
                    ?>

                </div>

                <?php
                if ($ResultsToReturn[0]["categoryParentOrder"] == 1 && $ResultsToReturn[0]["categoryParentName"] == "Monthly Earned Income") {
                    echo '<div id="' . $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"]
                    . '" class="panel-collapse collapse in" ' . ' >';
                } else {
                    echo '<div id="' . $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"]
                    . '" class="panel-collapse collapse " ' . ' >';
                }
                ?>
                <div class='panel-body'>
                    <form class='form-horizontal' role='form' id='<?php echo $CategoryParentType . $CategoryParentOrder ?>'>
                        <?php
                        foreach ($ResultsToReturn as $row) {
                            ?>
                            <div class = 'form-group'>
                                <label class = 'control-label col-sm-5' for = 'self_<?php echo $row["categoryId"] ?>'><?php echo $row["categoryOrder"] . '. ' . $row["categoryName"] ?></label>
                                <div class = 'input-group input-group-unstyled'>
                                    <div class = 'col-sm-1'>
                                        <span class='input-group-addon glyphicon glyphicon-info-sign' rel='tooltip' title='<?php echo $row["categoryHoverToolTip"] ?>'></span>
                                    </div>
                                    <div class = 'col-sm-3'>
                                        <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Self $$' value='' id = 'self_<?php echo $row["categoryId"] ?>' name = 'self_<?php echo $row["categoryId"] ?>'></input>
                                    </div>
                                    <div class = 'col-sm-1'>
                                        <?php
                                        $x = "self_" . $row["categoryId"];
                                        $$x = new Calculator($row["calculatorType"], $x);
                                        echo $$x->drawCalculator();
                                        ?>
                                    </div>
                                    <div class = 'col-sm-3'>
                                        <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Spouse $$' value='' id = 'spouse_<?php echo $row["categoryId"] ?>' name = 'spouse_<?php echo $row["categoryId"] ?>'></input>
                                    </div>
                                    <div class = 'col-sm-1'>
                                        <?php
                                        $y = "spouse_" . $row["categoryId"];
                                        $$y = new Calculator($row["calculatorType"], $y);
                                        echo $$y->drawCalculator();
                                        ?>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php } ?>

                        <div class='form-group'>
                            <div class='col-sm-offset-2 col-sm-10'>
                                <input type=Button value="Next" class="btn btn-primary pull-right" onclick='serialize(this.form)'/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
        </div>
    
    </div>
</div>
<?php } ?>

<body>
    <div class='container theme-showcase'>
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

    <script type = "text/javascript">

        $(function () {
            $("[rel=tooltip]").tooltip({
                placement: 'right',
                container: 'body'
            });

            

        });
        
        function serialize(form)
        {
            console.log($(form).serializeArray());
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }

    </script>

</body>
