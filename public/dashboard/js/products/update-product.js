

// #########   edit    ##########

$(document).on('click' , '.update-product-btn' ,function(){

    // fetch product data
    let product_id = $(this).data('id');
    let editRoute = $(this).data('route');

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

$(document).on('submit', '.update-product-form' , function(e){

    e.preventDefault();

    let id = $('input[name="id"]').val();

    // send put request to update the product
    let formData = new FormData(this);

    $.ajax({
        method : 'post' ,
        url : `products` +'/'+ id ,
        dataType : 'json',
        data : formData,
        processData : false ,
        contentType : false ,
        success(data){
            console.log(data);
        }
    })

})
