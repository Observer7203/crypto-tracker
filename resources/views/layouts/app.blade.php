<!-- Пример: layout Blade-шаблона в стиле Metronic (Tailwind, demo2) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=League+Spartan:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Sanchez:ital@0;1&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">

    <!-- Навигационное меню -->
    <nav class="border-b bg-white fixed top-0 w-full z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/crypto-logo.png') }}" class="h-9 w-auto" alt="Logo">
                <span class="font-medium text-gray-900">Crypto Tracker</span>
            </div>
            <div class="space-x-6">
                <a href="/pairs" class="menu-item hover:text-gray-600 font-medium text-sm text-gray-800">Крипто-пары</a>
                <a href="/rates" class="menu-item hover:text-gray-600 font-medium text-sm text-gray-800">История курсов</a>
                <a href="/pairs/create" class="menu-item hover:text-gray-600 font-medium text-sm text-gray-800">Добавить пару</a>
            </div>
        </div>
    </nav>

    <!-- Контент с отступом от navbar -->
    <div class="pt-20 container mx-auto px-4">
        @yield('content')
    </div>

<style>
html {
    font-family: Inter, system-ui, sans-serif;
}

.menu-item {
    font-weight: 350;
    font-size: 13px;
    font-family: Inter, system-ui, sans-serif !important;
}
</style>

</body>
</html>
