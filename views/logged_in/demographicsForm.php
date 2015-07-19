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
            <h3 class="panel-title">Demographic & Contact Information</h3>
        </div>
        <div class="panel-body">
<!--            <div class="well">
            </div>-->
            <form class="form-horizontal" id="formDemographics" data-parsley-validate>
                
                <div id="nameGroup" class="form-group">
                    <label for="firstName" style="margin-left:15px; width: 100px" >First Name:</label>
                    <input type="text" style="margin-left:15px" id="firstName" name="firstName" placeholder="First Name" data-parsley-group="firstName" required data-parsley-required-message="Please enter your First Name">
                    <label for="lastName" style="margin-left:15px">Last Name:</label>
                    <input type="text" style="margin-left:15px" id="lastName" name="lastName" placeholder="Last Name" data-parsley-group="lastName" required data-parsley-required-message="Please enter your Last Name">
                </div>
             
                <div id="divPhone" class="form-group">
                    <label for="phone" style="margin-left:15px; width: 100px">Phone:</label>
                    <input type="text" style="margin-left:5px; width: 50px" name="phoneAreaCode" placeholder="###" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                    <input type="text" style="margin-left:5px; width: 50px" name="phoneFirstThree" placeholder="###" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                    <input type="text" style="margin-left:5px; width: 75px" name="phoneLastFour" placeholder="####" data-parsley-group="phone" maxlength="4" size="4" data-parsley-length="[4, 4]" data-parsley-error-message="4 Digits Required"/>
                    
                <label for="doYouText" style="margin-left:15px">Do You Text:</label>
                <input type="checkbox" style="margin-left:15px">

                </div>
                <div class="invalid-form-error-message-require-emailORphone"></div>
                
                <div id="additionalPerson">
                <label for="additionalPerson" class="col-sm-2 control-label">I Want to Add an Additional Person:</label>
                    <div class="col-xs-4">
                        <input type="checkbox" >
                    </div>
                </div>
                
                <div id="divSecondFirstName" class="form-group">
                    <label for="firstName" class="col-sm-2 control-label">First Name:</label>
                       <div class="col-xs-4">
                        <input type="text" >
                    </div>
                </div>

                <div id="divSecondLastName" class="form-group">
                    <label for="lastName" class="col-sm-2 control-label">Last Name:</label>
                    <div class="col-xs-4">
                        <input type="text">
                    </div>
                </div>
                
        
                <div id="divEmail" class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email:</label>
                    <div class="col-xs-4">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email" data-parsley-group="email"/>
                    </div>
                </div>
                
                <div id="under4">
                <label for="under4" class="col-sm-2 control-label">Number of Children 0-5 you support:</label>
                    <div class="col-xs-4">
                        <input type="text" >
                    </div>
                </div>
                
                <div id="over5">
                <label for="over5" class="col-sm-2 control-label">Number of Children 6-18 you support:</label>
                    <div class="col-xs-4">
                        <input type="text" >
                    </div>
                </div>
    
                <div id="totalHousehold">
                <label for="totalHousehold" class="col-sm-2 control-label">Total number of household members you support:</label>
                    <div class="col-xs-4">
                        <input type="text" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Submit" class="btn btn-primary pull-right" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>