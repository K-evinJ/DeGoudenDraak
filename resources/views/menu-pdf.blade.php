<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <title>Menukaart</title>
</head>

<body class="bg-[url('/public/images/menu-pdf-background.png')] [background-size:100%_100%] bg-center h-[100vh] font-[chinese]">
    <main class="p-5 px-10 grid grid-cols-3 gap-x-5 w-full h-[91vh]">
        @foreach ($dishTypes as $dishType => $dishes)
        <h1 class="font-bold text-center">{{ $dishType }}</h1>
            @foreach ($dishes as $dish)
                <div class="flex justify-between">
                    <span>{{ $dish->number }}. {{ $dish->name }}</span>
                    <span class="flex grow border-b-2 border-dotted border-black h-6"></span>
                    <span>€ {{ $dish->price }}</span>
                </div>
            @endforeach
        @endforeach
    </main>
</body>
</html>