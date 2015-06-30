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
$db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$sql = $db_connection->prepare("SELECT cp.type AS `Type`, cp.order AS `CategoryParentOrder`, cp.name AS `CategoryParentName`, c.order AS `CategoryOrder`, c.name AS `CategoryName`, c.hoverText AS `HoverText`
                                FROM categoryparent cp
                                LEFT JOIN category c ON c.categoryparentid = cp.categoryparentid
                                WHERE cp.order = 1
                                ORDER BY c.order");

if ($sql->execute())
{
    $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<body>

    <div class="container theme-showcase">
        <div class="panel panal-content panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $ResultsToReturn[0][CategoryParentOrder] . '. ' . $ResultsToReturn[0][CategoryParentName]; ?></h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form">
                    <?php
                    foreach ($ResultsToReturn as $row)
                    {
                        echo "<div class = 'form-group'>";
                        echo "  <label class = 'control-label col-sm-7' for = 'self_" . $row[CategoryOrder] . str_replace(' ', '_', $row[CategoryName]) . "'> " . $row[CategoryOrder] . '. ' . $row[CategoryName] . "</label>";
                        echo "  <div class = 'col-sm-5 input-group input-group-unstyled'>";
                        echo "      <span class='input-group-addon glyphicon glyphicon-info-sign' rel='tooltip' title='" . $row[HoverText] . "'></span>";
                        echo "      <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Self $$' value='' required data-parsley-required-message = '' id = 'self_" . $row[CategoryOrder] . str_replace(' ', '_', $row[CategoryName]) . "'></input>";
                        echo "      <span class='input-group-addon glyphicon glyphicon-modal-window'></span>";
                        echo "      <input type = 'text' onkeypress='return isNumberKey(event);' class = 'form-control' placeholder = 'Spouse $$' value='' required data-parsley-required-message = '' id = 'spouse_" . $row[CategoryOrder] . str_replace(' ', '_', $row[CategoryName]) . "'></input>";
                        echo "      <span class='input-group-addon glyphicon glyphicon-modal-window'></span>";
                        echo "  </div>";
                        echo "</div>";
                    }
                    ?>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary pull-right">Next</button>
                        </div>
                    </div>
                </form>
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
