/**
 * Created by Ksenia Koldaeva on 7/28/17.
 * following this tutorial: https://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php
 */

(function() {

    $(document).ready(function () {
        var jFormElem = $('#poll-form'),
            ajaxObj = {
                url: "poll-form.php",
                type: "post"
            };

        sendFormAjax(jFormElem, ajaxObj, doneCallback, failCallback);

    });

    /**
     * sendFormAjax() sends form data via Ajax request
     * @param jFormElem - jQuery form element
     * @param ajaxObj - plain Object, settings to be passed to ajax call, except for data,
     * data will be fetched by this function
     * @param doneCallback - function to be called on success
     * @param failCallback - function to be called on fail
     */
    function sendFormAjax(jFormElem, ajaxObj, doneCallback, failCallback) {
        var request;
        // Bind submit request to the form
        jFormElem.submit(function(event) {
            // local variable for easy access
            var jForm = $(this);
            // Prevent default posting of the form - put here to work in case of errors
            event.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }

            // Selecting and caching all the fields
            var jInputs = jForm.find("input, select, button, textarea");

            // Serialize the data in the form
            var serializedData = jForm.serialize();

            console.log(serializedData);

            // Disabling the inputs for the duration of the Ajax request.
            jInputs.prop("disabled", true);

            // Fire off the request
            ajaxObj.data = serializedData;
            request = $.ajax(ajaxObj);

            // Callback handler that will be called on success
            request.done(doneCallback);

            // Callback handler that will be called on failure
            request.fail(failCallback);

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // Reenable the inputs
                jInputs.prop("disabled", false);
            });

        });
    }

    function doneCallback(response, textStatus, jqXHR) {
        // Log a message to the console
        console.log("Hooray, it worked!");
        console.log(response);
    }

    function failCallback(jqXHR, textStatus, errorThrown) {
        // Log the error to the console
        console.error(
            "The following error occurred: " +
            textStatus, errorThrown
        );
    }

}());