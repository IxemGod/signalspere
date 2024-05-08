<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Cart</h1>
    <ul>
        @foreach($cart as $productId => $quantity)
            <li>Product ID: {{ $productId }}, Quantity: {{ $quantity }}</li>
        @endforeach
    </ul>
</body>
</html>
