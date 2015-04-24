'use strict';

$(window).scroll(function () {
    var totalHeight = $('body').height();
    var yPos = $(window).scrollTop();
    if (yPos > (totalHeight * .10) && yPos < (totalHeight * .90)) {
        $(".navbar-fixed-top").fadeIn('fast');
    } else {
        $('.navbar-fixed-top').fadeOut('fast');
    }
});

$(document).ready(function () {

    $('a.tooltipsy').tooltip();

    $('.form-group .required').each(function () {
        $(this).attr('placeholder', $(this).attr('placeholder') + ' *');
    });

    $('.flexslider').flexslider({animation: "slide", itemMargin: 5});

    $('#top-trigger').on('click', function () {
        $('.top-content-inset').slideToggle(300);
    });

    $('ul.sortable li').hover(function () {
        $(this).find('.mask-img').fadeOut('slow');
    }, function () {
        $(this).find('.mask-img').fadeIn('slow');
    });

    $('.inner-paginator a').hover(function () {
        $(this).find('.hidden-box').fadeIn();
    }, function () {
        $(this).find('.hidden-box').fadeOut();
    });

    var $sortHolder = $('ul.sortable');

    $('ul.sortFilter li a').on('click', function () {
        $('ul.sortFilter li').removeClass('active');
        var filterType = $(this).data('filter');
        $(this).parent().addClass('active');

        var filtredData;
        if (filterType !== 'all') {
            filtredData = $sortHolder.find('li[data-type=' + filterType + ']');
        } else {
            filtredData = $sortHolder.find('li');
        }

        $sortHolder.find('li').fadeOut(100);
        filtredData.delay(500).fadeIn('slow');

        return false;
    });
});


$(function () {
    $('.project-info a').on('click', function (event) {
        event.preventDefault();
        var projectId = $(this).closest('div').data('project-id');

        $.ajax('/project/like', {
            type: 'post',
            dataType: 'json',
            data: {projectId: parseInt(projectId)}
        })
                .done(function (response) {
                    $('.project-info[data-project-id="' + response.projectId + '"] a').find('span.count').text(parseInt(response.likes));
                })
                .fail(function () {
                    //  console.log('fail');
                })
                .always(function (response) {
                });
        return false;
    });
});