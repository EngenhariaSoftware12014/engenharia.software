/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * @fileoverview    functions used on the database structure page
 * @name            Database Structure
 *
 * @requires    jQuery
 * @requires    jQueryUI
 * @required    js/functions.js
 */

/**
 * AJAX scripts for db_structure.php
 *
 * Actions ajaxified here:
 * Drop Database
 * Truncate Table
 * Drop Table
 *
 */

/**
 * Unbind all event handlers before tearing down a page
 */
AJAX.registerTeardown('db_structure.js', function () {
    $("span.fkc_switch").unbind('click');
    $('#fkc_checkbox').unbind('change');
    $("a.truncate_table_anchor.ajax").die('click');
    $("a.drop_table_anchor.ajax").die('click');
    $('a.drop_tracking_anchor.ajax').die('click');
    $('#real_end_input').die('click');
});

/**
 * Adjust number of rows and total size in the summary
 * when truncating, creating, dropping or inserting into a table
 */
function PMA_adjustTotals() {
    var byteUnits = new Array(
        PMA_messages.strB,
        PMA_messages.strKiB,
        PMA_messages.strMiB,
        PMA_messages.strGiB,
        PMA_messages.strTiB,
        PMA_messages.strPiB,
        PMA_messages.strEiB
    );
    /**
     * @var $allTr jQuery object that references all the rows in the list of tables
     */
    var $allTr = $("#tablesForm table.data tbody:first tr");
    // New summary values for the table
    var tableSum = $allTr.size();
    var rowsSum = 0;
    var sizeSum = 0;
    var overheadSum = 0;
    var rowSumApproximated = false;

    $allTr.each(function () {
        var $this = $(this);
        var i, tmpVal;
        // Get the number of rows for this SQL table
        var strRows = $this.find('.tbl_rows').text();
        // If the value is approximated
        if (strRows.indexOf('~') === 0) {
            rowSumApproximated = true;
            // The approximated value contains a preceding ~ and a following 2 (Eg 100 --> ~1002)
            strRows = strRows.substring(1, strRows.length - 1);
        }
        strRows = strRows.replace(/[,.]/g, '');
        var intRow = parseInt(strRows, 10);
        if (! isNaN(intRow)) {
            rowsSum += intRow;
        }
        // Extract the size and overhead
        var valSize         = 0;
        var valOverhead     = 0;
        var strSize         = $.trim($this.find('.tbl_size span:not(.unit)').text());
        var strSizeUnit     = $.trim($this.find('.tbl_size span.unit').text());
        var strOverhead     = $.trim($this.find('.tbl_overhead span:not(.unit)').text());
        var strOverheadUnit = $.trim($this.find('.tbl_overhead span.unit').text());
        // Given a value and a unit, such as 100 and KiB, for the table size
        // and overhead calculate their numeric values in bytes, such as 102400
        for (i = 0; i < byteUnits.length; i++) {
            if (strSizeUnit == byteUnits[i]) {
                tmpVal = parseFloat(strSize);
                valSize = tmpVal * Math.pow(1024, i);
                break;
            }
        }
        for (i = 0; i < byteUnits.length; i++) {
            if (strOverheadUnit == byteUnits[i]) {
                tmpVal = parseFloat(strOverhead);
                valOverhead = tmpVal * Math.pow(1024, i);
                break;
            }
        }
        sizeSum += valSize;
        overheadSum += valOverhead;
    });
    // Add some commas for readablility:
    // 1000000 becomes 1,000,000
    var strRowSum = rowsSum + "";
    var regex = /(\d+)(\d{3})/;
    while (regex.test(strRowSum)) {
        strRowSum = strRowSum.replace(regex, '$1' + ',' + '$2');
    }
    // If approximated total value add ~ in front
    if (rowSumApproximated) {
        strRowSum = "~" + strRowSum;
    }
    // Calculate the magnitude for the size and overhead values
    var size_magnitude = 0, overhead_magnitude = 0;
    while (sizeSum >= 1024) {
        sizeSum /= 1024;
        size_magnitude++;
    }
    while (overheadSum >= 1024) {
        overheadSum /= 1024;
        overhead_magnitude++;
    }

    sizeSum = Math.round(sizeSum * 10) / 10;
    overheadSum = Math.round(overheadSum * 10) / 10;

    // Update summary with new data
    var $summary = $("#tbl_summary_row");
    $summary.find('.tbl_num').text($.sprintf(PMA_messages.strTables, tableSum));
    $summary.find('.tbl_rows').text(strRowSum);
    $summary.find('.tbl_size').text(sizeSum + " " + byteUnits[size_magnitude]);
    $summary.find('.tbl_overhead').text(overheadSum + " " + byteUnits[overhead_magnitude]);
}

