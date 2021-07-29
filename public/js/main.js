$(function () {

    if ($(".no-books")[0]){
        $('#tbl_book_list').css({ 'border-left': '1px solid #cccccc' });
    }

    $('#tbl_book_list #bl_tbody tr').each(function(){
        $(this).on('mousedown', function(){
            $(this).addClass('selected');
        }).on('mouseup', function(){
            $(this).removeClass('selected');
        });
    });

    $('.btn-delete-book, .btn-details').each(function(){
        $(this).on('mousedown', function(){
            $(this).parents('#tbl_book_list #bl_tbody tr').css({
                'background-color': '#ffffff'
            });
        });
    });

    $('#bl_tbody').sortable({
        items: 'tr',
        cursor: 'pointer',
        placeholder: 'placeholder-background',
        update: function() {
            reorderList();
        }
    });

    function reorderList() {
        let order = [];
        let token = $('meta[name="csrf-token"]').attr('content');

        $('#bl_tbody tr').each(function(idx) {
            order.push({
                book_id: $(this).attr('data-book-id'),
                position: idx + 1
            });
        });

        $.ajax({
            type: 'post', 
            dataType: 'json', 
            url: 'books-reorder',
                data: {
                order: order,
                _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                    console.log(response);
                } else {
                    console.log(response);
                }
            }
        });
    }
});
