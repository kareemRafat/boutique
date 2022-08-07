<div>
    {{-- we get the subcategories depends on the subcategory relation in category model --}}
    @foreach ( $subCateoryList as $cat)
        <li class="mb-2"><a class="reset-anchor" href="">{{ $cat->name }}</a></li>
    @endforeach
</div>
