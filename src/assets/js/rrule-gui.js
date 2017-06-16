
//Read rule from the recurring event
function readRule(rrule) {

    rrule = typeof rrule !== 'undefined' ? rrule : '';

    if (rrule != '') {
        // Break down the rule by semi-colons first
        var items = rrule.split(';');
        var recur = [];
        for (i = 0; i < items.length; i++) {
            if (items[i] !== '') {
                temp = items[i].split('=');
            }
            recur[temp[0]] = temp[1];
        }
      //  console.log(recur);

        // See if the recurring rule has enough valid parts
        if (recur.FREQ && (recur.COUNT || recur.UNTIL || recur.INTERVAL)) {
            recurringRule = {
                freq: recur.FREQ,
                interval: recur.INTERVAL,
                byday: "",
                bysetpos: "",
                bymonthday: "",
                bymonth: "",
                count: "",
                until: ""
            };

            // Set either COUNT or UNTIL
            if (typeof recur.COUNT == 'undefined' && recur.UNTIL) {
                recurringRule.until = recur.UNTIL;
                //set enable for until input
                $('input[name="until"][id="end-date"]').prop('disabled', false);
                //set disable for count input
                $('input[name="count"]').prop('disabled', true);

            } else if (typeof recur.UNTIL == 'undefined' && recur.COUNT) {
                recurringRule.count = recur.COUNT;
                //set disabled for until input
                $('input[name="until"][id="end-date"]').prop('disabled', true);
                //set enable for count input
                $('input[name="count"]').prop('disabled', false);
            } else { //forever detected
                //set disabled for until input
                $('input[name="until"][id="end-date"]').prop('disabled', true);
                //set disabled for count input
                $('input[name="count"]').prop('disabled', true);
            }

            // Set INTERVAL
            $('input[name="interval"]').val(recur.INTERVAL);

            // Setup the end-date picker
            $('#end-date').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd',
                onSelect: function(value) {
                    dateSelected = new Date(value + ' 00:00:00');
                    untilString = dateSelected.getFullYear() + ('0' + (dateSelected.getMonth() + 1)).slice(-2) + ('0' + dateSelected.getDate()).slice(-2);
                    $('#end-date-hidden').val(untilString + 'T040000z');
                    // Remove the count variable
                    recurringRule.count = '';
                    // Set until variable
                    recurringRule.until = untilString + 'T040000z';
                    eventChange();
                }
            }).datepicker('setDate', 'today');

            if (recur.UNTIL && typeof recur.COUNT == 'undefined') {
                // Setup end date picker
                endYear = recur.UNTIL.substring(0, 4);
                endMonth = recur.UNTIL.substring(4, 6);
                endDay = recur.UNTIL.substring(6, 8);

                $('#end-date').val(endYear + '-' + endMonth + '-' + endDay);
                $('#end-date-hidden').val(endYear + endMonth + endDay + 'T040000z');

                // Set ENDDATE radio to yes
                $('input[name="end-select"][value="until"]').prop('checked', true);
            }
            else if(recur.COUNT && typeof recur.UNTIL == 'undefined'){
              // Set Count to curent count
              $('input[name="count"]').val(recur.COUNT);

              // set ENDDATE radio to COUNT
              $('input[name="end-select"][value="count"]').prop('checked', true);
            }
            else{
              // set ENDDATE radio to FOREVER
              $('input[name="end-select"][value="forever"]').prop('checked', true);
            }


            //Set readable text
            var result_readable = rruleTransform($('input#event-recurrence').val());
            $('#rrule-readable').html("repeat " + result_readable);

            // Set Recurring event radio to yes
            $('input[name="event-recurring"][value="yes"]').prop('checked', true);

            // Show Recurring rules
            $('#recurring-rules').slideDown();

            // Show Until Rules
            $('#until-rules').show();

            switch (recur.FREQ) {
                case ("DAILY"):
                    break;
                case ("WEEKLY"):
                    // Selectbox FREQ = monthly
                    $('select[name="freq"]').val('weekly');

                    // Hide all DIVS
                    $('#recurring-rules > div').hide();

                    // Show selected DIV
                    $('div.' + 'weeks-choice').show();
                    $('span.freq-selection').text('week(s)');

                    // Show Until / Count Rules
                    $('#until-rules').show();

                    if (typeof recur.BYDAY !== 'undefined') {

                        // Split up the individual bymonthdays
                        bydays = recur.BYDAY.split(',');

                        // Loop through the BYDAYs
                        for (v = 0; v < bydays.length; v++) {
                            console.log(bydays[v]);
                            // Set select monthday buttons to active
                            $('#weekday-select button[id="' + bydays[v] + '"]').addClass('active')
                        }
                        recurringRule.byday = recur.BYDAY;

                        return true;
                    }
                    break;
                case ("MONTHLY"):
                    // Selectbox FREQ = monthly
                    $('select[name="freq"]').val('monthly');

                    // Hide all DIVS
                    $('#recurring-rules > div').hide();

                    // Show selected DIV
                    $('div.' + 'months-choice').show();
                    $('span.freq-selection').text('month(s)');

                    // Show Until / Count Rules
                    $('#until-rules').show();

                    if (typeof recur.BYMONTHDAY !== 'undefined') {

                        // Split up the individual bymonthdays
                        bymonthdays = recur.BYMONTHDAY.split(',');

                        // Loop through the BYMONTHDAYs
                        for (v = 0; v < bymonthdays.length; v++) {
                            console.log(bymonthdays[v]);
                            // Set select monthday buttons to active
                            $('#monthday-select button[data-day-num="' + bymonthdays[v] + '"]').addClass('active')
                        }
                        recurringRule.bymonthday = recur.BYMONTHDAY;

                        return true;
                    }

                    if (typeof recur.BYSETPOS !== 'undefined' && typeof recur.BYDAY !== 'undefined') {

                        // Set Radio Button
                        $('input#month-byday-pos-selected').prop('checked', true);

                        //alert(recur.BYDAY);
                        $('select[name^="month-byday"]').removeAttr('disabled');

                        // Set values
                        $('select[name="month-byday-pos"]').val(recur.BYSETPOS);
                        $('select[name="month-byday-pos-name"]').val(recur.BYDAY);

                        //Disable day buttons
                        $('#monthday-select button').attr('disabled', 'disabled');

                        recurringRule.bysetpos = recur.BYSETPOS;
                        recurringRule.byday = recur.BYDAY;

                        return true;
                    }

                    break;

                case ("YEARLY"):
                    // Selectbox FREQ = monthly
                    $('select[name="freq"]').val('yearly');

                    // Hide all DIVS
                    $('#recurring-rules > div').hide();

                    // Show selected DIV
                    $('div.' + 'years-choice').show();
                    $('span.freq-selection').text('year(s)');

                    // Show Until / Count Rules
                    $('#until-rules').show();

                    // BYMONTH and BYMONTHDAY attributes are going to be set
                    if (typeof recur.BYMONTHDAY !== 'undefined' && typeof recur.BYMONTH !== 'undefined') {

                        // Set Radio Button
                        $('input#yearly-one-month').prop('checked', true);

                        //				alert(recur.BYDAY);
                        $('select[name="yearly-bymonth"]').removeAttr('disabled');
                        $('select[name="yearly-bymonthday"]').removeAttr('disabled');

                        // Set values
                        $('select[name="yearly-bymonth"]').val(recur.BYMONTH);
                        $('select[name="yearly-bymonthday"]').val(recur.BYMONTHDAY);


                        recurringRule.bymonth = recur.BYMONTH;
                        recurringRule.bymonthday = recur.BYMONTHDAY;

                        return true;
                    }

                    // Multiple Month Selection
                    if (typeof recur.BYMONTH !== 'undefined' && typeof recur.BYMONTHDAY == 'undefined' && typeof recur.BYSETPOS == 'undefined') {
                        // Disable yearly select boxes
                        $('select[name^=yearly-').attr('disabled', 'disabled');
                        // Set Radio Button
                        $('input#yearly-multiple-months').prop('checked', true);

                        // Make buttons active
                        $('.yearly-multiple-months button').removeAttr('disabled');
                        // Split up the individual bymonthdays
                        bymonth = recur.BYMONTH.split(',');

                        // Loop through the BYMONTHDAYs
                        for (v = 0; v < bymonth.length; v++) {
                            console.log(bymonth[v]);
                            // Set select monthday buttons to active
                            $('.yearly-multiple-months button[data-month-num="' + bymonth[v] + '"]').addClass('active')
                        }
                        recurringRule.bymonth = recur.BYMONTH;

                        return true;
                    }

                    // Precise Yearly Selection
                    if (typeof recur.BYMONTH !== 'undefined' && typeof recur.BYDAY !== 'undefined' && typeof recur.BYSETPOS !== 'undefined') {

                        // Disable yearly select boxes
                        $('select[name^=yearly-').attr('disabled', 'disabled');

                        // Enable the right select
                        $('select[class=yearly-precise').removeAttr('disabled');

                        // Set Radio Button
                        $('input#yearly-precise').prop('checked', true);

                        // Set select values
                        $('select[name="yearly-byday"]').val(recur.BYDAY);
                        $('select[name="yearly-bysetpos"]').val(recur.BYSETPOS);
                        $('select[name="yearly-bymonth-with-bysetpos-byday"]').val(recur.BYMONTH);

                        recurringRule.bymonth = recur.BYMONTH;
                        recurringRule.byday = recur.BYDAY;
                        recurringRule.bysetpos = recur.BYSETPOS;

                        return true;
                    }
                    break;
            }
        }
    }
    return false;
}

