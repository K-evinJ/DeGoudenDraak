<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <title>Menukaart</title>
</head>
<body class="bg-[#fefebe] p-2">
    <div class="flex">
        <img src="{{ asset('images/menu-pdf-corner.png') }}" class="h-6 pixel">
        <hr class="w-full border-[2.4px] border-[#27660b]">
        <img src="{{ asset('images/menu-pdf-corner.png') }}" class="h-6 scale-x-[-1] pixel">
    </div>
    <div class="flex justify-between w-full">
        <div class="border-[2.4px] border-[#27660b]"></div>
        <main class="p-1">
            content
        </main>
        <div class="border-[2.4px] border-[#27660b]"></div>
    </div>
    <div class="flex items-end">
        <img src="{{ asset('images/menu-pdf-corner.png') }}" class="h-6 scale-y-[-1] pixel">
        <hr class="w-full border-[2.4px] border-[#27660b]">
        <img src="{{ asset('images/menu-pdf-corner.png') }}" class="h-6 scale-y-[-1] scale-x-[-1] pixel">
    </div>
</body>
</html>