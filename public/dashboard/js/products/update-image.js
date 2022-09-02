

// when choose file submit the form
$(document).on('change' , '#single-product-modal .image' , function(){
    $('#single-product-modal .update-img-form').submit();
})


$(document).on('submit' , '#single-product-modal .update-img-form' , function(e){

    e.preventDefault();

    var product_id = localStorage.getItem('id');
    var product_name = localStorage.getItem('name');

    $.ajax({
        method : 'post',
        url : `products/${product_id}/image`,
        data : new FormData(this),
        processData : false ,
        contentType : false ,
        success(data){
            appendTableRow(data);
        }
    })

    function appendTableRow(data){
        $('#single-product-modal .image-table tbody .notFound').remove();
        $('#single-product-modal .image-table tbody').append(`
            <tr class='row${data.img.id}'>
                <td scope="row">${getLastId()}</td>
                <td>
                    <img style="width:100px" src="${imageUrl}/${product_name}/${data.img.name}" />
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

    function getLastId(){
        return +$('#single-product-modal .image-table tbody tr:last td:first').text() + 1;
    }

})
