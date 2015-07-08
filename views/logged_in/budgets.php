<?php
date_default_timezone_set('America/Denver');
?>

<div id="divBudgets" class="container-fluid" role="main">
    <div id="budgetTableToolbar" class="btn-group">
        <a href="#DeleteBudgetConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Delete Selected"><i class="glyphicon glyphicon-trash"></i> Delete</a>
        <a href="#AddBudgetConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Add New Budget"><i class="glyphicon glyphicon-plus"></i> Add</a>
    </div>
    <table id="budgetTable"
           data-click-to-select="true"
           data-search="true"
           data-toolbar-align="left"
           data-toolbar="#budgetTableToolbar"
           data-classes="table table-hover table-condensed"
           data-pagination="true"
           data-page-size="20"
           data-height="650"
           data-maintain-selected="true"
           data-show-footer="true"
           data-striped="true"
           data-sort-name="date"
           data-sort-order="desc"
           data-sortable="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th class="col-xs-2" data-field="dateCreated" data-sortable="true">Date Created</th>
                <th class="col-xs-2" data-field="dateUpdated" data-sortable="true">Date Updated</th>
                <th class="col-xs-8" data-field="budgetName" data-sortable="true">Budget Name</th>
            </tr>
        </thead>
    </table>
</div>

<div id="DeleteBudgetConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-trash"></span> Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>Delete the selected budget?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger btn-ok" id="deleteConfirmButton">Yes, Delete</a>
            </div>
        </div>
    </div>
</div>

<div id="AddBudgetConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-plus"></span> Confirm New Budget</h4>
            </div>
            <div class="modal-body">
                <p>Add new budget?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="index.php?newbudget" class="btn btn-success btn-ok" id="addConfirmButton">Yes, Add New</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#progressBarModal').modal('show');

    AjaxSubmit_getBudgets();

    function AjaxSubmit_getBudgets()
    {
        var postJSONData = '{}';
        SendAjax("api/api.php?method=userGetBudgets", postJSONData, AjaxSuccess_getBudgets, true);
    }

    function AjaxSuccess_getBudgets(returnJSONData)
    {
        $('#budgetTable').bootstrapTable({data: returnJSONData.data});
        $('#budgetTable').bootstrapTable('load', returnJSONData.data);

        setTimeout(function () {
            $('#progressBarModal').modal('hide');
        }, 1000);
    }
    
    function getSelectedRowIDs()
    {
        var selectedTableRows = $('#budgetTable').bootstrapTable('getSelections');
        var selectedTableRowIDs = new Array();
        
        selectedTableRows.forEach(function (obj) 
        {
            selectedTableRowIDs.push(obj.budgetId);
        });
        
        return JSON.stringify(selectedTableRowIDs);
    }
    
    $('#deleteConfirmButton').click(function (e)
    {        
        $('#DeleteBudgetConfirmModal').modal('hide');
        $('#progressBarModal').modal('show');
        
        if (e.handled !== true) //Checking for the event whether it has occurred or not.
        { 
            e.handled = true;
            
            var postJSONData = getSelectedRowIDs();
            SendAjax("api/api.php?method=userDeleteBudget", postJSONData, AjaxSubmit_getBudgets, true);
        }
    });

</script>