<div class="btn-group btn-group-sm">
    <button
         data-route="{{ route('admin.products.edit', $id) }}"
        type="button"
        data-toggle="modal"
        data-target="#update-product-modal"
        class="btn btn-primary update-product-btn"
        data-id={{ $id }}
    >Edit</button>
    <button
        type="button"
        data-toggle="modal"
        data-target="#delete-product-modal"
        class="btn btn-danger del-btn"
        data-id={{ $id }}
        data-name={{ $name }}
    >Delete</button>
</div>
