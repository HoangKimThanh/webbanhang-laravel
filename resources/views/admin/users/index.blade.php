@extends('admin.layouts.main')

@section('title')
    Khách hàng
@endsection

@section('content')
    <h1 style="text-align: center;">Danh sách khách hàng</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody style="font-size: 14px">
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <input type="hidden" value="{{ $user->province }}" id="province_id-{{ $user->id }}">
                        <input type="hidden" value="{{ $user->district }}" id="district_id-{{ $user->id }}">
                        <input type="hidden" value="{{ $user->ward }}" id="ward_id-{{ $user->id }}">
                        <input type="hidden" value="{{ $user->address }}" id="address-{{ $user->id }}">
                        <span data-id="{{ $user->id }}" class="full_address_{{ $user->id }}"></span>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" data-id="{{ $user->id }}"
                                href="customers-delete.php?id={{ $user->id }}" ?>
                                Xóa
                            </button>
                        </form>
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
            })

        let btnDeletes = $('.btn-danger');
        btnDeletes.each(function(index, btnDelete) {
            $(btnDelete).click(function(event) {
                $isReally = confirm('Really delete this?');
                if (!$isReally) {
                    event.preventDefault();
                }
            })
        })
    </script>
@endsection
