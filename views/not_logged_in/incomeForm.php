<?php
if (isset($login))
{ // show potential errors / feedback (from login object)
    if ($login->errors)
    {
        foreach ($login->errors as $error)
        {
            echo "<div id=\"alertErrors\" class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error: </strong>" . $error;
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo "</div>";
            echo "</div>";
        }
    }
    if ($login->messages)
    {
        foreach ($login->messages as $message)
        {
            echo "<div id=\"alertMessages\" class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message;
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo "</div>";
            echo "</div>";
        }
    }
}

require_once("../config/db.php");

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
            <div class="panel panel-default">
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
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Collapsible Group Item #2
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
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


    <script type="text/javascript">

        $(function () {
            window.setTimeout(function () {
                $("#alertErrors").fadeTo(1500, 0).slideUp(500, function () {
                    $(this).remove();
                });
                $("#alertMessages").fadeTo(1500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);

            $("[rel=tooltip]").tooltip({placement: 'right'});
        });

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }

    </script>
</body>