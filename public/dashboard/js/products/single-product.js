

$(document).on('click' , '.pro-table .product-name' , function(){

    var product_id = $(this).data('id');

    $.ajax({
        method : 'get' ,
        url : 'products/'+product_id ,
        success(data){
            
            handleResponse(data);

            //add data_proId attribute
            $('#single-product-modal .update-img-form').attr('data-proId' , product_id);
        },
        beforeSend(){
            $('#single-product-modal .overlay').css(`display` , 'flex');
        }
    }) // end ajax

    function handleResponse(data){
        var id = 0 ;

        $('#single-product-modal .image-table tbody').html('');
        $('#single-product-modal .desc-tab').text(data.desc);
        if(data.images.length == 0) {
            $('#single-product-modal .image-table tbody').html(`
                <tr>
                    <td class="text-center py-2" colspan="3"> No Images Found </td>
                </tr>
            `)
        }
        data.images.forEach(item => {
            $('#single-product-modal .image-table tbody').append(`
                <tr class='row${item.id}'>
                    <td scope="row">${++id}</td>
                    <td>
                        <img style="width:100px" src="${item.path}" />
                    </td>
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
