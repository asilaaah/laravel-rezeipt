@component('mail::layout', ['user'=>$user, 'product' => $product])
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        Rezeipt
        @endcomponent
    @endslot

{{-- Body --}}
One of the product in inventory is in low stock. Please restock!
<br>
Product ID : {{$product->id}}
<br>
Product Name : {{$product->name}}
<br>
Current Quantity : {{$product->quantity}}
<br>
Minimum Quantity: {{$product->minimum_quantity}}

@component('mail::button', ['url' => route('product.edit', $product->id)])
Restock
@endcomponent

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
    © {{ date('Y') }} Rezeipt. All rights reserved.
@endcomponent
@endslot
@endcomponent
