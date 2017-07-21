/**
 * Created by Ksenia Koldaeva on 7/20/17.
 */

// wrapping the code in immediate function for not polluting global scope
(function() {
    $(document).ready(function() {
        var jTimer = $('.timer'),
            timerEnd = parseInt(jTimer.attr('data-timer-end')), //getting timer end time from data attribute
            timer = new Timer(timerEnd, jTimer);
        timer.start();
    });

    /**
     *
     * @param timerEnd - time in milliseconds when the poll will be closed
     * @param jTimer - timer jQuery element
     * @constructor
     */
    function Timer(timerEnd, jTimer) {
        this.timerEnd = new Date(timerEnd);
        console.log(this.timerEnd.toISOString());
        this.jTimer = jTimer;
        this.elements = ['days', 'hours', 'minutes', 'seconds'];
    }

    Timer.prototype = {


        start: function() {
            var self = this;
            self.addElements();
            self.timer = setInterval(function() {
                self.processTimeDifference();
            }, 1000);
        },

        /**
         * processTimeDifference() calculates the difference between current timestamp
         * and timerEnd timestamps and displays results
         */
        processTimeDifference: function() {
            var difference,
                now;

            now = this.getCurrentTime();
            difference = this.timerEnd.getTime() - now;

            if (difference >= 0) {
                this.seconds = Math.floor(difference / 1000);
                this.minutes = Math.floor(this.seconds / 60);
                this.hours = Math.floor(this.minutes / 60);
                this.days = Math.floor(this.hours / 24);

                this.hours %= 24;
                this.minutes %= 60;
                this.seconds %= 60;

                $('.timer__days').text(this.days);
                $('.timer__hours').text(this.hours);
                $('.timer__minutes').text(this.minutes);
                $('.timer__seconds').text(this.seconds);

            } else {
                // Timer done
                clearInterval(this.timer);
            }
        },

        /**
         * addElements() creates HTML elements to contain timer elements
         */
        addElements: function() {
            for (var i = 0; i < this.elements.length; i++) {
                this.jTimer.append(this.generateTimerElement(this.elements[i]));
            }
        },

        /**
         *
         * @param element - string for class naming and text displayed on a website
         * @returns {string} <span> element with provided class name and textual content
         */
        generateTimerElement: function(element) {
            return '<div class="timer__element">' +
                   '<span class="timer__number timer__' + element + '"></span>' +
                   '<span class="timer__txt">' + element + '</span>' +
                   '</div>';
        },

        /**
         * @returns {Date} current time in milliseconds
         */
        getCurrentTime: function () {
            return new Date();
        }
    };
}());