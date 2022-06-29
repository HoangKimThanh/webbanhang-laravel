@extends('layouts.main')

@section('title')
    Tra cứu hóa đơn
@endsection

@section('content')
    <div class="main">
        <div class="row">
            <div class="col l-12 m-12 c-12">
                <div class="order-find">
                    <h1>Tra cứu đơn hàng</h1>
                    <form action="" method="get">
                        <table>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th><input type="text" name="invoice_id" value="{{ $invoiceId }}"></th>
                                <th><button type="submit">TRA CỨU</button></th>
                            </tr>
                        </table>
                    </form>
                    @if ($invoice)
                        @php
                            $status;
                            switch ($invoice['status']) {
                                case '0':
                                    $status = 'Chờ xử lý';
                                    break;
                            
                                case '1':
                                    $status = 'Chuẩn bị';
                                    break;
                            
                                case '2':
                                    $status = 'Đang giao';
                                    break;
                            
                                case '3':
                                    $status = 'Đã giao';
                                    break;
                            }
                        @endphp
                        <div id="result" style="margin-bottom: 16px; width: 100%">
                            <h1 class="success">THÔNG TIN ĐƠN HÀNG</h1>
                            <table>
                                <tr>
                                    <td>Họ và tên</td>
                                    <td>Email</td>
                                    <td>Số điện thoại</td>
                                    <td>Thời gian đặt</td>
                                    <td>Địa chỉ giao hàng</td>
                                    <td>Hình thức thanh toán</td>
                                    <td>Tình trạng</td>

                                </tr>
                                <tr>
                                    <th>{{ $invoice->receiver_name }}</th>
                                    <th>{{ $invoice->receiver_email }}</th>
                                    <th>{{ $invoice->receiver_phone }}</th>
                                    <td>{{ $invoice->created_at }}</td>
                                    <th><span class="full_address"></span></th>
                                    <th>{{ $invoice->payment }}</th>
                                    <th>{{ $status }}</th>
                                </tr>
                                <input type="hidden" name="" id="receiver_province"
                                    value="{{ $invoice->receiver_province }}">
                                <input type="hidden" name="" id="receiver_district"
                                    value="{{ $invoice->receiver_district }}">
                                <input type="hidden" name="" id="receiver_ward"
                                    value="{{ $invoice->receiver_ward }}">
                                <input type="hidden" name="" id="receiver_address"
                                    value="{{ $invoice->receiver_address }}">
                            </table>
                        </div>

                        <div id="result-mobile" style="margin-bottom: 16px; text-align: center; width: 100%;">
                            <table>
                                <tr>
                                    <td>Họ và tên</td>
                                    <td>{{ $invoice->receiver_name }}
                                    <td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $invoice->receiver_email }}
                                    <td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>{{ $invoice->receiver_phone }}
                                    <td>
                                </tr>
                                <tr>
                                    <td>Thời gian đặt</td>
                                    <td>{{ $invoice->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ giao hàng</td>
                                    <td><span class="full_address"></span></td>
                                </tr>
                                <tr>
                                    <td>Hình thức thanh toán</td>
                                    <td>{{ $invoice->payment }}></td>
                                </tr>
                                <tr>
                                    <td>Tình trạng</td>
                                    <td>{{ $status }}</td>
                                </tr>
                            </table>
                        </div>

                        <h2>CHI TIẾT HÓA ĐƠN</h2>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($invoiceDetails as $item)
                                    @php
                                        $total += $item->quantity * $item->price;
                                    @endphp
                                    <tr>
                                        <th><img width="100px" src="{{ asset('img/uploads/' . $item->image_main) }}"
                                                alt="">
                                        </th>
                                        <th>{{ $item->name }}</th>
                                        <th>{{ $item->quantity }}</th>
                                        <th>{{ $item->price }}</th>
                                        <th>{{ $item->price * $item->quantity }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tổng tiền</th>
                                    <th colspan="3"></th>
                                    <th>{{ $total }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        @if ($invoiceId != null)
                            <h1 class="error">ĐƠN HÀNG KHÔNG TỒN TẠI!!</h1>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
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

                var provinceId = document.getElementById('receiver_province').value;
                var districtId = document.getElementById('receiver_district').value;
                var wardId = document.getElementById('receiver_ward').value;
                var address = document.getElementById('receiver_address').value;

                console.log(provinceId, districtId);

                if (provinceId && districtId && wardId && address) {
                    var province = provinces.find(province => {
                        return province.id == provinceId;
                    }).name;
                    var district = districts.find(district => {
                        return district.id == districtId;
                    }).name;
                    var ward = wards.find(ward => {
                        return ward.id == wardId;
                    }).name;

                    var fullAddress = '' + province + ' - ' + district + ' - ' + ward + ' - ' + address;
                    document.querySelectorAll('.full_address').forEach(function(addressElement) {
                        addressElement.innerText = fullAddress;
                    })
                }
            })
    </script>
@endsection
