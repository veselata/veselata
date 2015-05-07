'use strict';

$(document).ready(function () {
    $("#base-grid").bootgrid({
        ajax: true,
        formatters: {
            "options": function (column, row)
            {
                return "<a href=\"edit\">Edit</a>";
            }
        }
    });
});