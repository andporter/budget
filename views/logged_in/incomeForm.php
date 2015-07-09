<?php

function getForm($CategoryParentType, $CategoryParentOrder) {
    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $sql = $db_connection->prepare("SELECT cp.categoryParentType, cp.categoryParentOrder, cp.categoryParentName, c.categoryId, c.categoryOrder, c.categoryName, c.categoryHoverToolTip, c.calculatorType
                                    FROM categoryParent cp
                                    LEFT JOIN category c ON c.categoryParentId = cp.categoryParentId
                                    WHERE cp.categoryParentOrder = :categoryParentOrder 
                                    AND cp.categoryParentType = :categoryParentType
                                    ORDER BY c.categoryOrder");
    $sql->bindParam(':categoryParentOrder', $CategoryParentOrder);
    $sql->bindParam(':categoryParentType', $CategoryParentType);

    if ($sql->execute()) {
        $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($sql->errorInfo());
        $ResultsToReturn;
    }
    ?>
<style>
    #budgetTitles{
        color: white;
    }   
    
</style>

    <!--<div class='panel panal-content panel-primary'>-->
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingOne">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"] 
                            ?>" aria-expanded="true" aria-controls="<?php echo $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"] ?>">
                        <h3 class='panel-title' id="budgetTitles"><?php echo $ResultsToReturn[0]["categoryParentOrder"] . ". " . $ResultsToReturn[0]["categoryParentName"] ?></h3>
                    </a>
                </div>
                <div id="<?php echo $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"] 
                            ?>" aria-expanded="true" aria-controls="<?php echo $ResultsToReturn[0]["categoryParentOrder"] . 
                                    $ResultsToReturn[0]["categoryParentType"] ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
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
                                            <?php echo getCalculator($row["calculatorType"]); ?>
                                        </div>
                                        <div class = 'col-sm-3'>
                                            <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Spouse $$' value='' id = 'spouse_<?php echo $row["categoryId"] ?>' name = 'spouse_<?php echo $row["categoryId"] ?>'></input>
                                        </div>
                                        <div class = 'col-sm-1'>
                                            <?php echo getCalculator($row["calculatorType"]); ?>
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
<!--</div>-->
<?php } ?>

<?php

function getCalculator($calcType) {
    if ($calcType == 'MonthlyWage') {
        echo '<span><button type="button" class="btn btn-info" data-toggle="modal" data-target="#wageCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
    } elseif ($calcType == 'MonthlySE') {
        echo '<span><button type="button" class="btn btn-info" data-toggle="modal" data-target="#seCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
    } elseif ($calcType == 'NonMonthly') {
        echo '<span><button type="button" class="btn btn-info" data-toggle="modal" data-target="#nonMonthlyCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
    } else {
        echo '<span class="input-group-addon glyphicon glyphicon-modal-window"></span>';
    }
}
?>

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

    <div class='container theme-showcase'>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
            <div class = "panel panel-primary">
                <div class = "panel-heading" role = "tab" id = "headingTwo">
                    <h4 class = "panel-title">
                        <a class = "collapsed" role = "button" data-toggle = "collapse" data-parent = "#accordion" href = "#collapseTwo" aria-expanded = "false" aria-controls = "collapseTwo">
                            Collapsible Group Item #2
                        </a>
                    </h4>
                </div>
                <div id = "collapseTwo" class = "panel-collapse collapse" role = "tabpanel" aria-labelledby = "headingTwo">
                    <div class = "panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Collapsible Group Item #3
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type = "text/javascript">

        $(function () {
            $("[rel=tooltip]").tooltip({placement: 'right'});

            $('#Income1').submit(function (e)
            {
                e.preventDefault();
                console.log($(this).serializeArray());
            });
        });

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }

        $('#wageCalcModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-title').text('Wage Calculator');
            modal.find('.modal-body input').val(recipient);
        });

        $('#seCalcModal').on('show.bs.modal', function (event) {

        });

        $('#nonMonthlyCalcModal').on('show.bs.modal', function (event) {

        });

        //$('#wageCalcModal').modal(options);

    </script>

    <!-- Wage Calculator Modal-->
    <div class="modal fade" id="wageCalcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Wage Calculator</h4>
                </div>
                <div class="modal-body">
                    <form class="navbar-form">
                        <div class="form-group">
                            <input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="dollars-per-hour" placeholder="$ Per Hour"> <span>X</span> <input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="hours-per-week" placeholder="Hours Per Week">
                        </div><button type="button" class="btn btn-primary">Submit</button>
                    </form>
                    <form class="navbar-form">
                        <div class="form-group">
                            <input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="salary" placeholder="Salary $">
                        </div><button type="button" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Modal-->

    <!-- Self-Employed Calculator Modal-->
    <div class="modal fade" id="seCalcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Self-Employment Calculator</h4>
                </div>
                <div class="modal-body">
                    <form class="navbar-form">
                        <div class="form-group">
                            <input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="typical-month-income" placeholder="Typical Month's $">
                        </div><button type="button" class="btn btn-primary">Submit</button>
                    </form>
                    <form class="navbar-form">
                        <div class="form-group">
                            <input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="last-year-taxes" placeholder="Last Year's Taxes $">
                        </div><button type="button" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Modal-->

    <!-- Non-Monthly Calculator Modal -->
    <div class="modal fade" id="nonMonthlyCalcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Non-Monthly Calculator</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <form class="navbar-form">
                                    <div class="form-group" style="text-align: center;">
                                        <label class = 'control-label'>Estimate for the Year</label>
                                        <input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="estimate-for-year" placeholder="$">
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-8">
                                <form class="navbar-form">
                                    <div class="form-group">
                                        <div class="col-sm-12" style="text-align: center;"><label class = 'control-label'>Frequency Method</label></div>
                                        <div class="col-sm-6"><label class = 'control-label'>Times per Year:</label></div>
                                        <div class="col-sm-6"><input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="times-per-year" placeholder="Times Per Year #"></div>
                                        <div class="col-sm-6"><label class = 'control-label'>Cost per Time:</label></div>
                                        <div class="col-sm-6"><input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="cost-per-time" placeholder="Cost Per Time $"></div>
                                        <div class="col-sm-6"><label class = 'control-label'>Yearly Estimate:</label></div>
                                        <div class="col-sm-6"><input type="number" onkeypress='return isNumberKey(event);' class="form-control" id="yearly-estimate" placeholder="Yearly Estimate $"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Modal-->

</body>