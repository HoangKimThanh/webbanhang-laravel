@extends('layouts.main')

@section('title')
    Lịch sử mua hàng
@endsection

@section('content')
    <div class="main">
        <div class="grid wide">
            <div class="history" style="padding-top: 50px;">
                @if ($invoices)
                    <h2 style="text-align: center;">Danh sách hóa đơn đã mua</h2>
                    <ul>
                        <table style="width: 100%; text-align: center" border="1">
                            <thead>
                                <tr>
                                    <th style="padding: 12px 0;">Mã hóa đơn</th>
                                    <th style="padding: 12px 0;">Ngày mua</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td style="padding: 12px 0;">
                                            <a style="text-decoration:underline; color:blue;"
                                                href="{{ route('invoices.show') . '?invoice_id=' .$invoice->id }}">{{ $invoice->id }}</a>
                                        </td>
                                        <td style="padding: 12px 0;">
                                            {{ $invoice->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </ul>
                @else
                    <h2 style="padding-top: 50px;">Bạn chưa có hóa đơn nào :(</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
