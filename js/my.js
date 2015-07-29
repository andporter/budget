function SendAjax(urlMethod, postJSONData, returnFunction, asyncTorF) {
    $.ajax({
        type: "POST",
        data: {"data": postJSONData},
        dataType: "json",
        url: urlMethod,
        async: asyncTorF,
        success: function (returnJSONData, status, xhr)
        {
            console.log("Ajax Success! URL: " + urlMethod);
            //console.log("Response: " + xhr.responseText);

            if (returnJSONData !== null && returnFunction !== "none")
            {
                returnFunction(returnJSONData);
            }
        },
        error: function (xhr, status, error)
        {
            console.error("Ajax Error! - URL: " + urlMethod);
            console.log("Response: " + xhr.responseText);
        }
    });
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

$(function () {
    $("[rel=tooltip]").tooltip({
        placement: 'right',
        container: 'body'
    });
});

$(function () {
    $('#accordion').on('shown.bs.collapse', function (e) {
        var offset = $(this).find('.collapse.in').prev('.panel-heading');
        if (offset) {
            $('html,body').animate({
                scrollTop: $(offset).offset().top - 60
            }, 200);
        }
    });
});

function submitForm(form) {
    var postJSONData = $(form).serializeArray();
    postJSONData = JSON.stringify(postJSONData);
    SendAjax("api/api.php?method=userBudgetFormSubmit", postJSONData, "none", true);
}