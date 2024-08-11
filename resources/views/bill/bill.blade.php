<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            background-color: #fff;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #333;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .invoice-box .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .invoice-box .logo img {
            max-height: 50px;
        }

        .invoice-box .title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }

        .invoice-box .invoice-details {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-box .invoice-details div {
            margin-bottom: 5px;
        }

        .invoice-box .client-details {
            margin-bottom: 20px;
        }

        .invoice-box .client-details div {
            margin-bottom: 5px;
        }

        .invoice-box .items {
            border-collapse: collapse;
            width: 100%;
        }

        .invoice-box .items th {
            background-color: #f2f2f2;
            padding: 10px;
            font-weight: bold;
            text-align: center;
            border: 1px solid #ddd;
        }

        .invoice-box .items td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .invoice-box .total {
            margin-top: 10px;
            margin-left: auto;
            text-align: right;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .invoice-box .total strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="logo">
            <img src="https://via.placeholder.com/150" alt="Logo">
        </div>
        <div class="title">Factura</div>
        <div class="invoice-details">
            <div>Fecha: {{ $created->format('d/m/Y') }}</div>
            <div>Factura #: 00123</div>
            <div>Forma de Pago: {{ $budget['payment_type']['name'] }}</div>
        </div>
        <div class="client-details">
            <div><strong>Cliente:</strong> {{ $budget['event']['customer']['name'] }}</div>
            <div><strong>Dirección del evento:</strong> {{ $budget['event']['address'] }} </div>
            <div><strong>Teléfono:</strong> {{$budget['event']['customer']['cellphone']}} </div>
            <div><strong>Email:</strong> {{$budget['event']['customer']['email']}} </div>
        </div>
        <table class="items">
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <!-- <th>Precio Unitario</th> -->
                <th>Subtotal</th>
            </tr>
            <tr class="item">
                <td>Productos</td>
                <td>{{ number_format($budget['nro_products'], 0, ',', '.') }}</td>
                <!-- <td>$50.00</td> -->
                <td>{{ number_format($budget['total_products'], 2, ',', '.') }}</td>
            </tr>
            <tr class="item">
                <td>Flete</td>
                <td>{{ number_format($budget['nro_vehicles'], 0, ',', '.') }}</td>
                <!-- <td>$100.00</td> -->
                <td>{{ number_format($budget['total_vehicles'], 2, ',', '.') }}</td>
            </tr>
            <tr class="item">
                <td colspan="2" class="text-right">Descuento ({{ number_format($budget['discount_percentage'], 0, ',', '.') }}%):</td>
                <td>{{ number_format($budget['discount_amount'], 2, ',', '.') }}</td>
            </tr>
            <tr class="item">
                <td colspan="2" class="text-right">IVA ({{ number_format($budget['iva_percentage'], 0, ',', '.') }}%):</td>
                <td>{{ number_format($budget['iva_amount'], 2, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td colspan="2" class="text-right"><strong>Total:</strong></td>
                <td>{{ number_format($budget['total_amount'], 2, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</body>

</html>