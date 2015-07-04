<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class='container theme-showcase'>
    <div class="panel panal-content panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">User Information</h3>
        </div>
        <div class="panel-body">
<!--            <div class="well">
            </div>-->
            <form class="form-horizontal" id="formContact" data-parsley-validate>
                <div id="divFirstName" class="form-group">
                    <label for="firstName" class="col-sm-2 control-label">First Name:</label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="firstName" placeholder="First Name" data-parsley-group="firstName" required data-parsley-required-message="Please enter your First Name">
                    </div>
                </div>
                <div id="divLastName" class="form-group">
                    <label for="lastName" class="col-sm-2 control-label">Last Name:</label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" data-parsley-group="lastName" required data-parsley-required-message="Please enter your Last Name">
                    </div>
                </div>
                <div id="divEmail" class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email:</label>
                    <div class="col-xs-4">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email" data-parsley-group="email"/>
                    </div>
                </div>
                <div id="divPhone" class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Phone:</label>
                    <div class="col-xs-4" id="phone">
                        <div class="col-xs-4">
                            <input type="text" class="phonenumber form-control" name="phoneAreaCode" placeholder="###" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="phonenumber form-control" name="phoneFirstThree" placeholder="###" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="phonenumber form-control" name="phoneLastFour" placeholder="####" data-parsley-group="phone" maxlength="4" size="4" data-parsley-length="[4, 4]" data-parsley-error-message="4 Digits Required"/>
                        </div>
                    </div>
                </div>
                <div class="invalid-form-error-message-require-emailORphone"></div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Submit" class="btn btn-primary pull-right" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>