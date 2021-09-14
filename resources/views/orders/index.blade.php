<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <title>Orders</title>
</head>
<body>
<div class="mt-16">
    <div class="container mx-auto">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-gray-900 bg-gray-100">
                        <th class="border p-4">ID заказа</th>
                        <th class="border p-4">Название партнёра</th>
                        <th class="border p-4">Состав заказа</th>
                        <th class="border p-4">Стоимость заказа</th>
                        <th class="border p-4">Статус заказа</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="">
                            <td class="text-right border p-4">{{ $order['id'] }}</td>
                            <td class="border p-4">{{ $order['partner']['name'] }}</td>
                            <td class="border p-4">
                                <ul>
                                    @foreach ($order['products'] as $product)
                                        <li class="bg-gray-100 rounded-full p-2 my-1">{{ $product->name }}: {{ $product->quantity }} * {{ $product->price }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-right border p-4">{{ $order['total_cost'] }}</td>
                            <td class="border p-4">
                                {{ $order['human_status'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