//readRule = false;



function resetOptions() {

    // Format the date (http://stackoverflow.com/questions/3605214/javascript-add-leading-zeroes-to-date)
    today = new Date();
    MyDateString = today.getFullYear() + ('0' + (today.getMonth() + 1)).slice(-2) + ('0' + today.getDate()).slice(-2);

    // Reset all the selected rules
    recurringRule = {
        freq: "daily",
        interval: "1",
        byday: "",
        bysetpos: "",
        bymonthday: "",
        bymonth: "",
        count: "",
        until: MyDateString + 'T040000z'
    };

    // Reset all button states and input values
    $('button').removeClass('active');

    // Reset back interval label to 'days'
    $('span.freq-selection').text('days');

    // Hide all but the daily options
    $('#monthday-select,#bymonth-select,#weekday-select').hide();

    // Reset Interval back to 1
    $('input[name="interval"]').val("1");

    // Reset Count back to 1
    $('input[name="count"]').val("1");

    // Change back Daily
    $('select[name="freq"]').val('daily');

    // Reset Until / Count radio buttons
    $('input[id="forever-select"]').prop('checked', true).change();
    $('input[id="until-select"]').prop('checked', false);
    $('input[id="count-select"]').prop('checked', false);
    // $('#count').reset();
}

function rruleGenerate() {
    // Produce RRULE state to feed to rrule.js
    rrule = "";

    // Check to be sure there is a count value or until date selected
    // if (recurringRule.count == "" && recurringRule.until == "") {
    //     // No end in sight, make it default to 1 occurence
    //     recurringRule.count = "1";
    // }

    for (var key in recurringRule) {
        if (recurringRule.hasOwnProperty(key)) {
            if (recurringRule[key] != '') {
                rrule += key + '=' + recurringRule[key] + ';';
            }
        }
    }
    // Remove the last semicolon from the end of RRULE
    rrule = rrule.replace(/;\s*$/, "");

    // Convert to Uppercase and return
    return rrule.toUpperCase();
}

