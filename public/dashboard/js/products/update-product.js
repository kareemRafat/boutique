

// #########   edit    ##########

$(document).on('click' , '.update-product-btn' ,function(){

    // fetch product data
    let editRoute = $(this).data('route');

    reset();

    $.ajax({
        url : editRoute,
        method : 'get' ,
        dataType : 'json',
        beforeSend(){
            // some animation
            $('#update-product-modal input , #update-product-modal textarea').val('');
            $('.modal-body').css('opacity', 0.5);
            $('#update-product-modal input , #update-product-modal textarea').attr('disabled','true');
        },
        success(data){

            // revert animation
            $('.modal-body').css('opacity', 1);
            $('#update-product-modal input , #update-product-modal textarea').removeAttr('disabled');

            // print the data in it`s own input
            $('#update-product-modal input , #update-product-modal textarea').each((index ,item)=>{
                $(item).val(data[item.name]);
            })
            
            $('.old_name').val(data.name);


            // add selected attribute to the product category
            $('#update-product-modal select option').each((index , item)=> {
                if($(item).val() == data['cat_id']) {
                    $(item).attr('selected' , '');
                }
            })

        }
    })


})


// #########   update    ##########

$(document).on('submit', '.update-product-form' ,function(e){

    e.preventDefault();

    let id = $('input[name="id"]').val();

    // send put request to update the product
    var formData = new FormData(this);
    formData.append('_method','put');

    $.ajax({
        method : 'post' ,
        url : `products` +'/'+ id ,
        data : formData,
        processData : false ,
        contentType : false ,
        beforeSend(){
            $('#update-product-modal .mySpinner').html(`
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`)
            $('#update-product-modal .modal-body').css('opacity', 0.5);
        },
        success(data){

            reset();

            //close modal
            $('#update-product-modal').modal('hide');

            //to reset data in datatables
            //ajax.reload(callback = null , resetPaging = true)
            $('table.pro-table').DataTable().ajax.reload(null , false);

            // empty inputs
            $('input , textarea').val('');

            flasher.success("Product updated successfully");
        },
        error(error){

            reset();

            $('#update-product-modal .myError').html(`<div class="text-danger">error happens : check the error upov</div>`);


            let keys = Object.keys(error.responseJSON.errors);
            let values = Object.values(error.responseJSON.errors);

            // to print the errors in the small element for each element
            keys.forEach((item , index)=> {
                let errors = values[index].join(',');
                $(`#update-product-modal .input-${item}`).text(errors);
            })
        }
    })

})

function reset(){
    $('#update-product-modal .myError').html(``)
    $('#update-product-modal small').text('');
    $('#update-product-modal .mySpinner').html('');
    $('#update-product-modal .modal-body').css('opacity', 1);
}
