<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/forms@0.3.3/dist/forms.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer>
        let reactiveData = {
            client_email: "{{ $order['client_email'] }}",
            partner_name: "{{ $order['partner']['name'] }}",
            message: "Ошибок нет",
        };
        function submitForm() {
            let formData = new FormData();
            formData.append('client_email', reactiveData.client_email);
            formData.append('partner_name', reactiveData.partner_name);

            fetch('{{ route('orders.update', ['order' => $order['id']]) }}', {
                headers: {
                    Accept: 'application/json'
                },
                method: 'PUT',
                body: formData
            })
                .then((resp) => resp.json())
                .then(function(data) {
                    reactiveData.message = data.message;
                    console.log(data.message);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    </script>

    <title>Order</title>
</head>
<body>
    <div class="mt-16">
        <div class="container mx-auto">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <form class="p-8" x-data="reactiveData" x-on:submit.prevent="submitForm()">
                    <h1 class="text-3xl font-bold">Заказ #{{ $order['id'] }}</h1>
                    <div class="my-2">
                        <span x-text="reactiveData.message"></span>
                    </div>
                    <div class="my-2">
                        <label>Email клиента</label>
                        <input class="form-input w-full" type="text" name="client_email" x-model="reactiveData.client_email">
                    </div>
                    <div class="my-2">
                        <label>Партнёр</label>
                        <input class="form-input w-full rounded" type="text" name="partner_name" x-model="reactiveData.partner_name">
                    </div>
                    <div class="my-2">
                        <div class="p-4 border">
                            <h3 class="font-bold">Стоимость заказа: {{ $order['total_cost'] }}</h3>
                            <ul>
                                @foreach ($order['products'] as $product)
                                    <li class="bg-gray-100 rounded-full p-2 my-1">{{ $product->name }}: {{ $product->quantity }} * {{ $product->price }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="my-2">
                        <select class="w-full border bg-white rounded px-3 py-2 outline-none" name="status">
                            <option class="py-1" value="0">Новый</option>
                            <option class="py-1" value="10">Подтверждён</option>
                            <option class="py-1" value="20">Завершён</option>
                        </select>
                    </div>
                    <button class="px-4 py-2 text-white bg-indigo-600 hover:indigo-500 rounded">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