// Transform rule to human-readable text
function rruleTransform(value) {
    var rule_readable = new RRule.fromString(value);
    return rule_readable.toText();
}


$(document).ready(function() {

    if ($('input#event-recurrence').val()==='') {

        resetOptions();

        // Setup the end-date picker
        untilSelect();

        $('#end-date-hidden').val(MyDateString + 'T040000z');

        noRepeat();
    }

    // Setup buttons Don't allow any buttons to submit the form
    $(document).on('click','button.btn-recurr',function(e) {
        e.preventDefault;
        return false;
    });
});

// Recurring Event Calculator: Show/Hide.  Grab all the radio buttons to see which one.
$(document).on('change','input[name="event-recurring"]',function() {
    // Resets all the recurring options
    // resetOptions();

    // enable the input next to the selected radio button
    if ($(this).val() == "yes") {
        $('#recurring-rules').slideDown();
        resetOptions();
        eventChange();
        // Show Until Rules
        $('#until-rules').show();
    } else {
        //disable the inputs not selected.
        $('#recurring-rules').hide();
        noRepeat();
    }
});

// FREQ Selection
$(document).on('change', 'select[name="freq"]', function() {

    selectedFrequency = $('select[name="freq"] option:selected').attr('class');

    // Hide all DIVS
    $('#recurring-rules > div').hide();

    // Show selected DIV
    $('div.' + selectedFrequency + '-choice').show();
    $('span.freq-selection').text(selectedFrequency);

    // Show Until / Count Rules
    $('#until-rules').show();


    // Reset all the selected rules
    recurringRule = {
        freq: "",
        interval: "1",
        byday: "",
        bysetpos: "",
        bymonthday: "",
        bymonth: "",
      //  count: "1",
        until: ""

    };

    // Set frequency
    recurringRule.freq = $('select[name="freq"] option:selected').val();

    // If it is yearly, fire a change to setup the default values
    if (recurringRule.freq == "yearly") {
        $('select[name="yearly-bymonth"]').change();
    }

    //trigger to update rule
    eventChange();
});

