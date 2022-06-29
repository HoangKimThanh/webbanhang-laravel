<!DOCTYPE html>
<html>

<head>
    <title>PhuKienHKT.com</title>
</head>

<body>
    <p>
        Mã đơn hàng của quý khách là {{ $details['invoiceId'] }}. Dùng mã này để tra cứu đơn hàng tại <a
            href="{{ route('invoices.show') }}">PhuKienHKT</a>
    </p>

    <p>Trân trọng</p>
</body>

</html>
