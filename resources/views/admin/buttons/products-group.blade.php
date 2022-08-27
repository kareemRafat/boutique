<div class="btn-group btn-group-sm">
    <button
        type="button"
        data-route="{{ route('admin.products.edit', $id) }}"
        data-toggle="modal"
        data-target="#update-product-modal"
        class="btn btn-primary update-product-btn"
        data-id={{ $id }}
    >Edit</button>
    <button
        type="button"
        {{-- data-route="{{ route('admin.products.delete') }}" --}}
        data-toggle="modal"
        data-target="#"
        class="btn btn-danger"
        data-id={{ $id }}
    >Delete</button>
</div>
