
var id = 0 ;


$(document).on('click' , '.del-btn' , function(){
    id = $(this).data('id');
    product_name = $(this).data('name');
    $('#delete-product-modal .modal-body').html(`
        are you sure you want to delete product
                <span class="ml-1 text-danger font-weight-bold">
                    ${product_name}
                </span>
    `)
})


$(document).on('click','.delete-product-btn',function(){

    $.ajax({
        method : 'delete' ,
        url : `products/`+ id ,
        // data : {_method : 'delete'},
        beforeSend(){
            $('#delete-product-modal .mySpinner').html(`
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`)
        },
        success(data){

            //close modal
            $('#delete-product-modal').modal('hide');

            //to reset data in datatables
            //ajax.reload(callback = null , resetPaging = true)
            $('table.pro-table').DataTable().ajax.reload(null , false);

            flasher.info("Product Deleted successfully");

            $('#delete-product-modal .mySpinner').html('');
        }
    })

})
