'use strict';

$(document).ready(function () {
    $("#base-grid").bootgrid({
        ajax: true,
        formatters: {
            "options": function (column, row)
            {
                return "<a href=\"edit/" + row.id + "\">Edit</a> | " +
                        "<a href=\"#\" >Delete</a>";
            }
        }
    });

    $('.form-group .required').each(function () {
        $(this).prev('span').append(' *');
    });
});