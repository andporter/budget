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

// Warning Duplicate IDs
$('[id]').each(function () {
    var ids = $('[id="' + this.id + '"]');
    if (ids.length > 1 && ids[0] === this)
        console.warn('Multiple IDs #' + this.id);
});

$(function () {
    $("[rel=tooltip]").tooltip({
        placement: 'right',
        container: 'body'
    });
});