// Interval Selection
$(document).on('change blur keyup', 'input[name="interval"]', function() {
    recurringRule.interval = $(this).val();

    //triger to update rule
    eventChange();
});

// BYDAY - FREQ: WEEKLY Selection
$(document).on('click','#weekday-select button', function() {
    $(this).toggleClass('active');
    var byday = []; // Array to Store 'byday' in. Reset it to '' to store new days in below

    // Store Selected Days in the BYDAY rule
    $('#weekday-select button').each(function() {

        // Active class is the selected day, store the ID of active days which contains the short day name for the rrule (ex. MO, TU, WE, etc)
        if ($(this).hasClass('active')) {
            byday.push($(this).attr('id'));
        }

    });
    recurringRule.byday = byday;

    //trigger to update rule
    eventChange();
});

// BYMONTHDAY Selection
$(document).on('click','#monthday-select button', function() {
    $(this).toggleClass('active');
    var bymonthday = []; // Array to Store 'bymonthday' in. Reset it to '' to store new days in below

    // Store Selected Days in the BYDAY rule
    $('#monthday-select button').each(function() {

        // Active class is the selected day, store the ID of active days which contains the short day name for the rrule (ex. MO, TU, WE, etc)
        if ($(this).hasClass('active')) {
            bymonthday.push($(this).attr('data-day-num'));
        }

    });
    recurringRule.bymonthday = bymonthday;

    // Reset BYDAY Option
    recurringRule.byday = "";

    // Reset BySetPos
    recurringRule.bysetpos = "";

    //trigger to update rule
    eventChange();
});

// BYMONTH Selection
$(document).on('click','#bymonth-select button', function() {
    $(this).toggleClass('active');
    var bymonth = []; // Array to Store 'byday' in. Reset it to '' to store new days in below

    // Store Selected Days in the BYDAY rule
    $('#bymonth-select button').each(function() {

        // Active class is the selected day, store the ID of active days which contains the short day name for the rrule (ex. MO, TU, WE, etc)
        if ($(this).hasClass('active')) {
            bymonth.push($(this).attr('data-month-num'));
        }

    });
    recurringRule.bymonth = bymonth;

    //triger to update rule
    eventChange();
});


// FREQ=MONTHLY - RADIO BUTTONS
$(document).on('change','input[name="monthday-pos-select"]',function() {

    // Selected Radio Button
    var selectedRadio = $(this).val();

    // A Radio was changed.  Grab all the radio buttons to see which one.
    $('input[name="monthday-pos-select"]').each(function() {

        if ($(this).val() == selectedRadio) {

            switch ($(this).val()) {
                case "month-byday-pos-selected":
                    // ByDay Select Boxes are being used instead of the Month Day

                    // Disable all the monthday buttons
                    $('#monthday-select button').attr('disabled', 'disabled');
                    $('select[name^="month-byday"]').removeAttr('disabled');

                    // Generate the BYDAY variable from selected dropdowns by firing 'change' event
                    $('select[name^="month-byday"]').change();
                    // Mark recurring object bymonthday back to nothing
                    recurringRule.bymonthday = "";

                    break;

                case "monthday-selected":

                    // Month Day Buttons are being used instead of the ByDay select boxes
                    $('#monthday-select button').removeAttr('disabled');
                    $('#monthday-select button').removeClass('active');

                    $('select[name^="month-byday"]').attr('disabled', 'disabled');
                    recurringRule.byday = "";
                    recurringRule.bysetpos = "";
                    break;
            }
        }
    });

    //trigger to update rule
    eventChange();

});

