$(function () {


    question();

    function question (){
        $('.question').click(function(){

            $('.modal-question').modal('show')

        })
    }

    // update status
    updateStatus();
    // delete single
    remove();
    // delete more
    removeAll();


    $("#check-all").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('th a').addClass('nb-title-sort');

    // format number price
    $('.price').on('keyup', function () {
        let priceFormat = addCommas($('.price').val())
        $('.price-format').attr('value', priceFormat)
    })

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2 + ' VNĐ';
    }

    // console.log(`${assetUrl}file/dialog.php?type=1&field_id=${akey}`)

    // click avatar_image open filemanager
    $('.browser2').click(function(){
        var input_id2 = $('.browser2').attr('data-name-type');
        $('#filemanager').attr('src', `${assetUrl}file/dialog.php?type=1&field_id=${input_id2}&akey=${akey}`);
    })

    // click images open filemanager
    $('.browser_images').click(function(){
        var input_images = $('.browser_images').attr('data-name-type');
        $('#filemanager').attr('src', `${assetUrl}file/dialog.php?type=1&field_id=${input_images}&akey=${akey}`);
    })

    // show image
    $('#modal-file').on('hidden.bs.modal', function (e) {
        // show avatar_image
        var url_avatar_img = $('#avatar_image').val();
        if(url_avatar_img){
            $('.avatar-img').attr('src', url_avatar_img);
        }

        // show product images
        var url_images = $('#images').val()
        if(url_images){
            var imgs = jQuery.parseJSON(url_images)
            var html = ''
            imgs.forEach(element => {
                console.log(element)
                html += '<img src="'+element+'" alt="" class="img-fluid mr-1" width="150px" height="150px">'
            });

            $('.product-imgs').html(html)
        }
    });


    function updateStatus() {
        // Lấy số dòng AricleCategory
        var rowCount = $('tbody tr').length;
        var url = $('tbody tr ').attr('data-url');

        // Duyệt từng dòng và thay đổi status
        for (let index = 0; index < rowCount; index++) {
            // public status
            if ($('body .nb-check-publish-' + index).length) {
                $('body .nb-check-publish-' + index).on('click', function () {
                    var valueChange = $('body .nb-check-publish-' + index).attr('data-change');
                    var id = $('body .nb-check-publish-' + index).attr('id');
                    var name = $('body .nb-check-publish-' + index).attr('data-name');
                    // console.log(valueChange, id, name);
                    axios.post(url, {
                            id: id,
                            value: valueChange,
                            name: name
                        })
                        .then(function (response) {
                            console.log(response);
                            if (valueChange == 1) {
                                $('body .nb-check-publish-' + index).attr('data-change', 0);
                                $('body .nb-check-publish-' + index + ' i').attr('class', 'fa fa-check fa-lg text-success');
                                toastr.success('Kích hoạt trạng thái thành công.');
                            } else {
                                $('body .nb-check-publish-' + index).attr('data-change', 1);
                                $('body .nb-check-publish-' + index + ' i').attr('class', 'fa fa-remove fa-lg text-secondary');
                                toastr.error('Hủy bỏ trạng thái thành công.');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                })
            }

            // highlight status
            if ($('body .nb-check-highlight-' + index).length) {
                $('body .nb-check-highlight-' + index).on('click', function () {
                    var valueChange = $('body .nb-check-highlight-' + index).attr('data-change');
                    var id = $('body .nb-check-highlight-' + index).attr('id');
                    var name = $('body .nb-check-highlight-' + index).attr('data-name');
                    axios.post(url, {
                            id: id,
                            value: valueChange,
                            name: name
                        })
                        .then(function (response) {
                            console.log(response);
                            if (response.data.highlight == 1) {
                                $('.nb-mark-' + index).append('<span class="nb-page-type background-orange nb-mark-highlight-' + index + '">Tiêu biểu</span>')
                                $('.nb-mark-nhighlight-' + index).remove()
                                // $('.nb-mark-'+index).addClass('d-block')
                                // $('.nb-mark-nhighlight-'+index).addClass('d-none')
                            } else {
                                $('.nb-mark-' + index).append('<span class="nb-page-type bg-secondary nb-mark-nhighlight-' + index + '">Mặc định</span>')
                                $('.nb-mark-highlight-' + index).remove()
                                // $('.nb-mark-'+index).addClass('d-none')
                                // $('.nb-mark-nhighlight-'+index).addClass('d-block')

                            }



                            if (valueChange == 1) {
                                $('body .nb-check-highlight-' + index).attr('data-change', 0);
                                $('body .nb-check-highlight-' + index + ' i').attr('class', 'fa fa-check fa-lg text-success');
                                toastr.success('Kích hoạt trạng thái thành công.');
                            } else {
                                $('body .nb-check-highlight-' + index).attr('data-change', 1);
                                $('body .nb-check-highlight-' + index + ' i').attr('class', 'fa fa-remove fa-lg text-secondary');
                                toastr.error('Hủy bỏ trạng thái thành công.');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                    // alert(url);
                })
            }

            // link status
            if ($('body .nb-check-link-' + index).length) {
                $('body .nb-check-link-' + index).on('click', function () {
                    var valueChange = $('body .nb-check-link-' + index).attr('data-change');
                    var id = $('body .nb-check-link-' + index).attr('id');
                    var name = $('body .nb-check-link-' + index).attr('data-name');

                    axios.post(url, {
                            id: id,
                            value: valueChange,
                            name: name
                        })
                        .then(function (response) {
                            console.log(response);
                            if (valueChange == 1) {
                                $('body .nb-check-link-' + index).attr('data-change', 0);
                                $('body .nb-check-link-' + index + ' i').attr('class', 'fa fa-check fa-lg text-success');
                                toastr.success('Kích hoạt trạng thái thành công.');
                            } else {
                                $('body .nb-check-link-' + index).attr('data-change', 1);
                                $('body .nb-check-link-' + index + ' i').attr('class', 'fa fa-remove fa-lg text-secondary');
                                toastr.error('Hủy bỏ trạng thái thành công.');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                })
            }

            // onpage
            if ($('body .nb-check-onepage-' + index).length) {
                $('body .nb-check-onepage-' + index).on('click', function () {
                    var valueChange = $('body .nb-check-onepage-' + index).attr('data-change');
                    var id = $('body .nb-check-onepage-' + index).attr('id');
                    var name = $('body .nb-check-onepage-' + index).attr('data-name');

                    axios.post(url, {
                            id: id,
                            value: valueChange,
                            name: name
                        })
                        .then(function (response) {
                            console.log(response);
                            if (valueChange == 1) {
                                $('body .nb-check-onepage-' + index).attr('data-change', 0);
                                $('body .nb-check-onepage-' + index + ' i').attr('class', 'fa fa-check fa-lg text-success');
                                toastr.success('Kích hoạt trạng thái thành công.');
                            } else {
                                $('body .nb-check-onepage-' + index).attr('data-change', 1);
                                $('body .nb-check-onepage-' + index + ' i').attr('class', 'fa fa-remove fa-lg text-secondary');
                                toastr.error('Hủy bỏ trạng thái thành công.');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                    // alert(url);
                })
            }

            // unlink status
            if ($('body .nb-check-unlink-' + index).length) {
                $('body .nb-check-unlink-' + index).on('click', function () {
                    var valueChange = $('body .nb-check-unlink-' + index).attr('data-change');
                    var id = $('body .nb-check-unlink-' + index).attr('id');
                    var name = $('body .nb-check-unlink-' + index).attr('data-name');

                    axios.post(url, {
                            id: id,
                            value: valueChange,
                            name: name
                        })
                        .then(function (response) {
                            console.log(response);
                            if (valueChange == 1) {
                                $('body .nb-check-unlink-' + index).attr('data-change', 0);
                                $('body .nb-check-unlink-' + index + ' i').attr('class', 'fa fa-check fa-lg text-success');
                                toastr.success('Kích hoạt trạng thái thành công.');
                            } else {
                                $('body .nb-check-unlink-' + index).attr('data-change', 1);
                                $('body .nb-check-unlink-' + index + ' i').attr('class', 'fa fa-remove fa-lg text-secondary');
                                toastr.error('Hủy bỏ trạng thái thành công.');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                })
            }

            // sort_order
            if ($('body .sort-order-' + index).length) {
                $('body .sort-order-' + index).on('keyup', function () {
                    var value = $('body .sort-order-' + index).val();
                    var id = $('body .sort-order-' + index).attr('id');
                    var name = $('body .sort-order-' + index).attr('name');
                    axios.post(url, {
                            id: id,
                            value: value,
                            name: name
                        })
                        .then(function (response) {
                            console.log(response);
                            // $('body .sort-order-' + index).val() = value;
                            toastr.success('Cập nhật vị trí thành công.');
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                });
            }

            // lastest
            if ($('body .nb-check-lastest-' + index).length) {
                $('body .nb-check-lastest-' + index).on('click', function () {
                    var valueChange = $('body .nb-check-lastest-' + index).attr('data-change');
                    var id = $('body .nb-check-lastest-' + index).attr('id');
                    var name = $('body .nb-check-lastest-' + index).attr('data-name');

                    axios.post(url, {
                            id: id,
                            value: valueChange,
                            name: name
                        })
                        .then(function (response) {
                            console.log(response);

                            if (response.data.lastest == 1) {
                                $('.nb-mark-' + index).append('<span class="nb-page-type bg-success nb-mark-lastest-' + index + '">Mới nhất</span>')
                            } else {

                                $('.nb-mark-lastest-' + index).remove()
                            }

                            if (valueChange == 1) {
                                $('body .nb-check-lastest-' + index).attr('data-change', 0);
                                $('body .nb-check-lastest-' + index + ' i').attr('class', 'fa fa-check fa-lg text-success');
                                toastr.success('Kích hoạt trạng thái thành công.');
                            } else {
                                $('body .nb-check-lastest-' + index).attr('data-change', 1);
                                $('body .nb-check-lastest-' + index + ' i').attr('class', 'fa fa-remove fa-lg text-secondary');
                                toastr.error('Hủy bỏ trạng thái thành công.');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                })
            }

        }

    }

    function remove() {

        var rowCount = $('tbody tr').length;
        var urlDelete = $('.nb-delete').attr('data-url');
        for (let index = 0; index < rowCount; index++) {
            if ($('tbody .nb-row-' + index).length) {
                $('tbody .nb-row-' + index).on('click', function () {
                    var id = $('tbody .nb-row-' + index).attr('data-id');
                    $('#modal-delete').modal();
                    $('.nb-yes').attr('data-id', id);
                })
            }
        }

        $('.nb-yes').click(function () {
            var id = $('.nb-yes').attr('data-id');
            // console.log(typeof(id))
            if (id) {
                $('tbody .nb-tr-' + id).fadeOut("slow");
                axios.post(urlDelete, {
                        id: id
                    })
                    .then(function (response) {
                        console.log(response);
                        toastr.success('Thao tác xóa thành công.');
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }

        })
    }

    function removeAll() {
        var urlDeleteAll = $('.nb-delete-all').attr('data-url');


        $("input:checkbox").change(function () {
            var someObj = {};
            someObj.fruitsGranted = [];
            someObj.fruitsDenied = [];

            $("input:checkbox").each(function () {
                if ($(this).is(":checked")) {
                    someObj.fruitsGranted.push($(this).attr("data-id"));
                } else {
                    someObj.fruitsDenied.push($(this).attr("data-id"));
                }
            });

            $('.nb-delete-all').attr('data-ids', someObj.fruitsGranted)

        });

        $('.nb-delete-all').click(function () {
            var ids = $('.nb-delete-all').attr('data-ids');

            $('#modal-delete-all').modal();
            $('.nb-yes-all').attr('data-ids', ids);

        })



        $('.nb-yes-all').click(function () {
            var ids = $('.nb-yes-all').attr('data-ids');
            console.log(urlDeleteAll)
            if (ids) {

                var arr_ids = ids.split(',')
                console.log(arr_ids)
                arr_ids.forEach(id => {
                    $('tbody .nb-tr-' + id).fadeOut("slow");
                });
                axios.post(urlDeleteAll, {
                        ids: ids
                    })
                    .then(function (response) {
                        console.log(response)
                        toastr.success('Thao tác xóa nhiều thành công.');
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }
        })


    }
});
