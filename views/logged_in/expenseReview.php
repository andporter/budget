<?php
include('getDB.php');

function getForm($CategoryParentType, $CategoryParentOrder)
{

    $ResultsToReturn = getDB($CategoryParentType, $CategoryParentOrder);
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
    <?php
}
?>
<div class = 'container theme-showcase'>
    <h1>Functional Expense Review</h1>
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