
$('.add-product-form').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);

    // made because the js file dosn`t read "{{ route('admin.products.store') }}"
    let dateRoute = $('.add-new-btn').data('route');


    $.ajax({
        method : 'post' ,
        url : dateRoute,
        dataType : 'json',
        data : formData,
        processData : false ,
        contentType : false ,
        beforeSend(){
            $('.mySpinner').html(`
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`)
            $('.modal-body').css('opacity', 0.5);
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
        },
        error(error,exception){

            reset();

            let keys = Object.keys(error.responseJSON.errors);
            let values = Object.values(error.responseJSON.errors);

            // to print the errors in the small element for each element
            keys.forEach((item , index)=> {
                let errors = values[index].join(',');
                $(`.input-${item}`).text(errors);
            })

        }
    })

    function reset(){
        $('small').text('');
        $('.mySpinner').html('');
        $('.modal-body').css('opacity', 1);
    }

})
