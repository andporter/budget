<?php
include_once('GetIncomeOrExpenseForm.php');
?>
<div class='container theme-showcase'>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        for ($i = 1; $i <= 9; $i++)
        {
            getIncomeOrExpenseForm("Expense", $i);
        }
        ?>
    </div>
</div>

</body>