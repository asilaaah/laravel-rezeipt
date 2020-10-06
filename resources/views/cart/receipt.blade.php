
<html>
<head>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        .flex-item  {
            display: flex;
            justify-content: space-between;
        }

    </style>
</head>

<body>

<div style="text-align: center">
    <div><h3><strong>{{ $store->name }}</strong></h3></div>
    <div>{{ $store->address }}</div>
    <div>{{ $store->phone_num }}</div>
    <div><h4>SALES RECEIPT</h4></div>
    <div>
        <div>
            <div>TYPE : Cash</div>
            <div>#{{ $newreceipt->id }}</div>
            <div>CASHIER : {{ $newreceipt->name }}</div>
        </div>
        <div>
            <div>DATE : {{ $newreceipt->created_at->format('d/m/Y') }}</div>
            <div>TIME : {{ $newreceipt->created_at->format('H:i:s') }}</div>
        </div>
    </div><br>
    <div>
        <table style="width:75%" class="center">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price (RM)</th>
                <th>Subtotal (RM)</th>
            </tr>

                @foreach((array) $newreceipt->cart->items as $item)
                        <tr>
                            <td>{{ $item['item']['name'] }}</td>
                            <td>{{ $item['item']['description'] }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>{{ number_format( $item['item']['price'] , 2, '.', ',') }}</td>
                            <td>{{ number_format( $item['price'] , 2, '.', ',') }}</td>
                        </tr>

                @endforeach

            <tr>
                <td colspan="4" style="text-align: right;">Total Price (RM)</td>
                <td>{{ number_format( $newreceipt->cart->totalPrice , 2, '.', ',') }}</td>
            </tr>
        </table>
    </div>
</div>

</body>

</html>


