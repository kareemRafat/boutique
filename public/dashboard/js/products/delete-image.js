
var imageId = 0 ;
var proId = 0;

// to get the product id from clicking the product name in yajra datatable
$(document).on('click' , '.pro-table .product-name' , function(){
    proId = $(this).data('id');
})


// to get image id when click on the delete image btn in the modal in #single-product-modal
$(document).on('click' , '#single-product-modal .del-img-btn' , function(){
    imageId = $(this).data('id');

})


// confirm image delete
$(document).on('click' , '#delete-image-modal .delete-image-btn' , function(){
    $.ajax({
        method : 'post' ,
        url : `products/${proId}/image/${imageId}`,
        success(data){
            console.log(data);
        }
    })


})
