<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation and Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        .table-container th {
            background-color: #f4f4f4;
        }

        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            {{-- <h2>Order Confirmation and Invoice</h2> --}}
            <h2>Thank you {{ $order->name }} for your order!</h2>
        </div>
        <table class="table-container">
            <tr>
                <th style="width:30%">Product</th>
                <th style="width:15%">Quantity</th>
                <th style="width:15%">Unit Price</th>
                <th style="width:20%">Total</th>
            </tr>
            @foreach ($orderItem as $item)
                <tr>
                    <td style="width:50%">{{ $item->product->name }}</td>
                    <td style="width:15%">{{ $item->quantity }}</td>
                    <td style="width:15%">{{ $item->price }}</td>
                    <td style="width:15%">{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
            <!-- Add more rows for additional products -->
        </table>
        <div class="total">
            <p><strong>Total Amount: {{ $order->total_amount }}</strong></p>
        </div>
        <p>If you have any questions or concerns, please contact our customer support.</p>
        <p>Thank you for choosing our ecommerce store!</p>
    </div>
</body>

</html>