// FREQ=YEARLY - RADIO BUTTONS
$(document).on('change','input[name="yearly-options"]',function() {

    // Selected Radio Button ID
    var selectedRadio = $(this).attr('id');

    // A Radio was changed.  Check all the radio buttons' ids to see which one.
    $('input[name="yearly-options"]').each(function() {

        if ($(this).attr('id') == selectedRadio) {

            switch ($(this).attr('id')) {
                case "yearly-one-month":
                    // Example Pattern
                    // FREQ=YEARLY;BYMONTH=1;BYMONTHDAY=1;UNTIL=20150818;

                    // BYMONTH and BYMONTHDAY attributes are going to be set
                    // Reset BYSETPOS, BYDAY,
                    recurringRule.bysetpos = "";
                    recurringRule.byday = "";

                    // Disable all the yearly select boxes
                    $('select[class^="yearly"]').attr('disabled', 'disabled');

                    // Disable all the yearly multiple month buttons
                    $('.yearly-multiple-months button').attr('disabled', 'disabled');
                    $('.yearly-multiple-months button').removeClass('active');

                    // Enable Yearly One Month Options
                    $('select[class="yearly-one-month"]').removeAttr('disabled');

                    // Fire change to select default values
                    $('select[name="yearly-bymonth"]').change();

                    break;

                case "yearly-multiple-months":
                    // Example Pattern
                    // FREQ=YEARLY;INTERVAL=1;BYMONTH=1,3,4,10;COUNT=1

                    // BYMONTH attribute is going to be set
                    // Reset BYMONTHDAY, BYDAY, BYSETPOS
                    recurringRule.bymonthday = "";
                    recurringRule.byday = "";
                    recurringRule.bysetpos = "";

                    // Disable all the monthday buttons
                    $('select[class^="yearly"]').attr('disabled', 'disabled');

                    // Enable the buttons
                    $('.yearly-multiple-months button').removeAttr('disabled');
                    break;

                case "yearly-precise":
                    // Example Pattern
                    // FREQ=YEARLY;BYDAY=SU;BYSETPOS=1;BYMONTH=1;UNTIL=20150818;

                    // BYDAY, BYSETPOS, and BYMONTH are going to be set
                    // Reset BYMONTHDAY
                    recurringRule.bymonthday = "";

                    // Disable all the yearly select boxes
                    $('select[class^="yearly"]').attr('disabled', 'disabled');

                    // Disable all the yearly multiple month buttons
                    $('.yearly-multiple-months button').attr('disabled', 'disabled');
                    $('.yearly-multiple-months button').removeClass('active');

                    // Enable Yearly One Month Options
                    $('select[class="yearly-precise"]').removeAttr('disabled');

                    // Fire change to select default values
                    $('select[name="yearly-bysetpos"]').change();
                    break;
            }
        }

    });

    //triger to update rule
    eventChange();

});

// FREQ=YEARLY - Yearly One Month selection
// Example Pattern
// FREQ=YEARLY;BYMONTH=1;BYMONTHDAY=1;UNTIL=20150818;

// BYMONTH and BYMONTHDAY attributes are going to be set

$(document).on('change', 'select[name^="yearly-bymonth"]', function() {
    // Example Pattern
    // FREQ=MONTHLY;INTERVAL=1;BYDAY=SU,SA;BYSETPOS=1;COUNT=1

    // First, Second, Third, Fourth or Last Days
    var bymonth = $('select[name="yearly-bymonth"]').val();

    // Make array of selected days.
    var bymonthday = $('select[name="yearly-bymonthday"]').val();

    recurringRule.bymonth = bymonth;
    recurringRule.bymonthday = bymonthday;

    //trigger to update rule
    eventChange();
});

// FREQ=YEARLY - Yearly Multiple Month selection
// Example Pattern
// FREQ=YEARLY;INTERVAL=1;BYMONTH=1,3,4,10;COUNT=1
$(document).on('click', '.yearly-multiple-months button', function() {
    var bymonth = []; // Array to Store 'bymonth' in. Reset it to '' to store new days in below

    // Store Selected Days in the BYDAY rule
    $('.yearly-multiple-months button').each(function() {

        // Active class is the selected day, store the ID of active days which contains the short day name for the rrule (ex. MO, TU, WE, etc)
        if ($(this).hasClass('active')) {
            bymonth.push($(this).attr('data-month-num'));
        }

    });
    recurringRule.bymonth = bymonth;

    //triger to update rule
    eventChange();

});

// FREQ=YEARLY - Yearly Precise Selection
// Example PAttern
// FREQ=YEARLY;BYDAY=SU;BYSETPOS=1;BYMONTH=1;UNTIL=20150818;

