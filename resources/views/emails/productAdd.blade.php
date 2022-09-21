@component('mail::message')
# Introduction

There is a new product added with name of <span>{{ $product->name }}</span>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
