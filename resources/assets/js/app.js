/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

// Set up csrf token for jquery ajax
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// Initialize tooltips
$('[data-toggle="tooltip"]').tooltip();
// Initialize bootstrap confirmation
$('[data-toggle=deleteConfirmation]').confirmation({
    rootSelector: '[data-toggle=deleteConfirmation]',
    singleton: true,
    popout: true,
    btnOkLabel: 'Delete',
    btnOkIcon: 'glyphicon glyphicon-trash',
    btnOkClass: 'btn-success',
    btnCancelLabel: 'Cancel',
    btnCancelIcon: 'glyphicon glyphicon-ban-circle',
    btnCancelClass: 'btn-danger',
});
// Initialize remote user select2
$('[data-toggle="remoteUserSelect2"]').select2({
    ajax: {
        data: function (params) {
            return {
                term: params.term, // search term
                page: params.page,
                notUsers: $(this).val()
            };
        },
        dataType: 'json',
        delay: 250,
        processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;
            return {
                results: $.map(data.data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                }),
                pagination: {
                    more: (params.page * 30) < data.total
                }
            };
        },
        cache: true
    },
    minimumInputLength: 1,
    allowClear: true,
});
// Initialize remote location select2
$('[data-toggle="remoteLocationSelect2"]').select2({
    ajax: {
        data: function (params) {
            return {
                term: params.term, // search term
                page: params.page,
                notLocation: $(this).data('currentLocationId'),
            };
        },
        dataType: 'json',
        delay: 250,
        processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;
            return {
                results: $.map(data.data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                }),
                pagination: {
                    more: (params.page * 30) < data.total
                }
            };
        },
        cache: true
    },
    minimumInputLength: 1,
    allowClear: true,
});
// Login form
$('a#logout-link').click(function () {
    event.preventDefault();
    $('#logout-form').submit();
});
// Setup easy delete buttons
$('[data-toggle="deleteConfirmation"]').click(function () {
    event.preventDefault();
    $('form#' + $(this).data('formId')).submit();
});
// Auto open modal form when necessary
if ($('div#createLabelsModal[aria-hidden="false"]').length) {
    $('div#createLabelsModal[aria-hidden="false"]').modal('show');
}
// Ajax lables for a given product in a given location
$('a.productLocation[data-loaded!="1"]').click(function () {
    event.preventDefault();
    // Only try to load once
    $(this).off('click');
    let element = $(this);
    $.get($(this).data('ajaxUrl')).done(function (labels) {
        let labelGroup = $('<div>', {
            'class': 'list-group list-group-flush',
            'style': 'display: none;',
        });
        $.each(labels, function (index, label) {
           let labelItem = $('<a>', {
               'class': 'list-group-item list-group-item-action',
               'href': label.show_url,
               'html': label.id
           });
           labelGroup.append(labelItem);
        });
        $('div#productLocation' + element.data('productId') + '-' + element.data('locationId')).html(labelGroup);
        $('div#productLocation' + element.data('productId') + '-' + element.data('locationId')).removeClass('card-body');
        labelGroup.slideDown();
    }).fail(function () {
        $('div#productLocation' + element.data('productId') + '-' + element.data('locationId')).html('<span style="color: #dc3545;">Api Endpoint Failure</span>');
    });
});

