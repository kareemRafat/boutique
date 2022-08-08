<div>
    {{-- we get the subcategories depends on the subcategory relation in category model --}}
    @foreach ( $subCateoryList as $category)
        <li class="mb-2 lista"><a class="reset-anchor" wire:click.prevent="changeCat({{ $category->id }})" href="">{{ $category->name }}</a></li>
    @endforeach

</div>
