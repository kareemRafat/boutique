

$(document).on('click' , '.pro-table .product-name' , function(){

    var id = $(this).data('id');

    $.ajax({
        method : 'get' ,
        url : 'products/'+id ,
        success(data){
            handleResponse(data);
        },
    })

    function handleResponse(data){
        var id = 0 ;
        $('#single-product-modal .image-table tbody').html('');
        $('#single-product-modal .desc-tab').text(data.desc);
        data.images.forEach(item => {
            $('#single-product-modal .image-table tbody').append(`
                <tr>
                    <td scope="row">${++id}</td>
                    <td>${item.name}</td>
                    <td><div class="btn-group btn-group-sm">
                        <button
                            type="button"
                            data-toggle="modal"
                            data-target="#"
                            class="btn btn-danger del-btn"
                        >Delete</button>
                    </div>
                    </td>
                </tr>
            `)
        })
    }


})
