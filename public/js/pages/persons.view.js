$(function() {

    $('button#set-as-found').on('click', function(e) {
        e.preventDefault();

        var data = {
            '_token': $('meta[name="csrf-token"]').attr('content')
        };

        $.post($(this).data('href'), data, function(response) {});
    });
});