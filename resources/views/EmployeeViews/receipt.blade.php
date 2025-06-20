<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Rekening</title>
    <style>
        {!! file_get_contents(public_path('css/receipt.css')) !!}
    </style>

</head>
<body>
    <div class="logo">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <p><strong>De gouden draak</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Aantal</th>
                <th>Prijs</th>
                <th>Totaal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($order->dishes as $dish)
                @php
                    $total = $dish->pivot->amount * $dish->pivot->original_dishprice;
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td>{{ $dish->name }}</td>
                    <td>{{ $dish->pivot->amount }}</td>
                    <td>€{{ number_format($dish->pivot->original_dishprice, 2, ',', '.') }}</td>
                    <td>€{{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Totaal: €{{ number_format($grandTotal, 2, ',', '.') }}</p>

    <div class="footer flex flex-col items-center">
        <p>Dank u voor uw bezoek!</p>
        <img src="data:image/png;base64, {{ $qr }}" alt="QR-Code naar review formulier">
        <p>Laat een review achter</p>
    </div>
</body>
</html>
