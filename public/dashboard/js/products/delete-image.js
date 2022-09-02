
var imageId = 0 ;
var proId = localStorage.getItem('id');
console.log(proId);

// to get image id when click on the delete image btn in the modal in #single-product-modal
$(document).on('click' , '#single-product-modal .del-img-btn' , function(){
    imageId = $(this).data('id');
})


// confirm image delete
$(document).on('click' , '#delete-image-modal .delete-image-btn' , function(){
    console.log(`products/${proId}/image/${imageId}`);
    $.ajax({
        method : 'post' ,
        url : `products/${proId}/image/${imageId}`,
        success(data){

            $('#delete-image-modal').modal('hide');

            flasher.info("image Deleted successfully");

            //delete the removed image row when confirm delete
            $('#single-product-modal .row'+imageId).remove();

            if($('#single-product-modal tbody tr').length == 0 ){
                $('#single-product-modal .image-table tbody').html(`
                    <tr class="notFound">
                        <td class="text-center py-2" colspan="3"> No Images Found </td>
                    </tr>
                `)
            } else {

                resetTableId();

            }
        }
    })

    function resetTableId(){
        var id = 0 ;
        $('#single-product-modal tbody tr').each((index , item) => {
            var x = $(item).find('td:first').text(++id);
        })
    }


})
