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
                </form>
                <form class = "navbar-form">
                    <div class = "form-group">
                        <input type="number" onkeypress = 'return isNumberKey(event);' class = "form-control" id = "last-year-taxes" placeholder = "Last Year's Taxes $">
                    </div>
                    <button type = "button" id = "seSubmit" class = "btn btn-primary">Submit</button>
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
        setModalLabelsToNull();
    });

    $('#salarySubmit').click(function () {
        total = document.getElementById('salary').value / 2080 * 40 * 52 / 12;
        setBId();
        $('#wageCalcModal').modal('hide');
        setModalLabelsToNull();
    });

    $('#seSubmit').click(function () {
        total = document.getElementById('typical-month-income').value  
                - document.getElementById('last-year-taxes').value / 12;
        setBId();
        $('#seCalcModal').modal('hide');
        setModalLabelsToNull();
    });

    $('#nonMonthlyTotalSubmit').click(function () {
        total = document.getElementById('estimate-for-year').value / 12;
        setBId();
        $('#nonMonthlyCalcModal').modal('hide');
        setModalLabelsToNull();
    });

    $('#nonMonthlySubmit').click(function () {
        total = document.getElementById('times-per-year').value
                * document.getElementById('cost-per-time').value / 12;
        setBId();
        $('#nonMonthlyCalcModal').modal('hide');
        setModalLabelsToNull();
    });

    function setModalLabelsToNull() {
        document.getElementById('dollars-per-hour').value = null;
        document.getElementById('hours-per-week').value = null;
        document.getElementById('salary').value = null;
        document.getElementById('estimate-for-year').value = null;
        document.getElementById('times-per-year').value = null;
        document.getElementById('cost-per-time').value = null;
        document.getElementById('typical-month-income').value = null;
        document.getElementById('last-year-taxes').value = null;
    }

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