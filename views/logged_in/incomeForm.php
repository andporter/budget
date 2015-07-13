<?php

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
                                <input type="submit" value="Next" class="btn btn-primary pull-right" />
                            </div>
                        </div>
                    </form>
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

    <?php
    /*
     * Calculator class for all calculators needed for the budget
     */

    class Calculator {

        private $calcType;
        private $calcId;

        public function __construct($type, $id) {
            $this->calcType = $type;
            $this->calcId = $id;
        }

        public function drawCalculator() {
            if ($this->calcType === 'MonthlyWage') {
                return '<span><button type="button" class="btn btn-info" id="' . $this->calcId . 'm" data-toggle="modal" data-target="#wageCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
            } elseif ($this->calcType === 'MonthlySE') {
                return '<span><button type="button" class="btn btn-info" id="' . $this->calcId . 'm" data-toggle="modal" data-target="#seCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
            } elseif ($this->calcType === 'NonMonthly') {
                return '<span><button type="button" class="btn btn-info" id="' . $this->calcId . 'm" data-toggle="modal" data-target="#nonMonthlyCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
            } else {
                return '<span class="input-group-addon glyphicon glyphicon-modal-window"></span>';
            }
        }

    }
    ?>

    <!--Wage Calculator Modal-->
    <div class = "modal fade" id = "wageCalcModal" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalLabel">
        <div class = "modal-dialog" role = "document">
            <div class = "modal-content">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close"><span aria-hidden = "true">&times;
                        </span></button>
                    <h4 class = "modal-title">Wage Calculator</h4>
                </div>
                <div class = "modal-body">
                    <form class = "navbar-form">
                        <div class = "form-group">
                            <input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "dollars-per-hour" placeholder = "$ Per Hour">
                            <span>X</span>
                            <input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "hours-per-week" placeholder = "Hours Per Week">
                        </div><button type = "button" id = "wageSubmit" class = "btn btn-primary">Submit</button>
                    </form>
                    <form class = "navbar-form">
                        <div class = "form-group">
                            <input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "salary" placeholder = "Salary $">
                        </div><button type = "button" id = "salarySubmit" class = "btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--End Wage Modal-->

    <!--Self-Employed Calculator Modal-->
    <div class = "modal fade" id = "seCalcModal" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalLabel2">
        <div class = "modal-dialog" role = "document">
            <div class = "modal-content">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close"><span aria-hidden = "true">&times;
                        </span></button>
                    <h4 class = "modal-title">Self-Employment Calculator</h4>
                </div>
                <div class = "modal-body">
                    <form class = "navbar-form">
                        <div class = "form-group">
                            <input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "typical-month-income" placeholder = "Typical Month's $">
                        </div>
                        <button type = "button" id = "seMonthSubmit" class = "btn btn-primary">Submit</button>
                    </form>
                    <form class = "navbar-form">
                        <div class = "form-group">
                            <input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "last-year-taxes" placeholder = "Last Year's Taxes $">
                        </div>
                        <button type = "button" id = "seTaxSubmit" class = "btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--End SE Modal-->

    <!--Non-Monthly Calculator Modal -->
    <div class = "modal fade" id = "nonMonthlyCalcModal" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalLabel3">
        <div class = "modal-dialog" role = "document">
            <div class = "modal-content">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close"><span aria-hidden = "true">&times;
                        </span></button>
                    <h4 class = "modal-title">Non-Monthly Calculator</h4>
                </div>
                <div class = "modal-body">
                    <div class = "container-fluid">
                        <div class = "row">
                            <div class = "col-sm-4">
                                <form class = "navbar-form">
                                    <div class = "form-group" style = "text-align: center;">
                                        <label class = 'control-label'>Estimate for the Year</label>
                                        <input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "estimate-for-year" placeholder = "$">
                                    </div>
                                </form>
                                <button type = "button" id = "nonMonthlyTotalSubmit" class = "btn btn-primary pull-right">Submit</button>
                            </div>
                            <div class = "col-sm-8">
                                <form class = "navbar-form">
                                    <div class = "form-group">
                                        <div class = "col-sm-12" style = "text-align: center;"><label class = 'control-label'>Frequency Method</label></div>
                                        <div class = "col-sm-6"><label class = 'control-label'>Times per Year:</label></div>
                                        <div class = "col-sm-6"><input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "times-per-year" placeholder = "Times Per Year #"></div>
                                        <div class = "col-sm-6"><label class = 'control-label'>Cost per Time:</label></div>
                                        <div class = "col-sm-6"><input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "cost-per-time" placeholder = "Cost Per Time $"></div>
                                    </div>
                                </form>
                                <button type = "button" id = "nonMonthlySubmit" class = "btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Non-Monthly Modal-->


    <script type = "text/javascript">

        $(function () {
            $("[rel=tooltip]").tooltip({
                placement: 'right',
                container: 'body'
            });

            $('#Income1').submit(function (e) {
                e.preventDefault();
                console.log($(this).serializeArray());
            });

        });
        // Calculator functions and variables 
        var button = '';
        var bId = '';
        var total = 0;

        // set modals to identify the button that prompted the modal
        $('#wageCalcModal').on('show.bs.modal', function (event) {
            button = $(event.relatedTarget);
        });

        $('#seCalcModal').on('show.bs.modal', function (event) {
            button = $(event.relatedTarget);
        });

        $('#nonMonthlyCalcModal').on('show.bs.modal', function (event) {
            button = $(event.relatedTarget);
        });

        // calculator functions
        $('#wageSubmit').click(function () {
            var x = document.getElementById('dollars-per-hour').value;
            var y = document.getElementById('hours-per-week').value;
            total = x * y * 52 / 12;
            setBId();
            $('#wageCalcModal').modal('hide');
            document.getElementById('dollars-per-hour').value = null;
            document.getElementById('hours-per-week').value = null;
            document.getElementById('salary').value = null;
        });

        $('#salarySubmit').click(function () {
            total = document.getElementById('salary').value / 2080 * 40 * 52 / 12;
            setBId();
            $('#wageCalcModal').modal('hide');
            document.getElementById('dollars-per-hour').value = null;
            document.getElementById('hours-per-week').value = null;
            document.getElementById('salary').value = null;
        });

        $('#seMonthSubmit').click(function () {
            total = document.getElementById('typical-month-income').value * 1;
            setBId();
            $('#seCalcModal').modal('hide');
            document.getElementById('typical-month-income').value = null;
            document.getElementById('last-year-taxes').value = null;
        });

        $('#seTaxSubmit').click(function () {
            total = document.getElementById('last-year-taxes').value / 12;
            setBId();
            $('#seCalcModal').modal('hide');
            document.getElementById('typical-month-income').value = null;
            document.getElementById('last-year-taxes').value = null;
        });

        $('#nonMonthlyTotalSubmit').click(function () {
            total = document.getElementById('estimate-for-year').value / 12;
            setBId();
            $('#nonMonthlyCalcModal').modal('hide');
            document.getElementById('estimate-for-year').value = null;
            document.getElementById('times-per-year').value = null;
            document.getElementById('cost-per-time').value = null;
        });

        $('#nonMonthlySubmit').click(function () {
            total = document.getElementById('times-per-year').value * document.getElementById('cost-per-time').value / 12;
            setBId();
            $('#nonMonthlyCalcModal').modal('hide');
            document.getElementById('estimate-for-year').value = null;
            document.getElementById('times-per-year').value = null;
            document.getElementById('cost-per-time').value = null;
        });
        
        function setBId() {
            bId = button.attr('id');
            bId = bId.substr(0, bId.length - 1);
            document.getElementById(bId).value = total.toFixed(2);
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }

        // end Calculator functions

    </script>

</body>
