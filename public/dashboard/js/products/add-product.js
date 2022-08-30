
$('.add-product-form').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);

    // made because the js file dosn`t read "{{ route('admin.products.store') }}"
    let dateRoute = $('.add-new-btn').data('route');

    for([one , two] of formData.entries()){
        console.log(one , two);
    }

    $.ajax({
        method : 'post' ,
        url : dateRoute,
        dataType : 'json',
        data : formData,
        processData : false ,
        contentType : false ,
        beforeSend(){
            $('#add-product-modal .mySpinner').html(`
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`)
            $('#add-product-modal .modal-body').css('opacity', 0.5);
        },
        success(data){

            reset();

            //close modal
            $('#add-product-modal').modal('hide');

            //to reset data in datatables
            //ajax.reload(callback = null , resetPaging = true)
            $('table').DataTable().ajax.reload(null , false);

            // empty inputs
            $('input , textarea').val('');

            flasher.success("Product added successfully");
        },
        error(error,exception){
            reset();

            let keys = Object.keys(error.responseJSON.errors);
            let values = Object.values(error.responseJSON.errors);

            // to print the errors in the small element for each element
            keys.forEach((item , index)=> {
                let errors = values[index].join(',');
                $(`#add-product-modal .input-${item}`).text(errors);
            })

        }
    })

    function reset(){
        $('#add-product-modal small').text('');
        $('#add-product-modal .mySpinner').html('');
        $('#add-product-modal .modal-body').css('opacity', 1);
    }

})
