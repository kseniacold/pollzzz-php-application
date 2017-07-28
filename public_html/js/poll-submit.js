/**
 * Created by Ksenia Koldaeva on 7/28/17.
 * following this tutorial: https://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php
 */

(function() {
    // Variable to hold request
    $(document).ready(function () {
        var request,
            jPollForm = $('#poll-form');


        // Bind submit request to the form
        jPollForm.submit(function(event) {
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

            // Fire off the request to /poll-form.php
            request = $.ajax({
                url: "poll-form.php",
                type: "post",
                data: serializedData
            });

            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                console.log("Hooray, it worked!");
                console.log(response);
            });

            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // Reenable the inputs
                jInputs.prop("disabled", false);
            });

        });
    });

}());