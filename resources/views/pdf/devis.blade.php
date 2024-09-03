<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .client-info {
        float: left;
        width: 50%;
    }

    .company-info {
        float: right;
        width: 50%;
        text-align: right;
    }

    .clear {
        clear: both;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .totals {
        margin-top: 20px;
        text-align: right;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Devis</h1>
    </div>

    <div class="client-info">
        <h3>Client</h3>
        <p>{{ $devis->client_name }}</p>
        <p>{{ $devis->client_address }}</p>
        <p>{{ $devis->client_city }}</p>
        <p>SIRET: {{ $devis->client_siret }}</p>
    </div>

    <div class="company-info">
        <h3>Professionnel</h3>
        <p>{{ $devis->pro_name }}</p>
        <p>{{ $devis->pro_address }}</p>
        <p>{{ $devis->pro_city }}</p>
        <p>SIRET: {{ $devis->pro_siret }}</p>
    </div>

    <div class="clear"></div>

    <p>Date du devis: {{ $devis->date_devis }}</p>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix unitaire HT</th>
                <th>Prix total HT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devis->tasks as $task)
            <tr>
                <td>{{ $task->item_description }}</td>
                <td>{{ $task->item_quantity }}</td>
                <td>{{ number_format($task->item_price, 2) }} €</td>
                <td>{{ number_format($task->item_price * $task->item_quantity, 2) }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p>Total HT: {{ number_format($devis->amount, 2) }} €</p>
        <p>TVA (20%): {{ number_format($devis->amount * 0.2, 2) }} €</p>
        <p><strong>Total TTC: {{ number_format($devis->amount * 1.2, 2) }} €</strong></p>
    </div>

    <div>
        <p>{{ $devis->description }}</p>
    </div>
</body>

</html>