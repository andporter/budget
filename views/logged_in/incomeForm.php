<?php
include('Calculator.php');
include('GetDB.php');

function getForm($CategoryParentType, $CategoryParentOrder)
{
    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
    $accordionId = $ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"];
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading" role="tab" id="accordion<?php echo $accordionId; ?>" >
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $accordionId; ?>" aria-expanded="true" aria-controls="<?php echo $accordionId; ?>" >
                    <?php echo $ResultsToReturn[0]["categoryParentOrder"] . ". " . $ResultsToReturn[0]["categoryParentName"]; ?>
                </a>
            </h4>
        </div>
        <div id="<?php echo $accordionId; ?>" class="panel-collapse collapse<?php
        if ($ResultsToReturn[0]["categoryParentOrder"] == 1 && $ResultsToReturn[0]["categoryParentName"] == "Monthly Earned Income")
        {
            echo ' in';
        }
        ?>" role="tabpanel" aria-labelledby="accordion<?php echo $accordionId; ?>" >
            <div class='panel-body'>
                <form class='form-horizontal' role='form' id='<?php echo $CategoryParentType . $CategoryParentOrder ?>'>
                    <?php
                    foreach ($ResultsToReturn as $row)
                    {
                        ?>
                        <div class = 'form-group'>
                            <label class = 'control-label col-sm-5' for = 'self_<?php echo $row["categoryId"] ?>'><?php echo $row["categoryOrder"] . '. ' . $row["categoryName"] ?></label>
                            <div class = 'input-group input-group-unstyled'>
                                <div class = 'col-sm-1'>
                                    <span class='input-group-addon glyphicon glyphicon-info-sign' rel='tooltip' title='<?php echo $row["categoryHoverToolTip"] ?>'></span>
                                </div>
                                <div class = 'col-sm-3'>
                                    <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Self $$' value='<?php echo $row["budgetSelfAmount"] ?>' id = 'self_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>' name = 'self_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>' <?php if ($row["isBaseline"] == "1"){echo "readonly";} ?>></input>
                                </div>
                                <div class = 'col-sm-1'>
                                    <?php
                                    $x = "self_" . $row["budgetDetailId"] . "_" . $row["categoryId"];
                                    $$x = new Calculator($row["calculatorType"], $x);
                                    echo $$x->drawCalculator();
                                    ?>
                                </div>
                                <div class = 'col-sm-3'>
                                    <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Spouse $$' value='<?php echo $row["budgetSpouseAmount"] ?>' id = 'spouse_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>' name = 'spouse_<?php echo $row["budgetDetailId"] . '_' . $row["categoryId"] ?>'<?php if ($row["isBaseline"] == "1"){echo "readonly";} ?>></input>
                                </div>
                                <div class = 'col-sm-1'>
                                    <?php
                                    $y = "spouse_" . $row["budgetDetailId"] . "_" . $row["categoryId"];
                                    $$y = new Calculator($row["calculatorType"], $y);
                                    echo $$y->drawCalculator();
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class='form-group'>
                        <div class='col-sm-offset-2 col-sm-10'>
                            <input type="button" value="Next" class="btn btn-primary pull-right" onclick="submitForm(this.form, this)" id="next<?php echo ($ResultsToReturn[0]["categoryParentOrder"] . $ResultsToReturn[0]["categoryParentType"]); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <?php
}
?>
<div class='container theme-showcase'>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        for ($i = 1; $i <= 3; $i++)
        {
            getForm("Income", $i);
        }
        for ($i = 1; $i <= 9; $i++)
        {
            getForm("Expense", $i);
        }
        ?>
    </div>
</div>
<script type = "text/javascript">
 /*   
    $(".panel").click(function() {
    $(this).closest(".container").find(".panel").slideToggle();
});
*/
$(".btn").click(function() {
    $(this).closest(".panel").find(".panel-collapse").collapse('hide');
    //$(this).next().collapse('show');
    //var next;
      //next = $(this).parent().next().find(".panel-collapse");
      //$("html, body").scrollTop(next.offset().top);
});


    function submitForm(form, id) {
        var postJSONData = $(form).serializeArray();
        postJSONData = JSON.stringify(postJSONData);
        SendAjax("api/api.php?method=userBudgetFormSubmit", postJSONData, "none", true);
//            var nextId = (id.id).toString();
//            nextId = nextId.substr(4, nextId.length - 1);
//            var num = nextId.charAt(0);
//            var x = parseInt(num);
//            var prevId = "#accordion" + x + nextId.substr(1, nextId.length - 1);
//            ++x;
//            nextId = "#accordion" + x + nextId.substr(1, nextId.length - 1);
//            $(prevId).collapse('hide');
//            $(prevId).on('hidden', function () {
//                $(nextId).collapse('show');
//            })
    }
</script>