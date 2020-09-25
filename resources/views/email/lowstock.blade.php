@component('mail::message', ['user'=>$user, 'product' => $product])

{{$product->name}} is in low stock. Please restock!
    
@endcomponent