<div>
    {{-- we get the subcategories depends on the subcategory relation in category model --}}
    @foreach ( $subCateoryList as $cat)
        <input type="hidden" wire:model="catId" value="{{ $cat-> id }}">
        <li class="mb-2 lista"><a class="reset-anchor" wire:click.prevent="changeCat({{ $cat->id }})" href="">{{ $cat->name }}</a></li>
    @endforeach
</div>
