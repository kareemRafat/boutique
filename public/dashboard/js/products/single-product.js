

$(document).on('click' , '.pro-table .product-name' , function(){

    var id = $(this).data('id');

    $.ajax({
        method : 'get' ,
        url : 'products/'+id ,
        success(data){
            handleResponse(data);
        },
        beforeSend(){
            $('#single-product-modal .overlay').css(`display` , 'flex');
        }
    }) // end ajax

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
                            data-target="#delete-image-modal"
                            class="btn btn-danger del-img-btn"
                            data-id="${item.id}"
                        >Delete</button>
                    </div>
                    </td>
                </tr>
            `)
        })
        $('#single-product-modal .overlay').css(`display` , 'none');
    }

})
