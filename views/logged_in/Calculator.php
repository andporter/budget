<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
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
            return '<span><button type="button" class="btn btn-info" id="' . $this->calcId . '" data-toggle="modal" data-target="#wageCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
        } elseif ($this->calcType === 'MonthlySE') {
            return '<span><button type="button" class="btn btn-info" id="' . $this->calcId . '" data-toggle="modal" data-target="#seCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
        } elseif ($this->calcType === 'NonMonthly') {
            return '<span><button type="button" class="btn btn-info" id="' . $this->calcId . '" data-toggle="modal" data-target="#nonMonthlyCalcModal"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></span>';
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
                        <input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "dollars-per-hour" placeholder = "$ Per Hour">
                        <span>X</span>
                        <input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "hours-per-week" placeholder = "Hours Per Week">
                    </div><button type = "button" id = "wageSubmit" class = "btn btn-primary">Submit</button>
                </form>
                <form class = "navbar-form">
                    <div class = "form-group">
                        <input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "salary" placeholder = "Salary $">
                    </div><button type = "button" id = "salarySubmit" class = "btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div><!--End Modal-->

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
                        <input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "typical-month-income" placeholder = "Typical Month's $">
                    </div><button type = "button" id = "seMonthSubmit" class = "btn btn-primary">Submit</button>
                </form>
                <form class = "navbar-form">
                    <div class = "form-group">
                        <input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "last-year-taxes" placeholder = "Last Year's Taxes $">
                    </div><button type = "button" id = "seTaxSubmit" class = "btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div><!--End Modal-->

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
                                    <input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "estimate-for-year" placeholder = "$">
                                </div>
                            </form>
                        </div>
                        <div class = "col-sm-8">
                            <form class = "navbar-form">
                                <div class = "form-group">
                                    <div class = "col-sm-12" style = "text-align: center;"><label class = 'control-label'>Frequency Method</label></div>
                                    <div class = "col-sm-6"><label class = 'control-label'>Times per Year:</label></div>
                                    <div class = "col-sm-6"><input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "times-per-year" placeholder = "Times Per Year #"></div>
                                    <div class = "col-sm-6"><label class = 'control-label'>Cost per Time:</label></div>
                                    <div class = "col-sm-6"><input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "cost-per-time" placeholder = "Cost Per Time $"></div>
                                    <div class = "col-sm-6"><label class = 'control-label'>Yearly Estimate:</label></div>
                                    <div class = "col-sm-6"><input onkeypress = 'return isNumberKey(event);' class = "form-control" id = "yearly-estimate" placeholder = "Yearly Estimate $"></div>
                                </div>
                            </form>
                        </div>
                        <button type = "button" id = "nonMonthlySubmit" class = "btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--End Modal-->

<!--<script type = "text/javascript">

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }

    $('#wageCalcModal').on('show.bs.modal', function (event) {
        //var button = $(event.relatedTarget); // Button that triggered the modal
        //var recipient = button.data('whatever'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        //var modal = $(this);
        //modal.find('.modal-title').text('Wage Calculator');
        //modal.find('.modal-body input').val(recipient);
        //var id = $(event.relatedTarget).data('id');
        //$(event.currentTarget).find('input[name="id"]').val(id);
        //document.getElementById(id).innerHTML = (document.getElementById('dollars-per-hour').innerHTML).toFixed(2);
    });

    $('#wageCalcModal').modal(options);
</script>-->