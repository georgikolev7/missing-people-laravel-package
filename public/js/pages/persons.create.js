$(document).ready(function() {

    $('input.lcs_check').lc_switch('ДА', 'НЕ');

    $('form#create-person-form').validate({
        rules: {
            name: {
                required: !0,
                minlength: 10,
                maxlength: 100,
            },
            age: {
                required: !0,
                number: !0,
                range: [1, 100]
            },
            height: {
                required: !1,
                number: !0,
                range: [10, 220]
            }
        },
        submitHandler: function(form) {
            var formData = new FormData($('form#create-person-form')[0]);
            $.ajax({
                type: 'POST',
                url: $('form#create-person-form').attr('action'),
                success: function(data) {
                    if (data.id) {
                        $('input#item-id').val(data.id);
                        $('input#item-hash').val(data.hash);
                        var api = $.fileuploader.getInstance('.filename');
                        api.uploadStart()
                    }
                },
                async: !0,
                data: formData,
                cache: !1,
                contentType: !1,
                processData: !1,
                timeout: 60000
            })
        }
    });

    $(document).on('change', 'select#grid-region', function(e) {
        e.preventDefault();
        var formData = {
            name: $('input#name').val(),
            region_id: $('select#grid-region option:selected').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
        };
        var region = $('select#grid-region option:selected');
        var region_id = region.val();
        $('#exact-address-text').val(region.text());
        $('#exact-address-latitude').val(region.data('lat'));
        $('#exact-address-longitude').val(region.data('lng'));
        $('select#grid-settlement').empty().addClass('disabled').prop('disabled', !0);
        $.get('/settlements/fetch/' + region_id, formData, function(response) {
            if (response.settlements.length) {
                $('select#grid-settlement').removeClass('disabled').prop('disabled', !1);
                $.each(response.settlements, function(index, settlement) {
                    $('select#grid-settlement').append($('<option></option>').attr('data-lng', settlement.lng).attr('data-lat', settlement.lat).attr('value', settlement.id).text(settlement.name))
                })
            }
        })
    });

    $(document).on('change', 'select#grid-settlement', function(e) {
        e.preventDefault();
        var region = $('select#grid-region option:selected');
        var settlement = $('select#grid-settlement option:selected');
        $('#exact-address-text').val(settlement.text() + ', ' + region.text());
        $('#exact-address-latitude').val(settlement.data('lat'));
        $('#exact-address-longitude').val(settlement.data('lng'))
    });

    $('input.filename').fileuploader({
        enableApi: !0,
        theme: 'thumbnails',
        changeInput: ' ',
        thumbnails: {
            box: '<div class="fileuploader-items">' + '<ul class="fileuploader-items-list">' + '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">+</div></li>' + '</ul>' + '</div>',
            item: '<li class="fileuploader-item">' + '<div class="fileuploader-item-inner">' + '<div class="thumbnail-holder">${image}</div>' + '<div class="actions-holder">' + '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' + '<span class="fileuploader-action-popup"></span>' + '</div>' + '<div class="progress-holder">${progressBar}</div>' + '</div>' + '</li>',
            item2: '<li class="fileuploader-item">' + '<div class="fileuploader-item-inner">' + '<div class="thumbnail-holder">${image}</div>' + '<div class="actions-holder">' + '<a class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i></i></a>' + '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' + '<span class="fileuploader-action-popup"></span>' + '</div>' + '</div>' + '</li>',
            startImageRenderer: !0,
            canvasImage: !1,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove',
                sorter: '.fileuploader-action-sort'
            },
            onItemShow: function(item, listEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input');
                plusInput.insertAfter(item.html);
                if (item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide()
                }
            }
        },
        afterRender: function(listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                api = $.fileuploader.getInstance(inputEl.get(0));
            plusInput.on('click', function() {
                api.open()
            })
        },
        upload: {
            url: '/persons/photo/store',
            enctype: 'multipart/form-data',
            type: 'POST',
            onSuccess: function(data, item) {
                setTimeout(function() {
                    item.html.find('.progress-holder').hide();
                    item.renderThumbnail();
                    var item_hash = $('input#item-hash').val();
                    var new_url = '/persons/view/' + item_hash
                }, 400)
            },
            onError: function(item) {
                item.html.find('.progress-holder').hide();
                item.html.find('.fileuploader-item-icon i').text('Failed!')
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-holder');
                if (progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%")
                }
            }
        },
        dragDrop: {
            container: '.fileuploader-thumbnails-input'
        },
        sorter: {
            selectorExclude: null,
            placeholder: '<li class="fileuploader-item fileuploader-sorter-placeholder"><div class="fileuploader-item-inner"></div></li>',
            scrollContainer: window,
            onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl.get(0)),
                    fileList = api.getFileList(),
                    _list = [];
                $.each(fileList, function(i, item) {
                    _list.push({
                        name: item.name,
                        index: item.index
                    })
                });
                $.post('/persons/photo/list/sort_order', {
                    _list: JSON.stringify(_list)
                })
            }
        },
        onSort: function(list, listEl, parentEl, newInputEl, inputEl) {},
        onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
            $.ajax({
                data: {
                    'name': item.name,
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    return !0
                },
                type: 'POST',
                url: '/persons/photo/delete'
            });
            return !0
        }
    });

    var api = $.fileuploader.getInstance('#file');

    $('#upload-photos').on('click', function(e) {
        e.preventDefault();
        api.uploadStart();
    });
});