AJAX.registerOnload('db_structure.js', function () {
    /**
     * Handler for the print view multisubmit.
     * All other multi submits can be handled via ajax, but this one needs
     * special treatment as the results need to open in another browser window
     */
    $('#tablesForm').submit(function (event) {
        var $form = $(this);
        if ($form.find('select[name=submit_mult]').val() === 'print') {
            event.preventDefault();
            event.stopPropagation();
            $('form#clone').remove();
            var $clone = $form
                .clone()
                .hide()
                .appendTo('body');
            $clone
                .find('select[name=submit_mult]')
                .val('print');
            $clone
                .attr('target', 'printview')
                .attr('id', 'clone')
                .submit();
        }
    });

     /**
     * Event handler for 'Foreign Key Checks' disabling option
     * in the drop table confirmation form
     */
    $("span.fkc_switch").click(function (event) {
        if ($("#fkc_checkbox").prop('checked')) {
            $("#fkc_checkbox").prop('checked', false);
            $("#fkc_status").html(PMA_messages.strForeignKeyCheckDisabled);
            return;
        }
        $("#fkc_checkbox").prop('checked', true);
        $("#fkc_status").html(PMA_messages.strForeignKeyCheckEnabled);
    });

    $('#fkc_checkbox').change(function () {
        if ($(this).prop("checked")) {
            $("#fkc_status").html(PMA_messages.strForeignKeyCheckEnabled);
            return;
        }
        $("#fkc_status").html(PMA_messages.strForeignKeyCheckDisabled);
    }); // End of event handler for 'Foreign Key Check'

    /**
     * Ajax Event handler for 'Truncate Table'
     */
    $("a.truncate_table_anchor.ajax").live('click', function (event) {
        event.preventDefault();

        /**
         * @var $this_anchor Object  referring to the anchor clicked
         */
        var $this_anchor = $(this);

        //extract current table name and build the question string
        /**
         * @var curr_table_name String containing the name of the table to be truncated
         */
        var curr_table_name = $this_anchor.parents('tr').children('th').children('a').text();
        /**
         * @var question    String containing the question to be asked for confirmation
         */
        var question = PMA_messages.strTruncateTableStrongWarning + ' ' +
            $.sprintf(PMA_messages.strDoYouReally, 'TRUNCATE ' + escapeHtml(curr_table_name));

        $this_anchor.PMA_confirm(question, $this_anchor.attr('href'), function (url) {

            PMA_ajaxShowMessage(PMA_messages.strProcessingRequest);

            $.get(url, {'is_js_confirmed' : 1, 'ajax_request' : true}, function (data) {
                if (data.success === true) {
                    PMA_ajaxShowMessage(data.message);
                    // Adjust table statistics
                    var $tr = $this_anchor.closest('tr');
                    $tr.find('.tbl_rows').text('0');
                    $tr.find('.tbl_size, .tbl_overhead').text('-');
                    //Fetch inner span of this anchor
                    //and replace the icon with its disabled version
                    var span = $this_anchor.html().replace(/b_empty/, 'bd_empty');
                    //To disable further attempts to truncate the table,
                    //replace the a element with its inner span (modified)
                    $this_anchor
                        .replaceWith(span)
                        .removeClass('truncate_table_anchor');
                    PMA_adjustTotals();
                } else {
                    PMA_ajaxShowMessage(PMA_messages.strErrorProcessingRequest + " : " + data.error, false);
                }
            }); // end $.get()
        }); //end $.PMA_confirm()
    }); //end of Truncate Table Ajax action

    /**
     * Ajax Event handler for 'Drop Table' or 'Drop View'
     */
    $("a.drop_table_anchor.ajax").live('click', function (event) {
        event.preventDefault();

        var $this_anchor = $(this);

        //extract current table name and build the question string
        /**
         * @var $curr_row    Object containing reference to the current row
         */
        var $curr_row = $this_anchor.parents('tr');
        /**
         * @var curr_table_name String containing the name of the table to be truncated
         */
        var curr_table_name = $curr_row.children('th').children('a').text();
        /**
         * @var is_view Boolean telling if we have a view
         */
        var is_view = $curr_row.hasClass('is_view') || $this_anchor.hasClass('view');
        /**
         * @var question    String containing the question to be asked for confirmation
         */
        var question;
        if (! is_view) {
            question = PMA_messages.strDropTableStrongWarning + ' ' +
                $.sprintf(PMA_messages.strDoYouReally, 'DROP TABLE ' + escapeHtml(curr_table_name));
        } else {
            question =
                $.sprintf(PMA_messages.strDoYouReally, 'DROP VIEW ' + escapeHtml(curr_table_name));
        }

        $this_anchor.PMA_confirm(question, $this_anchor.attr('href'), function (url) {

            var $msg = PMA_ajaxShowMessage(PMA_messages.strProcessingRequest);

            $.get(url, {'is_js_confirmed' : 1, 'ajax_request' : true}, function (data) {
                if (data.success === true) {
                    PMA_ajaxShowMessage(data.message);
                    toggleRowColors($curr_row.next());
                    $curr_row.hide("medium").remove();
                    PMA_adjustTotals();
                    PMA_reloadNavigation();
                    PMA_ajaxRemoveMessage($msg);
                } else {
                    PMA_ajaxShowMessage(PMA_messages.strErrorProcessingRequest + " : " + data.error, false);
                }
            }); // end $.get()
        }); // end $.PMA_confirm()
    }); //end of Drop Table Ajax action

    /**
     * Ajax Event handler for 'Drop tracking'
     */
    $('a.drop_tracking_anchor.ajax').live('click', function (event) {
        event.preventDefault();

        var $anchor = $(this);

        /**
         * @var curr_tracking_row   Object containing reference to the current tracked table's row
         */
        var $curr_tracking_row = $anchor.parents('tr');
         /**
         * @var question    String containing the question to be asked for confirmation
         */
        var question = PMA_messages.strDeleteTrackingData;

        $anchor.PMA_confirm(question, $anchor.attr('href'), function (url) {

            PMA_ajaxShowMessage(PMA_messages.strDeletingTrackingData);

            $.get(url, {'is_js_confirmed': 1, 'ajax_request': true}, function (data) {
                if (data.success === true) {
                    var $tracked_table = $curr_tracking_row.parents('table');
                    var table_name = $curr_tracking_row.find('td:nth-child(2)').text();

                    // Check how many rows will be left after we remove
                    if ($tracked_table.find('tbody tr').length === 1) {
                        // We are removing the only row it has
                        $('#tracked_tables').hide("slow").remove();
                    } else {
                        // There are more rows left after the deletion
                        toggleRowColors($curr_tracking_row.next());
                        $curr_tracking_row.hide("slow", function () {
                            $(this).remove();
                        });
                    }

                    // Make the removed table visible in the list of 'Untracked tables'.
                    var $untracked_table = $('table#noversions');

                    // This won't work if no untracked tables are there.
                    if ($untracked_table.length > 0) {
                        var $rows = $untracked_table.find('tbody tr');

                        $rows.each(function (index) {
                            var $row = $(this);
                            var tmp_tbl_name = $row.find('td:first-child').text();
                            var is_last_iteration = (index == ($rows.length - 1));

                            if (tmp_tbl_name > table_name || is_last_iteration) {
                                var $cloned = $row.clone();

                                // Change the table name of the cloned row.
                                $cloned.find('td:first-child').text(table_name);

                                // Change the link of the cloned row.
                                var new_url = $cloned
                                    .find('td:nth-child(2) a')
                                    .attr('href')
                                    .replace('table=' + tmp_tbl_name, 'table=' + encodeURIComponent(table_name));
                                $cloned.find('td:nth-child(2) a').attr('href', new_url);

                                // Insert the cloned row in an appropriate location.
                                if (tmp_tbl_name > table_name) {
                                    $cloned.insertBefore($row);
                                    toggleRowColors($row);
                                    return false;
                                } else {
                                    $cloned.insertAfter($row);
                                    toggleRowColors($cloned);
                                }
                            }
                        });
                    }

                    PMA_ajaxShowMessage(data.message);
                } else {
                    PMA_ajaxShowMessage(PMA_messages.strErrorProcessingRequest + " : " + data.error, false);
                }
            }); // end $.get()
        }); // end $.PMA_confirm()
    }); //end Drop Tracking

    //Calculate Real End for InnoDB
    /**
     * Ajax Event handler for calculatig the real end for a InnoDB table
     *
     */
    $('#real_end_input').live('click', function (event) {
        event.preventDefault();

        /**
         * @var question    String containing the question to be asked for confirmation
         */
        var question = PMA_messages.strOperationTakesLongTime;

        $(this).PMA_confirm(question, '', function () {
            return true;
        });
        return false;
    }); //end Calculate Real End for InnoDB

}); // end $()
;

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * @fileoverview    function used in table data manipulation pages
 *
 * @requires    jQuery
 * @requires    jQueryUI
 * @requires    js/functions.js
 *
 */

