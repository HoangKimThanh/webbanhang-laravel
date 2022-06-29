<!DOCTYPE html>
<html>

<head>
    <title>PhuKienHKT.com</title>
</head>

<body>
    <p>
        Mã đơn hàng của quý khách là {{ $details['invoiceId'] }}. Dùng mã này để tra cứu đơn hàng tại <a
            href="{{ route('invoices.show') . '?invoice_id=' . $details['invoiceId'] }}">PhuKienHKT</a>
    </p>

    <p>Trân trọng</p>
</body>

</html>
