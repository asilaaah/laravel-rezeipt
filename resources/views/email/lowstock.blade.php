@component('mail::message', ['user'=>$user, 'product' => $product])

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
    
@endcomponent