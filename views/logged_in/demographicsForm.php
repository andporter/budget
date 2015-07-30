<?php
$db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

$sql = $db_connection->prepare("SELECT firstName, lastName, phone, phoneCanText, isMarried, spouseFirstName, spouseLastName, spouseEmail, dependent0_4, dependent5_18, dependentAdditional FROM users WHERE userId = :userId");

$sql->bindParam(':userId', $_SESSION['user_id']);

if ($sql->execute())
{
    $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class='container theme-showcase'>
    <div class="panel panal-content panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Demographic & Contact Information</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" id="formDemographics">

                <div id="nameGroup" class="form-group">
                    <label for="firstName" style="margin-left:15px; width: 100px" >First Name:</label>
                    <input type="text" style="margin-left:30px; width: 195px" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $ResultsToReturn[0]["firstName"] ?>" required>                    
                    <label for="lastName" style="margin-left:15px; width: 100px">Last Name:</label>
                    <input type="text" style="margin-left:30px; width: 175" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $ResultsToReturn[0]["lastName"] ?>" required>
                    <div class="errors"><div id="firstNameError" class="errors" value=""></div><div id="lastNameError" class="errors" value=""></div></div>
                </div>
                

                <div id="divPhone" class="form-group">
                    <label for="phone" name="phone" style="margin-left:15px; width: 125px">Phone:</label>
                    <input type="text" id="phoneAreaCode" style="margin-left:5px; width: 50px" name="phoneAreaCode" onkeypress='return isNumberKey(event);' placeholder="###" value="<?php echo substr($ResultsToReturn[0]["phone"], 0, 3) ?>" required/>
                    <input type="text" id="phoneFirstThree" style="margin-left:5px; width: 50px" name="phoneFirstThree" onkeypress='return isNumberKey(event);' placeholder="###" value="<?php echo substr($ResultsToReturn[0]["phone"], 4, 3) ?>" required/>
                    <input type="text" id="phoneLastFour" style="margin-left:5px; width: 75px" name="phoneLastFour" onkeypress='return isNumberKey(event);' placeholder="####" value="<?php echo substr($ResultsToReturn[0]["phone"], 8, 4) ?>" required/>
                    <label for="doYouText" id="doYouText" name="doYouText" style="margin-left:15px">Do You Text:</label>
                    <input id="phoneCanText" name="phoneCanText" type="checkbox" <?php if ($ResultsToReturn[0]["phoneCanText"] == "0"){echo "checked";} ?> style="margin-left:45px">
                    <div class="errors"><div id="phoneAreaCodeError" class="errors" value=""></div><div id="phoneFirstThreeError" class="errors" value=""></div><div id="phoneLastFourError" class="errors" value=""></div></div>
                </div>

                <div id="additional" class="form-group">
                    <label for="additionalPerson" name="additionalPerson" style="margin-left:15px">I'm married (Have someone living in the home that I want to include)</label>
                    <input id="isMarried" name="isMarried" type="checkbox" <?php if ($ResultsToReturn[0]["isMarried"] == "0"){echo "checked";} ?> style="margin-left:105px">
                </div>

                <div id="secondNameGroup" class="form-group">
                    <label for="spouseFirstName" name="spouseFirstName" style="margin-left:15px; width: 100px" >First Name:</label>
                    <input type="text" style="margin-left:30px; width: 195px" id="spouseFirstName" name="spouseFirstName" placeholder="First Name" value="<?php echo $ResultsToReturn[0]["spouseFirstName"] ?>" >
                    <label for="spouseLastName" name="spouseLastName" style="margin-left:15px; width: 100px">Last Name:</label>
                    <input type="text" style="margin-left:30px; width: 195px" id="spouseLastName" name="spouseLastName" placeholder="Last Name" value="<?php echo $ResultsToReturn[0]["spouseLastName"] ?>" >
                    <div><div id="spouseEmailError" class="errors" value="" hidden="true"></div><div id="spouseFirstNameError" class="errors" value="" hidden="true"></div><div id="spouseLastNameError" class="errors" value="" hidden="true"></div></div>
                </div>

                <div id="divEmail" class="form-group">
                    <label for="spouseEmail" name="spouseEmail" style="margin-left:15px; width: 100px">Email:</label>
                    <input id="spouseEmail" style="margin-left:30px; width: 300px" type="email" name="spouseEmail" placeholder="Email" value="<?php echo $ResultsToReturn[0]["spouseEmail"] ?>" data-parsley-group="email"/>
                    <div><div id="dependent0_4Error" class="errors" value=""></div></div>
                </div>

                <div id="under4" class="form-group">
                    <label for="dependent0_4" name="dependent0_4" style="margin-left:15px; width: 400px" >Number of Children 0-4 you support:</label>
                    <input id="dependent0_4" name="dependent0_4" type="text" onkeypress='return isNumberKey(event);' value="<?php echo $ResultsToReturn[0]["dependent0_4"] ?>" style="margin-left:15px" required>
                    <div><div id="dependent0_4Error" class="errors" value=""></div></div>
                </div>

                <div id="over5" class="form-group">
                    <label for="dependent5_18" name="dependent5_18" style="margin-left:15px; width: 400px">Number of Children 5-18 you support:</label>
                    <input id="dependent5_18" name="dependent5_18" type="text" onkeypress='return isNumberKey(event);' value="<?php echo $ResultsToReturn[0]["dependent5_18"] ?>" style="margin-left:15px" required>
                    <div><div id="dependent5_18Error" class="errors" value=""></div></div>
                </div>

                <div id="dependentAdditional" class="form-group">
                    <label for="dependentAdditional" name="dependentAdditional" style="margin-left:15px; width: 400px">Additional household member you support (including yourself and spouse):</label>
                    <input id="dependentAdditional" name="dependentAdditional" type="text" onkeypress='return isNumberKey(event);' value="<?php echo $ResultsToReturn[0]["dependentAdditional"] ?>" style="margin-left:15px" required>
                    <div><div id="dependentAdditionalError" class="errors"  value=""></div></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" id="buttonSave_formDemographics" data-loading-text="Saving..." class="btn btn-primary pull-right" autocomplete="off">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type = "text/javascript">    
    $('#buttonSave_formDemographics').on('click', function ()
    {
 
        var btn = $(this).button('loading');
        
        var postJSONData = $('#formDemographics').serializeObject();
        
        
        for(var x in postJSONData)
        {
                errorId = (x + "Error");
                if (postJSONData[x].toString() == null || postJSONData[x].toString() == "") 
                {
                    document.getElementById(errorId).innerHTML =(x + " must be filled out");
                }
                else
                {
                    document.getElementById(errorId).innerHTML = "";
                }
        }
        
        postJSONData = JSON.stringify(postJSONData);
        SendAjax("api/api.php?method=userDemographicsFormSubmit", postJSONData, "none", true);
        
        setTimeout(function () {
            btn.button('reset')
        }, 1500)
    })
</script>