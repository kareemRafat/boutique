<!-- Modal -->
<div class="modal fade" id="add-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" class="add-product-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body product-add">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">name</label>
                        <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger font-weight-bold">xx</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">price</label>
                        <input name="price" type="text" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger font-weight-bold">xx</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">stock</label>
                        <input name="stock" type="text" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger font-weight-bold">xx</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <small class="text-danger font-weight-bold">xx</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category</label>
                        <select name="category" class="form-control" id="exampleFormControlSelect1">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
