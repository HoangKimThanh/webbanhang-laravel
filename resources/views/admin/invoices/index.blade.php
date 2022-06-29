@extends('admin.layouts.main')

@section('title')
    Hóa đơn
@endsection

@section('content')
    <div id="ct-modal" class="ct-modal">
        <div class="ct-modal-content">
            <div class="ct-container">
                <div>
                    <span class="button">&times;</span>
                </div>
                <div class="invoice-detail">

                </div>
            </div>
        </div>
    </div>

    <h1 style="text-align: center;">Danh sách hóa đơn</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã hóa đơn</th>
                <th>Thông tin người nhận</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Tình trạng</th>
                <th>Tùy biến</th>
            </tr>
        </thead>
        <tbody style="font-size: 14px">
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice->id }}</td>
                    <td style="text-align:left">
                        <b>Tài khoản:</b>
                        @if ($invoice->user_id)
                            <a href="#">{{ $invoice->user_id }}</a>
                        @else
                            Khách lẻ
                        @endif
                        <br>
                        <b>Họ tên:</b> {{ $invoice->receiver_name }}
                        <br>
                        <b>Email:</b> {{ $invoice->receiver_email }}
                        <br>
                        <b>Số điện thoại:</b> {{ $invoice->receiver_phone }}
                    </td>
                    <td>
                        <input type="hidden" value="{{ $invoice->receiver_province }}"
                            id="province_id-{{ $invoice->id }}">
                        <input type="hidden" value="{{ $invoice->receiver_district }}"
                            id="district_id-{{ $invoice->id }}">
                        <input type="hidden" value="{{ $invoice->receiver_ward }}" id="ward_id-{{ $invoice->id }}">
                        <input type="hidden" value="{{ $invoice->receiver_address }}"
                            id="address-{{ $invoice->id }}">
                        <span data-id="{{ $invoice->id }}" class="full_address_{{ $invoice->id }}"></span>
                    </td>
                    <td>{{ $invoice['created_at'] }}</td>
                    <td>{{ $invoice['total'] }}</td>
                    <td>{{ $invoice['payment'] }}</td>
                    <td>
                        @php
                            $options = [['background-color: rgba(255,0,0,0.3)', 0, 'Chờ xử lý'], ['background-color: rgba(255,240,0,0.9)', 1, 'Chuẩn bị giao'], ['background-color: rgba(0,0,255,0.3)', 2, 'Đang giao'], ['background-color: rgba(0,255,0,0.3)', 3, 'Đã giao']];
                            switch ($invoice['status']) {
                                case '0':
                                    $style = 'background-color: rgba(255,0,0,0.3)';
                                    break;
                                case '1':
                                    $style = 'background-color: rgba(255,240,0,0.9)';
                                    break;
                                case '2':
                                    $style = 'background-color: rgba(0,0,255,0.3)';
                                    break;
                                case '3':
                                    $style = 'background-color: rgba(0,255,0,0.3)';
                                    break;
                            }
                        @endphp
                        <select data-id="{{ $invoice->id }}" name="status" class="selectStatus"
                            style="width: 100%; margin: 0; padding-left: 4px; {{ $options[$invoice['status']][0] }}">

                            @foreach ($options as $option)
                                <option @if ($invoice['status'] == $option[1]) selected @endif style="{{ $option[0] }}"
                                    value="{{ $option[1] }}">
                                    {{ $option[2] }}
                                </option>
                            @endforeach

                        </select>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-invoice-detail" data-id="{{ $invoice->id }}">Chi tiết</a>
                        <a class="btn btn-danger btn-delete" data-id="{{ $invoice->id }}">
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        var provinces = [];
        var districts = [];
        var wards = [];

        fetch('https://raw.githubusercontent.com/daohoangson/dvhcvn/master/data/dvhcvn.json')
            .then(function(response) {
                return response.json();
            })
            .then(function(datas) {
                var data1 = datas.data;

                data1.forEach(element => {
                    element.name = element.name.replace('Tỉnh ', '').replace('Thành phố ', '');
                })

                data1.sort(function(a, b) {
                    const nameA = a.name;
                    const nameB = b.name;
                    if (nameA < nameB) {
                        return -1;
                    }

                    if (nameA > nameB) {
                        return 1;
                    }
                })

                data1.forEach(element1 => {
                    provinces.push({
                        id: element1.level1_id,
                        name: element1.name,
                    });

                    data2 = element1.level2s;
                    data2.forEach(element2 => {
                        districts.push({
                            id: element2.level2_id,
                            name: element2.name,
                            provinceId: element1.level1_id,
                        })

                        data3 = element2.level3s;
                        data3.forEach(element3 => {
                            wards.push({
                                id: element3.level3_id,
                                name: element3.name,
                                provinceId: element1.level1_id,
                                districtId: element2.level2_id,
                            });
                        })
                    });
                });

                var arrFullAddress = document.querySelectorAll('[class^=full_address]');
                arrFullAddress.forEach(element => {
                    let id = element.getAttribute('data-id');
                    let provinceId = document.getElementById(`province_id-${id}`).value;
                    let districtId = document.getElementById(`district_id-${id}`).value;
                    let wardId = document.getElementById(`ward_id-${id}`).value;
                    let address = document.getElementById(`address-${id}`).value;

                    if ((provinceId && districtId && wardId) === false) {
                        return;
                    }

                    let province = provinces.find(province => {
                        return province.id == provinceId;
                    }).name;
                    let district = districts.find(district => {
                        return district.id == districtId;
                    }).name;
                    let ward = wards.find(ward => {
                        return ward.id == wardId;
                    }).name;

                    let fullAddress = '' + province + ' - ' + district + ' - ' + ward + ' - ' + address;
                    element.innerText = fullAddress;
                })
            });



        let selectStatuses = $('.selectStatus');
        selectStatuses.each(function(index, selectStatus) {
            $(selectStatus).change(function() {
                let status = $(this).val();
                let color = $(this).find("option[value=" + status + "]").css('background-color');
                $(selectStatus).css('background-color', color);
                let id = $(this).data('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('invoices.ajax') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        action: 'update'
                    },
                    dataType: 'json',
                    success: function(data) {}
                })
            })
        })

        let modal = $('#ct-modal');
        let invoiceDetail = $('.invoice-detail');

        let btnInvoiceDetails = $('.btn-invoice-detail');
        btnInvoiceDetails.each(function(index, btnInvoiceDetail) {
            $(btnInvoiceDetail).click(function() {
                let id = $(this).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('invoices.ajax') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        action: 'show',
                    },
                    dataType: 'json',
                    success: function(data) {
                        modal.css('display', 'flex');
                        invoiceDetail.html(data.str);
                    }
                })
            })
        })

        modal.find('.button').click(function() {
            modal.css('display', 'none');
        })

        $(window).click(function(e) {
            if ($(e.target).is('#ct-modal')) {
                modal.css('display', 'none');
            }
        });

        let btnDeletes = $('.btn-danger');

        btnDeletes.each(function(index, btnDelete) {
            $(btnDelete).click(function() {
                $isReally = confirm('Really delete this?');
                if ($isReally) {
                    let id = $(this).data('id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('invoices.ajax') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            action: 'delete'
                        },
                        dataType: 'json',
                        success: function(data) {
                            $(btnDelete).parent().parent().remove();
                        }
                    })
                }
            })
        })
    </script>
@endsection
