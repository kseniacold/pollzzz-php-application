(function() {

    // Add hidden class to the form on document ready
    // Remove hidden class from the form on link click

    $(document).ready(function () {
        var jForm = $('.poll-form__container'),
            jFormTrigger = $('.polls__item a.item__link[rel="modal:open"]');

        if (!jForm.hasClass('hidden')) { jForm.addClass('hidden'); }

        jFormTrigger.click(function () {
            if (jForm.hasClass('hidden')) { jForm.removeClass('hidden'); }
        });

    });
}());