@extends('layouts.main')

@section('content')
    <div class="main">
        <div class="order-1">
            <div class="grid wide">
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col l-7 m-7 c-12 left">
                        <div class="order-1-info">
                            <h4>Vui lòng chọn địa chỉ giao hàng</h4>
                            <form method="POST" id="form" action="{{ route('invoices.store') }}">
                                @csrf
                                @if ($user == null)
                                    <div class="order-1-info-way">
                                        <a href="./dang-nhap">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Đăng nhập (Nếu bạn đã có tài khoản của Laptop Computer)
                                        </a>
                                        <br>
                                        <a href="./dang-ky">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Đăng ký (Tạo tài khoản tại Laptop Computer)
                                        </a>
                                        <br>
                                        <label for="user-register">
                                            <input checked type="radio" class="buy-type" name="buy-type"
                                                id="user-register">
                                            <span>Khách lẻ</span> (Nếu bạn không muốn lưu lại thông tin)
                                        </label>
                                    </div>
                                @endif

                                <div class="pay-info sign signup">
                                    <div class="row">
                                        <div class="col l-6 m-6 c-12">
                                            <div class="form-group">
                                                <label for="signup-fullname">
                                                    Họ tên:<span class="highlight">*</span>
                                                </label>
                                                <br>
                                                <input type="text" name="receiver_name" id="signup-fullname"
                                                    placeholder="Họ tên..." autocomplete="username"
                                                    value="{{ $user->name ?? '' }}">
                                                <br>
                                                <span class="form-message">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col l-6 m-6 c-12">
                                            <div class="form-group">
                                                <label for="signup-email">
                                                    Email:<span class="highlight">*</span>
                                                </label>
                                                <br>
                                                <input type="email" name="receiver_email" id="signup-email"
                                                    placeholder="Email..." autocomplete="email"
                                                    value="{{ $user->email ?? '' }}">
                                                <br>
                                                <span class="form-message">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col l-6 m-6 c-12">
                                            <div class="form-group">
                                                <label for="signup-phone">
                                                    Điện thoại:<span class="highlight">*</span>
                                                </label>
                                                <br>
                                                <input type="text" name="receiver_phone" id="signup-phone"
                                                    placeholder="Điện thoại..." autocomplete="phone"
                                                    value="{{ $user->phone ?? '' }}">
                                                <br>
                                                <span class="form-message">
                                                    @error('phone')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col l-6 m-6 c-12">
                                            <div class="form-group">
                                                <label for="signup-province">
                                                    Tỉnh/TP:<span class="highlight">*</span>
                                                </label>
                                                <br>
                                                <select name="receiver_province" id="signup-province">
                                                </select>
                                                <br>
                                                <span class="form-message">
                                                    @error('province')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col l-6 m-6 c-12">
                                            <div class="form-group">
                                                <label for="signup-district">
                                                    Quận/Huyện:<span class="highlight">*</span>
                                                </label>
                                                <br>
                                                <select name="receiver_district" id="signup-district">
                                                    <option>Chọn Quận/Huyện</option>
                                                </select>
                                                <br>
                                                <span class="form-message">
                                                    @error('district')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col l-6 m-6 c-12">
                                            <div class="form-group">
                                                <label for="signup-ward">
                                                    Phường/Xã:<span class="highlight">*</span>
                                                </label>
                                                <br>
                                                <select name="receiver_ward" id="signup-ward">
                                                    <option>Chọn Xã/Phường</option>
                                                </select>
                                                <br>
                                                <span class="form-message">
                                                    @error('ward')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col l-12 m-12 c-12">
                                            <div class="form-group">
                                                <label for="signup-address">
                                                    Địa chỉ:<span class="highlight">*</span>
                                                </label>
                                                <br>
                                                <textarea name="receiver_address" id="signup-address" rows="5"
                                                    placeholder="Vui lòng điền chính xác thông tin địa chỉ: số nhà, đường, tổ/ấp" autocomplete="address">{{ $user->address ?? '' }}</textarea>
                                                <br>
                                                <span class="form-message">
                                                    @error('address')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ $user->province ?? '' }}" name="hiddenProvinceId"
                                            class="hiddenProvinceId">
                                        <input type="hidden" value="{{ $user->district ?? '' }}" name="hiddenDistrictId"
                                            class="hiddenDistrictId">
                                        <input type="hidden" value="{{ $user->ward ?? '' }}" name="hiddenWardId"
                                            class="hiddenWardId">
                                    </div>
                                </div>

                                <div class="pay-way">
                                    <h4>Phương thức thanh toán</h4>
                                    <p>
                                        <input type="radio" name="payment" value="cash" id="cash" checked>
                                        <label for="cash">Thanh toán khi giao hàng</label>
                                    </p>
                                    <p>
                                        <input type="radio" name="payment" value="vnpay" id="vnpay">
                                        <img src="{{ asset('img/vnpay.png') }}" alt="vnpay" height="20">
                                        <label for="vnpay">&nbsp;Thanh toán bằng VNPay</label>
                                    </p>
                                    <p>
                                        <input type="radio" name="payment" value="momo" id="momo">
                                        <img src="{{ asset('img/momo.png') }}" alt="momo" height="20">
                                        <label for="momo">&nbsp;Thanh toán bằng QR Momo</label>
                                    </p>
                                    <p>
                                        <input type="radio" name="payment" value="ATM momo" id="ATMmomo">
                                        <img src="{{ asset('img/momo.png') }}" alt="momo" height="20">
                                        <label for="ATMmomo">&nbsp;Thanh toán bằng ATM Momo</label>
                                    </p>
                                </div>

                                <p>
                                    <button class="pay" type="submit" value="submit" name="submit">
                                        Thanh toán
                                    </button>
                                </p>
                            </form>
                        </div>
                    </div>

                    <div class="col l-5 m-5 c-12 right">
                        <div class="order-1-money">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp

                                    @foreach ($cart as $item)
                                        @php
                                            $total += $item['quantity'] * $item['price'];
                                        @endphp
                                        <tr>
                                            <td>
                                                <p><?php echo $item['name']; ?></p>
                                            </td>
                                            <td><?php echo $item['quantity']; ?></td>
                                            <td><?php echo $item['quantity'] * $item['price']; ?></td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td>Tổng</td>
                                        <td></td>
                                        <td>
                                            {{ $total }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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

                const selectProvince = $('#signup-province');
                const selectDistrict = $('#signup-district');
                const selectWard = $('#signup-ward');

                let provinceId;
                let districtId;

                let hiddenProvinceId = document.querySelector('.hiddenProvinceId').value;
                let hiddenDistrictId = document.querySelector('.hiddenDistrictId').value;
                let hiddenWardId = document.querySelector('.hiddenWardId').value;

                var provinceString = '<option selected disabled value="">Chọn Tỉnh/TP</option>'
                provinces.forEach((province) => {
                    if (hiddenProvinceId && province.id === hiddenProvinceId) {
                        provinceString += `<option selected value="${province.id}">${province.name}</option>`;
                    } else {
                        provinceString += `<option value="${province.id}">${province.name}</option>`;
                    }
                })
                selectProvince.html(provinceString);

                if (hiddenDistrictId) {
                    let arrDistrict = districts.filter(district => {
                        return district.provinceId == hiddenProvinceId;
                    })

                    let districtString = '';
                    arrDistrict.forEach(district => {
                        if (district.id === hiddenDistrictId) {
                            districtString +=
                                `<option selected value="${district.id}">${district.name}</option>`;
                        } else {
                            districtString += `<option value="${district.id}">${district.name}</option>`;
                        }
                    })

                    selectDistrict.html(districtString);
                }

                if (hiddenWardId) {
                    let arrWard = wards.filter((ward) => {
                        return ward.districtId === hiddenDistrictId;
                    })

                    let wardString = '';
                    arrWard.forEach(ward => {
                        if (ward.id === hiddenWardId) {
                            wardString += `<option selected value="${ward.id}">${ward.name}</option>`;
                        } else {
                            wardString += `<option value="${ward.id}">${ward.name}</option>`;
                        }
                    })

                    selectWard.html(wardString);
                }



                selectProvince.change(function() {
                    let districtString = '<option selected disabled value="">Chọn Huyện/Thị xã</option>';
                    provinceId = selectProvince.val();

                    let arrDistrict = districts.filter((district) => {
                        return district.provinceId === provinceId;
                    })

                    arrDistrict.forEach((district) => {
                        districtString += `<option value="${district.id}">${district.name}</option>`;
                    })
                    selectDistrict.html(districtString);
                })

                selectDistrict.change(function() {
                    let wardString = '';
                    districtId = selectDistrict.val();

                    let arrWard = wards.filter((ward) => {
                        return ward.districtId === districtId;
                    })

                    arrWard.forEach((ward) => {
                        wardString += `<option value="${ward.id}">${ward.name}</option>`;
                    })
                    selectWard.html(wardString);
                })
            });
    </script>

    <script src="{{ asset('js/validator.js') }}"></script>
    <script>
        Validator({
            form: '#form',
            formGroupSelector: '.form-group',
            errorElement: '.form-message',
            rules: [
                Validator.isRequired('#signup-fullname', 'Vui lòng nhập đầy đủ họ tên'),
                Validator.isFullName('#signup-fullname', 'Vui lòng nhập đúng họ tên'),
                Validator.isRequired('#signup-email', 'Vui lòng nhập đầy đủ email'),
                Validator.isEmail('#signup-email', 'Vui lòng nhập đúng email'),
                Validator.isRequired('#signup-phone', 'Vui lòng nhập số điện thoại'),
                Validator.isPhone('#signup-phone', 'Vui lòng nhập đúng số điện thoại'),
                Validator.isRequired('#signup-phone', 'Vui lòng nhập địa chỉ'),
                Validator.isRequired('#signup-province', 'Chọn tỉnh/thành'),
                Validator.isRequired('#signup-district', 'Chọn quận/huyện'),
                Validator.isRequired('#signup-address', "Vui lòng nhập địa chỉ"),
            ],
            // onSubmit: function(data) {
            //     // call API
            //     console.log(data);
            // }
        })
    </script>
@endsection