/**
 * Modify form controls when the "NULL" checkbox is checked
 *
 * @param theType     string   the MySQL field type
 * @param urlField    string   the urlencoded field name - OBSOLETE
 * @param md5Field    string   the md5 hashed field name
 * @param multi_edit  string   the multi_edit row sequence number
 *
 * @return boolean  always true
 */
function nullify(theType, urlField, md5Field, multi_edit)
{
    var rowForm = document.forms['insertForm'];

    if (typeof(rowForm.elements['funcs' + multi_edit + '[' + md5Field + ']']) != 'undefined') {
        rowForm.elements['funcs' + multi_edit + '[' + md5Field + ']'].selectedIndex = -1;
    }

    // "ENUM" field with more than 20 characters
    if (theType == 1) {
        rowForm.elements['fields' + multi_edit + '[' + md5Field +  ']'][1].selectedIndex = -1;
    }
    // Other "ENUM" field
    else if (theType == 2) {
        var elts     = rowForm.elements['fields' + multi_edit + '[' + md5Field + ']'];
        // when there is just one option in ENUM:
        if (elts.checked) {
            elts.checked = false;
        } else {
            var elts_cnt = elts.length;
            for (var i = 0; i < elts_cnt; i++) {
                elts[i].checked = false;
            } // end for

        } // end if
    }
    // "SET" field
    else if (theType == 3) {
        rowForm.elements['fields' + multi_edit + '[' + md5Field +  '][]'].selectedIndex = -1;
    }
    // Foreign key field (drop-down)
    else if (theType == 4) {
        rowForm.elements['fields' + multi_edit + '[' + md5Field +  ']'].selectedIndex = -1;
    }
    // foreign key field (with browsing icon for foreign values)
    else if (theType == 6) {
        rowForm.elements['fields' + multi_edit + '[' + md5Field + ']'].value = '';
    }
    // Other field types
    else /*if (theType == 5)*/ {
        rowForm.elements['fields' + multi_edit + '[' + md5Field + ']'].value = '';
    } // end if... else if... else

    return true;
} // end of the 'nullify()' function


