<?php
date_default_timezone_set('America/Denver');
?>

<div id="divBudgets" class="container-fluid" role="main">
    <div id="budgetTableToolbar" class="btn-group">
        <a href="#AddBudgetConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Add New Budget"><i class="glyphicon glyphicon-plus"></i> Add</a>
        <a href="#EditBudgetConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Edit Selected Budget"><i class="glyphicon glyphicon-edit"></i> Edit</a>
        <a href="#DeleteBudgetConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Delete Selected Budget"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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
                <th class="col-xs-6" data-field="budgetName" data-sortable="true">Budget Name</th>
                <th class="col-xs-2" data-field="userName" data-sortable="true">User</th>
            </tr>
        </thead>
    </table>
</div>

<div id="AddBudgetConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-plus"></span> Confirm New</h4>
            </div>
            <div class="modal-body">
                <p>Add new budget? Or Duplicate selected budget?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-success btn-ok" id="duplicateConfirmButton">Duplicate</a>
                <a href="index.php?editbudget=new" class="btn btn-success btn-ok" id="addConfirmButton">New</a>
            </div>
        </div>
    </div>
</div>

<div id="EditBudgetConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-edit"></span> Confirm Edit</h4>
            </div>
            <div class="modal-body">
                <p>Edit the selected budget?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <?php if ($_SESSION['user_type'] == "Admin") { ?>
                    <a href="#" class="btn btn-primary btn-ok" id="baselineConfirmButton">Baseline</a>
                <?php } ?>
                <a href="#" class="btn btn-primary btn-ok" id="editConfirmButton">Edit</a>
            </div>
        </div>
    </div>
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
                <a href="#" class="btn btn-danger btn-ok" id="deleteConfirmButton">Delete</a>
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
    
    function getSelectedRowIDs(dataformat)
    {
        var selectedTableRows = $('#budgetTable').bootstrapTable('getSelections');
        var selectedTableRowIDs = new Array();
        
        selectedTableRows.forEach(function (obj) 
        {
            selectedTableRowIDs.push(obj.budgetId);
        });
        
        if (dataformat === 'json')
        {
            return JSON.stringify(selectedTableRowIDs);
        }
        else
        {
            return selectedTableRowIDs;
        }
        
    }
    
    $('#baselineConfirmButton').click(function (e)
    {        
        $('#EditBudgetConfirmModal').modal('hide');
        $('#progressBarModal').modal('show');
        
        if (e.handled !== true) //Checking for the event whether it has occurred or not.
        { 
            e.handled = true;
            
            var postJSONData = getSelectedRowIDs("json");
            SendAjax("api/api.php?method=userToggleBudgetBaseline", postJSONData, AjaxSubmit_getBudgets, true);
        }
    });
    
    $('#editConfirmButton').click(function (e)
    {        
        window.location.href="index.php?editbudget="+getSelectedRowIDs();
    });
    
    $('#duplicateConfirmButton').click(function (e)
    {        
        window.location.href="index.php?duplicatebudget="+getSelectedRowIDs();
    });
    
    $('#deleteConfirmButton').click(function (e)
    {        
        $('#DeleteBudgetConfirmModal').modal('hide');
        $('#progressBarModal').modal('show');
        
        if (e.handled !== true) //Checking for the event whether it has occurred or not.
        { 
            e.handled = true;
            
            var postJSONData = getSelectedRowIDs("json");
            SendAjax("api/api.php?method=userDeleteBudget", postJSONData, AjaxSubmit_getBudgets, true);
        }
    });

</script>