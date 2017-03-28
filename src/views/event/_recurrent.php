<?php

use phucnguyenvn\yii2evecalendar\assets\FormAssets;

FormAssets::register($this);

?>

    <p><span style="font-weight:bold;">Recurring Event?
          <label><input type="radio" name="event-recurring" value="no" checked="checked" />No</label>
          <label><input type="radio" name="event-recurring" value="yes" /> Yes</label>
          <span id="rrule-readable"></span>
        <span>
    </p>
    <div id="recurring-rules" style="display:none;">

        <!-- FREQ -->
        <p>Frequency
            <select name="freq">
                <option value="daily" class="days">Daily</option>
                <option value="weekly" class="weeks">Weekly</option>
                <option value="monthly" class="months">Monthly</option>
                <option value="yearly" class="years">Yearly</option>
            </select>
        </p>
        <p>Every
            <input type="number" name="interval" value="1" size="1" /> <span class="freq-selection">day(s)</span>
        </p>


        <!-- BYWEEKDAY -->
        <div id="weekday-select" class="btn-toolbar weeks-choice" role="toolbar" style="display:none;">
            <h4>Which day(s) of the week does this repeat on:</h4>
            <div class="btn-group">
                <button class="btn btn-default btn-recurr" id="SU">Sun</button>
                <button class="btn btn-default btn-recurr" id="MO">Mon</button>
                <button class="btn btn-default btn-recurr" id="TU">Tue</button>
                <button class="btn btn-default btn-recurr" id="WE">Wed</button>
                <button class="btn btn-default btn-recurr" id="TH">Thu</button>
                <button class="btn btn-default btn-recurr" id="FR">Fri</button>
                <button class="btn btn-default btn-recurr" id="SA">Sat</button>
            </div>
        </div>



        <!-- BYMONTH -->
        <div id="bymonth-select" class="btn-toolbar years-choice" role="toolbar" style="display:none;">
            <h4>Which month(s) of the year does this repeat on</h4>

            <p>
                <input type="radio" name="yearly-options" id="yearly-one-month" checked="checked" /> One Month Out of the Year</p>
            on
            <select name="yearly-bymonth" id="yearly-bymonth" class="yearly-one-month">
                <option value="1" selected="yes">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <select name="yearly-bymonthday" id="yearly-bymonthday" class="yearly-one-month">
                <option value="1" selected="yes">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>

            <p>
                <input type="radio" name="yearly-options" id="yearly-multiple-months" /> Multiple Months</p>
            <div style="display:block;float:none;" class="btn-group yearly-multiple-months">
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="1" disabled="disabled">Jan</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="2" disabled="disabled">Feb</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="3" disabled="disabled">Mar</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="4" disabled="disabled">Apr</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="5" disabled="disabled">May</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="6" disabled="disabled">Jun</button>
            </div>
            <div style="display:block;float:none;" class="btn-group yearly-multiple-months">
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="7" disabled="disabled">Jul</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="8" disabled="disabled">Aug</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="9" disabled="disabled">Sep</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="10" disabled="disabled">Oct</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="11" disabled="disabled">Nov</button>
                <button class="btn btn-default btn-recurr" style="width:16.66666666666667%" data-month-num="12" disabled="disabled">Dec</button>
            </div>


            <p>
                <input type="radio" name="yearly-options" id="yearly-precise" /> Or be precise</p>
            on the
            <select name="yearly-bysetpos" class="yearly-precise" disabled="disabled">
                <option value="1" selected="selected">First</option>
                <option value="2">Second</option>
                <option value="3">Third</option>
                <option value="4">Fourth</option>
                <option value="-1">Last</option>
            </select>
            <select name="yearly-byday" class="yearly-precise" disabled="disabled">
                <option value="SU" selected="selected">Sunday</option>
                <option value="MO">Monday</option>
                <option value="TU">Tuesday</option>
                <option value="WE">Wednesday</option>
                <option value="TH">Thursday</option>
                <option value="FR">Friday</option>
                <option value="SA">Saturday</option>
                <option value="SU,MO,TU,WE,TH,FR,SA" selected="selected">Day</option>
                <option value="MO,TU,WE,TH,FR">Weekday</option>
                <option value="SU,SA">Weekend day</option>
            </select>
            in
            <select name="yearly-bymonth-with-bysetpos-byday" id="yearly-bymonth-with-bysetpos-byday" class="yearly-precise" disabled="disabled">
                <option value="1" selected="selected">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

        </div>

        <!-- BYMONTHDAY -->
        <div id="monthday-select" class="btn-toolbar months-choice" role="toolbar" style="display:none;">
            <input type="radio" name="monthday-pos-select" value="monthday-selected" id="monthday-selected" checked="checked" />

            <h4>Which day(s) of the month does this repeat on</h4>
            <div class="btn-group" style="display:block;float:none;">
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="1">1</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="2">2</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="3">3</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="4">4</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="5">5</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="6">6</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="7">7</button>
            </div>
            <div class="btn-group" style="display:block;float:none;">
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="8">8</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="9">9</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="10">10</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="11">11</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="12">12</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="13">13</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="14">14</button>
            </div>
            <div class="btn-group" style="display:block;float:none;">
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="15">15</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="16">16</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="17">17</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="18">18</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="19">19</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="20">20</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="21">21</button>
            </div>
            <div class="btn-group" style="display:block;float:none;">
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="22">22</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="23">23</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="24">24</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="25">25</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="26">26</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="27">27</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="28">28</button>
            </div>
            <div class="btn-group" style="display:block;float:none;">
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="29">29</button>
                <button class="btn btn-default btn-recurr" style="width:14.28571428571429%;" data-day-num="30">30</button>
            </div>

            <!-- BYDAY -->
            <div>
                <input type="radio" name="monthday-pos-select" value="month-byday-pos-selected" id="month-byday-pos-selected" /> Or
                <select name="month-byday-pos" disabled="yes">
                    <option value="1" selected="selected">First</option>
                    <option value="2">Second</option>
                    <option value="3">Third</option>
                    <option value="4">Fourth</option>
                    <option value="-1">Last</option>
                </select>
                <select name="month-byday-pos-name" disabled="yes">
                    <option value="SU">Sunday</option>
                    <option value="MO">Monday</option>
                    <option value="TU">Tuesday</option>
                    <option value="WE">Wednesday</option>
                    <option value="TH">Thursday</option>
                    <option value="FR">Friday</option>
                    <option value="SA">Saturday</option>
                    <option value="SU,MO,TU,WE,TH,FR,SA" selected="selected">Day</option>
                    <option value="MO,TU,WE,TH,FR">Weekday</option>
                    <option value="SU,SA">Weekend day</option>
                </select>
            </div>
        </div>

        <div id="until-rules" style="display:none;">
            <p>Until</p>
            <p>
                <label for="forever-select">
                <input type="radio" name="end-select" value="forever" id="forever-select" checked="checked" /> Forever
            </p>
            <p>
                <label for="count-select">
                    <input type="radio" name="end-select" value="count" id="count-select" /> How many times does this transaction occur?

                    <input autocomplete="off" type="number" name="count" min="1" max="50" value="1" step="1" /> Time(s)</label>
            </p>
            <p>
                <label for="until-select">
                    <input type="radio" name="end-select" value="until" id="until-select" /> Specific Date (aka until)
                    <input type="text" name="until" id="end-date" disabled="yes" />
                    <input type="hidden" name="end-date-formatted" id="end-date-hidden" value="" />
                </label>
            </p>
        </div>
    </div>
<div class="show-dates">
</div>
<div class="readout">

</div>
