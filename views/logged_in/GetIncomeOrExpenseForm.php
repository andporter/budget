<?php
include('Calculator.php');
include('GetDB.php');

function getIncomeOrExpenseForm($CategoryParentType, $CategoryParentOrder)
{
    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
    $panelId = $ResultsToReturn[0]["categoryParentOrder"];
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?php echo $panelId . ". " . $ResultsToReturn[0]["categoryParentName"]; ?>
            </h4>
        </div>
        <div id="panel<?php echo $CategoryParentType.$panelId; ?>" class="panel-collapse collapse<?php if ($panelId == 1){echo ' in';}?>" >
            <div class="panel-body">
                <form class='form-horizontal' role='form' id='<?php echo $CategoryParentType . $CategoryParentOrder ?>'>
                    <?php
                    foreach ($ResultsToReturn as $row)
                    {
                        ?>
                        <div class = 'form-group'>
                            <label class = 'control-label col-sm-5' for = 'self_<?php echo $row["categoryId"] ?>'><?php echo $row["categoryOrder"] . '. Monthly ' . $row["categoryName"] ?></label>
                            <div class = 'input-group input-group-unstyled'>
                                <div class = 'col-sm-1'>
                                    <span class='input-group-addon glyphicon glyphicon-info-sign' rel='tooltip' title='<?php echo $row["categoryHoverToolTip"] ?>'></span>
                                </div>
                                <div class = 'col-sm-3'>
                                    <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Self $$' value='<?php echo $row["budgetSelfAmount"] ?>' id = 'self_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>' name = 'self_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>' <?php if ($row["isBaseline"] == "1"){echo "readonly";} ?>></input>
                                </div>
                                <div class = 'col-sm-1'>
                                    <?php
                                    if ($row["isBaseline"] == "0")
                                    {
                                        $x = "self_" . $row["budgetDetailId"] . "_" . $row["categoryId"];
                                        $$x = new Calculator($row["calculatorType"], $x);
                                        echo $$x->drawCalculator();
                                    }
                                    ?>
                                </div>
                                <div class = 'col-sm-3'>
                                    <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Spouse $$' value='<?php echo $row["budgetSpouseAmount"] ?>' id = 'spouse_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>' name = 'spouse_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>'<?php if ($row["isBaseline"] == "1"){echo "readonly";} ?>></input>
                                </div>
                                <div class = 'col-sm-1'>
                                    <?php
                                    if ($row["isBaseline"] == "0")
                                    {
                                        $y = "spouse_" . $row["budgetDetailId"] . "_" . $row["categoryId"];
                                        $$y = new Calculator($row["calculatorType"], $y);
                                        echo $$y->drawCalculator();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class='form-group'>
                        <div class='col-sm-12'>
                            <?php if ($panelId != 1){?>
                            <input type="button" value="Back" class="btn btn-primary" onclick="submitForm(this.form)" id="prev<?php echo $CategoryParentType.$panelId; ?>">
                            <?php } ?>
                            <input type="button" value="Next" class="btn btn-primary pull-right" onclick="submitForm(this.form)" id="next<?php echo $CategoryParentType.$panelId; ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type = "text/javascript">
        $("#next<?php echo $CategoryParentType . $panelId; ?>").on("click", function() 
            {
                var numIncome = <?php echo getNumberOfParentCategories("Income"); ?>;
                var numExpense = <?php echo getNumberOfParentCategories("Expense"); ?>;
                if (this.id === "nextIncome" + numIncome)
                {
                    window.location.href = "index.php?budgetreview=income"
                }
                else if (this.id === "nextExpense" + numExpense)
                {
                    window.location.href = "index.php?budgetreview=expense"
                }
                else
                {
                    $("#panel<?php echo $CategoryParentType . $panelId; ?>").collapse('hide');
                    $("#panel<?php echo $CategoryParentType . ($panelId + 1); ?>").collapse('show');
                }
            });
            
        $("#prev<?php echo $CategoryParentType . $panelId; ?>").on("click", function() 
            {
                $("#panel<?php echo $CategoryParentType . $panelId; ?>").collapse('hide');
                $("#panel<?php echo $CategoryParentType . ($panelId - 1); ?>").collapse('show');
            });
    </script>
    <br>
    <?php
}