/**
 * javascript DateTime format validation.
 * its used to prevent adding default (0000-00-00 00:00:00) to database when user enter wrong values
 * Start of validation part
 */
//function checks the number of days in febuary
function daysInFebruary(year)
{
    return (((year % 4 === 0) && (((year % 100 !== 0)) || (year % 400 === 0))) ? 29 : 28);
}
//function to convert single digit to double digit
function fractionReplace(num)
{
    num = parseInt(num, 10);
    return num >= 1 && num <= 9 ? '0' + num : '00';
}

/* function to check the validity of date
* The following patterns are accepted in this validation (accepted in mysql as well)
* 1) 2001-12-23
* 2) 2001-1-2
* 3) 02-12-23
* 4) And instead of using '-' the following punctuations can be used (+,.,*,^,@,/) All these are accepted by mysql as well. Therefore no issues
*/
function isDate(val, tmstmp)
{
    val = val.replace(/[.|*|^|+|//|@]/g, '-');
    var arrayVal = val.split("-");
    for (var a = 0; a < arrayVal.length; a++) {
        if (arrayVal[a].length == 1) {
            arrayVal[a] = fractionReplace(arrayVal[a]);
        }
    }
    val = arrayVal.join("-");
    var pos = 2;
    var dtexp = new RegExp(/^([0-9]{4})-(((01|03|05|07|08|10|12)-((0[0-9])|([1-2][0-9])|(3[0-1])))|((02|04|06|09|11)-((0[0-9])|([1-2][0-9])|30)))$/);
    if (val.length == 8) {
        pos = 0;
    }
    if (dtexp.test(val)) {
        var month = parseInt(val.substring(pos + 3, pos + 5), 10);
        var day = parseInt(val.substring(pos + 6, pos + 8), 10);
        var year = parseInt(val.substring(0, pos + 2), 10);
        if (month == 2 && day > daysInFebruary(year)) {
            return false;
        }
        if (val.substring(0, pos + 2).length == 2) {
            year = parseInt("20" + val.substring(0, pos + 2), 10);
        }
        if (tmstmp === true) {
            if (year < 1978) {
                return false;
            }
            if (year > 2038 || (year > 2037 && day > 19 && month >= 1) || (year > 2037 && month > 1)) {
                return false;
            }
        }
    } else {
        return false;
    }
    return true;
}

/* function to check the validity of time
* The following patterns are accepted in this validation (accepted in mysql as well)
* 1) 2:3:4
* 2) 2:23:43
* 3) 2:23:43.123456
*/
function isTime(val)
{
    var arrayVal = val.split(":");
    for (var a = 0, l = arrayVal.length; a < l; a++) {
        if (arrayVal[a].length == 1) {
            arrayVal[a] = fractionReplace(arrayVal[a]);
        }
    }
    val = arrayVal.join(":");
    var tmexp = new RegExp(/^(([0-1][0-9])|(2[0-3])):((0[0-9])|([1-5][0-9])):((0[0-9])|([1-5][0-9]))(\.[0-9]{1,6}){0,1}$/);
    return tmexp.test(val);
}

function verificationsAfterFieldChange(urlField, multi_edit, theType)
{
    var evt = window.event || arguments.callee.caller.arguments[0];
    var target = evt.target || evt.srcElement;

    //To generate the textbox that can take the salt
    var new_salt_box = "<br><input type=text name=salt[multi_edit][" + multi_edit + "][" + urlField + "]" +
        " id=salt_" + target.id + " placeholder='enter Salt'>";

    //If AES_ENCRYPT is Selected then append the new textbox for salt
    if (target.value == "AES_ENCRYPT" && !($("#salt_" + target.id).length)) {
        $("input[name='fields[multi_edit][" + multi_edit + "][" + urlField + "]']").after(new_salt_box);
    } else {
        //The value of the select is no longer AES_ENCRYPT, remove the textbox for salt
        $("#salt_" + target.id).remove();
    }

    // Unchecks the corresponding "NULL" control
    $("input[name='fields_null[multi_edit][" + multi_edit + "][" + urlField + "]']").prop('checked', false);

    // Unchecks the Ignore checkbox for the current row
    $("input[name='insert_ignore_" + multi_edit + "']").prop('checked', false);
    var $this_input = $("input[name='fields[multi_edit][" + multi_edit + "][" + urlField + "]']");

    // Does this field come from datepicker?
    if ($this_input.data('comes_from') == 'datepicker') {
        // Yes, so do not validate because the final value is not yet in
        // the field and hopefully the datepicker returns a valid date+time
        $this_input.removeClass("invalid_value");
        return true;
    }

    if (target.name.substring(0, 6) == "fields") {
        // validate for date time
        if (theType == "datetime" || theType == "time" || theType == "date" || theType == "timestamp") {
            $this_input.removeClass("invalid_value");
            var dt_value = $this_input.val();
            if (theType == "date") {
                if (! isDate(dt_value)) {
                    $this_input.addClass("invalid_value");
                    return false;
                }
            } else if (theType == "time") {
                if (! isTime(dt_value)) {
                    $this_input.addClass("invalid_value");
                    return false;
                }
            } else if (theType == "datetime" || theType == "timestamp") {
                var tmstmp = false;
                if (dt_value == "CURRENT_TIMESTAMP") {
                    return true;
                }
                if (theType == "timestamp") {
                    tmstmp = true;
                }
                if (dt_value == "0000-00-00 00:00:00") {
                    return true;
                }
                var dv = dt_value.indexOf(" ");
                if (dv == -1) {
                    $this_input.addClass("invalid_value");
                    return false;
                } else {
                    if (! (isDate(dt_value.substring(0, dv), tmstmp) && isTime(dt_value.substring(dv + 1)))) {
                        $this_input.addClass("invalid_value");
                        return false;
                    }
                }
            }
        }
        //validate for integer type
        if (theType.substring(0, 3) == "int") {
            $this_input.removeClass("invalid_value");
            if (isNaN($this_input.val())) {
                $this_input.addClass("invalid_value");
                return false;
            }
        }
    }
}
 /* End of datetime validation*/


/**
 * Unbind all event handlers before tearing down a page
 */
AJAX.registerTeardown('tbl_change.js', function () {
    $('span.open_gis_editor').die('click');
    $("input[name='gis_data[save]']").die('click');
    $('input.checkbox_null').die('click');
    $('select[name="submit_type"]').unbind('change');
    $("#insert_rows").die('change');
});

/**
 * Ajax handlers for Change Table page
 *
 * Actions Ajaxified here:
 * Submit Data to be inserted into the table.
 * Restart insertion with 'N' rows.
 */
AJAX.registerOnload('tbl_change.js', function () {
    $.datepicker.initialized = false;

    $('span.open_gis_editor').live('click', function (event) {
        event.preventDefault();

        var $span = $(this);
        // Current value
        var value = $span.parent('td').children("input[type='text']").val();
        // Field name
        var field = $span.parents('tr').children('td:first').find("input[type='hidden']").val();
        // Column type
        var type = $span.parents('tr').find('span.column_type').text();
        // Names of input field and null checkbox
        var input_name = $span.parent('td').children("input[type='text']").attr('name');
        //Token
        var token = $("input[name='token']").val();

        openGISEditor();
        if (!gisEditorLoaded) {
            loadJSAndGISEditor(value, field, type, input_name, token);
        } else {
            loadGISEditor(value, field, type, input_name, token);
        }
    });

    /**
     * Uncheck the null checkbox as geometry data is placed on the input field
     */
    $("input[name='gis_data[save]']").live('click', function (event) {
        var input_name = $('form#gis_data_editor_form').find("input[name='input_name']").val();
        var $null_checkbox = $("input[name='" + input_name + "']").parents('tr').find('.checkbox_null');
        $null_checkbox.prop('checked', false);
    });

    /**
     * Handles all current checkboxes for Null; this only takes care of the
     * checkboxes on currently displayed rows as the rows generated by
     * "Continue insertion" are handled in the "Continue insertion" code
     *
     */
    $('input.checkbox_null').live('click', function (e) {
        nullify(
            // use hidden fields populated by tbl_change.php
            $(this).siblings('.nullify_code').val(),
            $(this).closest('tr').find('input:hidden').first().val(),
            $(this).siblings('.hashed_field').val(),
            $(this).siblings('.multi_edit').val()
        );
    });


    /**
     * Reset the auto_increment column to 0 when selecting any of the
     * insert options in submit_type-dropdown. Only perform the reset
     * when we are in edit-mode, and not in insert-mode(no previous value
     * available).
     */
    $('select[name="submit_type"]').bind('change', function (e) {
        var $table = $('table.insertRowTable');
        var auto_increment_column = $table.find('input[name^="auto_increment"]').attr('name');
        if (auto_increment_column) {
            var prev_value_field = $table.find('input[name="' + auto_increment_column.replace('auto_increment', 'fields_prev') + '"]');
            var value_field = $table.find('input[name="' + auto_increment_column.replace('auto_increment', 'fields') + '"]');
            var previous_value = $(prev_value_field).val();
            if (previous_value !== undefined) {
                if ($(this).val() == 'insert' || $(this).val() == 'insertignore' || $(this).val() == 'showinsert') {
                    $(value_field).val(0);
                } else {
                    $(value_field).val(previous_value);
                }
            }
        }
    });

    /**
     * Continue Insertion form
     */
    $("#insert_rows").live('change', function (event) {
        event.preventDefault();

        /**
         * @var curr_rows   Number of current insert rows already on page
         */
        var curr_rows = $("table.insertRowTable").length;
        /**
         * @var target_rows Number of rows the user wants
         */
        var target_rows = $("#insert_rows").val();

        // remove all datepickers
        $('input.datefield, input.datetimefield').each(function () {
            $(this).datepicker('destroy');
        });

        if (curr_rows < target_rows) {
            while (curr_rows < target_rows) {

                /**
                 * @var $last_row    Object referring to the last row
                 */
                var $last_row = $("#insertForm").find(".insertRowTable:last");

                // need to access this at more than one level
                // (also needs improvement because it should be calculated
                //  just once per cloned row, not once per column)
                var new_row_index = 0;

                //Clone the insert tables
                $last_row
                .clone()
                .insertBefore("#actions_panel")
                .find('input[name*=multi_edit],select[name*=multi_edit],textarea[name*=multi_edit]')
                .each(function () {

                    var $this_element = $(this);
                    /**
                     * Extract the index from the name attribute for all input/select fields and increment it
                     * name is of format funcs[multi_edit][10][<long random string of alphanum chars>]
                     */

                    /**
                     * @var this_name   String containing name of the input/select elements
                     */
                    var this_name = $this_element.attr('name');
                    /** split {@link this_name} at [10], so we have the parts that can be concatenated later */
                    var name_parts = this_name.split(/\[\d+\]/);
                    /** extract the [10] from  {@link name_parts} */
                    var old_row_index_string = this_name.match(/\[\d+\]/)[0];
                    /** extract 10 - had to split into two steps to accomodate double digits */
                    var old_row_index = parseInt(old_row_index_string.match(/\d+/)[0], 10);

                    /** calculate next index i.e. 11 */
                    new_row_index = old_row_index + 1;
                    /** generate the new name i.e. funcs[multi_edit][11][foobarbaz] */
                    var new_name = name_parts[0] + '[' + new_row_index + ']' + name_parts[1];

                    var hashed_field = name_parts[1].match(/\[(.+)\]/)[1];
                    $this_element.attr('name', new_name);

                    // handle input text fields and textareas
                    if ($this_element.is('.textfield') || $this_element.is('.char')) {
                        // do not remove the 'value' attribute for ENUM columns
                        if ($this_element.closest('tr').find('span.column_type').html() != 'enum') {
                            $this_element.val($this_element.closest('tr').find('span.default_value').html());
                        }
                        $this_element
                        .unbind('change')
                        // Remove onchange attribute that was placed
                        // by tbl_change.php; it refers to the wrong row index
                        .attr('onchange', null)
                        // Keep these values to be used when the element
                        // will change
                        .data('hashed_field', hashed_field)
                        .data('new_row_index', new_row_index)
                        .bind('change', function (e) {
                            var $changed_element = $(this);
                            verificationsAfterFieldChange(
                                $changed_element.data('hashed_field'),
                                $changed_element.data('new_row_index'),
                                $changed_element.closest('tr').find('span.column_type').html()
                            );
                        });
                    }

                    if ($this_element.is('.checkbox_null')) {
                        $this_element
                        // this event was bound earlier by jQuery but
                        // to the original row, not the cloned one, so unbind()
                        .unbind('click')
                        // Keep these values to be used when the element
                        // will be clicked
                        .data('hashed_field', hashed_field)
                        .data('new_row_index', new_row_index)
                        .bind('click', function (e) {
                            var $changed_element = $(this);
                            nullify(
                                $changed_element.siblings('.nullify_code').val(),
                                $this_element.closest('tr').find('input:hidden').first().val(),
                                $changed_element.data('hashed_field'),
                                '[multi_edit][' + $changed_element.data('new_row_index') + ']'
                            );
                        });
                    }
                }) // end each
                .end()
                .find('.foreign_values_anchor')
                .each(function () {
                        var $anchor = $(this);
                        var new_value = 'rownumber=' + new_row_index;
                        // needs improvement in case something else inside
                        // the href contains this pattern
                        var new_href = $anchor.attr('href').replace(/rownumber=\d+/, new_value);
                        $anchor.attr('href', new_href);
                    });

                //Insert/Clone the ignore checkboxes
                if (curr_rows == 1) {
                    $('<input id="insert_ignore_1" type="checkbox" name="insert_ignore_1" checked="checked" />')
                    .insertBefore("table.insertRowTable:last")
                    .after('<label for="insert_ignore_1">' + PMA_messages.strIgnore + '</label>');
                } else {

                    /**
                     * @var $last_checkbox   Object reference to the last checkbox in #insertForm
                     */
                    var $last_checkbox = $("#insertForm").children('input:checkbox:last');

                    /** name of {@link $last_checkbox} */
                    var last_checkbox_name = $last_checkbox.attr('name');
                    /** index of {@link $last_checkbox} */
                    var last_checkbox_index = parseInt(last_checkbox_name.match(/\d+/), 10);
                    /** name of new {@link $last_checkbox} */
                    var new_name = last_checkbox_name.replace(/\d+/, last_checkbox_index + 1);

                    $last_checkbox
                    .clone()
                    .attr({'id': new_name, 'name': new_name})
                    .prop('checked', true)
                    .add('label[for^=insert_ignore]:last')
                    .clone()
                    .attr('for', new_name)
                    .before('<br />')
                    .insertBefore("table.insertRowTable:last");
                }
                curr_rows++;
            }
            // recompute tabindex for text fields and other controls at footer;
            // IMO it's not really important to handle the tabindex for
            // function and Null
            var tabindex = 0;
            $('.textfield, .char, textarea')
            .each(function () {
                tabindex++;
                $(this).attr('tabindex', tabindex);
                // update the IDs of textfields to ensure that they are unique
                $(this).attr('id', "field_" + tabindex + "_3");
            });
            $('.control_at_footer')
            .each(function () {
                tabindex++;
                $(this).attr('tabindex', tabindex);
            });
        } else if (curr_rows > target_rows) {
            while (curr_rows > target_rows) {
                $("input[id^=insert_ignore]:last")
                .nextUntil("fieldset")
                .andSelf()
                .remove();
                curr_rows--;
            }
        }
    });
    // Add all the required datepickers back
    addDateTimePicker();
});

function changeValueFieldType(elem, searchIndex)
{
    var fieldsValue = $("select#fieldID_" + searchIndex);
    if (0 == fieldsValue.size()) {
        return;
    }

    var type = $(elem).val();
    if (
        'IN (...)' == type
        || 'NOT IN (...)' == type
        || 'BETWEEN' == type
        || 'NOT BETWEEN' == type
    ) {
        $("#fieldID_" + searchIndex).attr('multiple', '');
    } else {
        $("#fieldID_" + searchIndex).removeAttr('multiple');
    }
}
;

AJAX.scriptHandler.done();