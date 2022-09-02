

// when choose file submit the form
$(document).on('change' , '#single-product-modal .image' , function(){
    $('#single-product-modal .update-img-form').submit();
})


$(document).on('submit' , '#single-product-modal .update-img-form' , function(e){

    e.preventDefault();

    var product_id = $(this).data('proid');

    $.ajax({
        method : 'post',
        url : `products/${product_id}/image`,
        data : new FormData(this),
        processData : false ,
        contentType : false ,
        success(data){
            console.log(data);
            $('#single-product-modal .image-table tbody').append(`
                <tr class='row${data.img.id}'>
                    <td scope="row">${++id}</td>
                    <td>
                        <img style="width:100px" src="${data.img.path}" />
                    </td>
                    <td><div class="btn-group btn-group-sm">
                        <button
                            type="button"
                            data-toggle="modal"
                            data-target="#delete-image-modal"
                            class="btn btn-danger del-img-btn"
                            data-id="${data.img.id}"
                        >Delete</button>
                    </div>
                    </td>
                </tr>
            `)
        }
    })

})
