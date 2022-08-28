
var id = 0 ;


$(document).on('click' , '.del-btn' , function(){
    id = $(this).data('id');
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
            $('table').DataTable().ajax.reload(null , false);

            flasher.success("Product Deleted successfully");

            $('#delete-product-modal .mySpinner').html('');
        }
    })

})