// BYDAY, BYSETPOS, and BYMONTH are going to be set

$(document).on('change', 'select[name="yearly-bysetpos"], select[name="yearly-byday"], select[name="yearly-bymonth-with-bysetpos-byday"]', function() {
    // Example Pattern
    // FREQ=MONTHLY;INTERVAL=1;BYDAY=SU,SA;BYSETPOS=1;COUNT=1

    // First, Second, Third, Fourth or Last Days
    var bysetpos = $('select[name="yearly-bysetpos"]').val();

    // Make array of selected days.
    var byday = $('select[name="yearly-byday"]').val().split(',');

    // First, Second, Third, Fourth or Last Days
    var bymonth = $('select[name="yearly-bymonth-with-bysetpos-byday"]').val();
    //alert($('select[name="yearly-bymonth-with-bysetpos-byday"]').val());

    recurringRule.bymonthday = "";

    recurringRule.bymonth = bymonth;
    recurringRule.byday = byday;
    recurringRule.bysetpos = bysetpos;

    //triger to update rule
    eventChange();

});


// FREQ=MONTHLY
// BYDAY and BYSETPOS MONTHLY Setting
$(document).on('change', 'select[name^="month-byday"]', function() {
    // Example Pattern
    // FREQ=MONTHLY;INTERVAL=1;BYDAY=SU,SA;BYSETPOS=1;COUNT=1

    // First, Second, Third, Fourth or Last Days
    var bySetPos = $('select[name="month-byday-pos"]').val();

    // Make array of selected days.
    var daysSelected = $('select[name="month-byday-pos-name"]').val().split(',');

    recurringRule.bysetpos = bySetPos;
    recurringRule.byday = daysSelected;

    //trigger to update rule
    eventChange();

});

// Set the count variable
$(document).on('input change', 'input[name="count"]', function() {
    recurringRule.count = $(this).val();
    eventChange();
});

//trigger function for any change of this form
function eventChange() {
    var rresult = rruleGenerate();
    var result_readable = rruleTransform(rresult);
    $('#event-recurrence').val(rresult);
    $('#rrule-readable').html("repeat " + result_readable);
}

//trigger function when cliked no repeat
function noRepeat() {
    $('#event-recurrence').val(null);
    $('#rrule-readable').empty();
}

//process date to fit pattern
function dateProcess(value){
  //dateSelected = Date.parseExact(value, "yyyy-MM-dd");
  dateSelected = new Date(value.replace(/-/g, "/") + ' 00:00:00'); // REGEX used to please SAFARI browser!
  untilString = dateSelected.getFullYear() + ('0' + (dateSelected.getMonth() + 1)).slice(-2) + ('0' + dateSelected.getDate()).slice(-2);
  $('#end-date-hidden').val(untilString + 'T040000z');
  // Remove the count variable
  recurringRule.count = '';
  // Set until variable
  recurringRule.until = untilString + 'T040000z';
}

//trigger function when cliked no repeat
function untilSelect() {
  $(document).find('#end-date').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'yy-mm-dd',
      onSelect: function(value) {
        dateProcess(value);
        //trigger to update rule
        eventChange();
      }
  }).datepicker('setDate', 'today');
}


// Handle Until / Count Radio Buttons
$(document).on('change','input[name="end-select"]',function() {
    // Selected Radio Button
    var selectedRadio = $(this).val();

    // A Radio was changed.  Grab all the radio buttons to see which one.
    $('input[name="end-select"]').each(function() {
        // enable the input next to the selected radio button
        if ($(this).val() == selectedRadio) {
            $('input[name="' + selectedRadio + '"]').removeAttr('disabled');
            if ($(this).val() == 'forever') {
                // Remove the count variable
                recurringRule.count = '';
                // remove until variable
                recurringRule.until = '';
            } else if ($(this).val() == 'until') {
                // Remove the count variable
                recurringRule.count = '';
                // reactive datepicker
                untilSelect();
                //auto set UTIL = today
                dateProcess($('#end-date').val());
                eventChange();
            } else {
                // count selected & set count variable
                recurringRule.count = '1';
            }
        } else {
            //disable the inputs not selected.
            $(this).next('input').attr('disabled', 'disabled').val('');

            //reset the stored value in the recurringRule object
            var not_selected = $(this).next('input').attr('name');
            recurringRule[not_selected] = '';
        }

    });

    //triger to update rule
    eventChange();

});
