@extends('layouts.main')

@section('content')
    <div class="main">
        <div class="profile">
            <div class="grid wide">
                <div class="row">
                    @if (session()->has('success'))
                        <input type="hidden" id="success" value="{{ session()->get('success') }}">
                    @endif
                    <div class="col l-12 m-12 c-12">
                        <div class="profile__info">
                            <h2>Thông tin cá nhân</h2>
                            <form method="POST" id="form" action="{{ route('user.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">
                                        Họ tên:
                                    </label>
                                    <br>
                                    <input value="{{ $user->name }}" name="name" type="text" id="name">
                                    <span class="form-message">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">
                                        Số điện thoại:
                                    </label>
                                    <br>
                                    <input value="{{ $user->phone }}" name="phone" type="text" id="phone">
                                    <span class="form-message">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="province">
                                        Tỉnh/Thành phố:
                                    </label>
                                    <br>
                                    <select name="province" id="province"></select>
                                    <span class="form-message">
                                        @error('province')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="district">
                                        Quận/Huyện/Thị xã:
                                    </label>
                                    <br>
                                    <select name="district" id="district"></select>
                                    <span class="form-message">
                                        @error('district')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="ward">
                                        Xã:
                                    </label>
                                    <br>
                                    <select name="ward" id="ward"></select>
                                    <span class="form-message">
                                        @error('ward')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="address">
                                        Địa chỉ nhà:
                                    </label>
                                    <br>
                                    <textarea name="address" id="address" cols="30" rows="5">{{ $user->address }}</textarea>
                                    <span class="form-message">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <button class="btn" type="submit" name="submit" value="submit">Cập nhật</button>
                            </form>
                            <input type="hidden" name="province" value="{{ $user->province }}" class="province">
                            <input type="hidden" name="district" value="{{ $user->district }}" class="district">
                            <input type="hidden" name="ward" value="{{ $user->ward }}" class="ward">
                        </div>

                        <div class="profile__account">
                            <h2>Thông tin tài khoản</h2>
                            <p>
                                <label for="email">
                                    Email:
                                </label>
                                <span>
                                    {{ $user->email }}
                                </span>
                                <br>
                            </p>

                            <p>
                                <a class="btn" style="margin-top: 16px; margin-bottom: 0" href="doi-email">Đổi email</a>
                            </p>

                            <p>
                                <a class="btn" style="margin-top: 16px; margin-bottom: 0" href="doi-mat-khau">Đổi mật
                                    khẩu</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const elementSuccess = document.querySelector('#success');
        if (elementSuccess) {
            alert(elementSuccess.value);
        }

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

                const selectProvince = $('#province');
                const selectDistrict = $('#district');
                const selectWard = $('#ward');

                let provinceId;
                let districtId;

                let hiddenProvinceId = document.querySelector('.province').value;
                let hiddenDistrictId = document.querySelector('.district').value;
                let hiddenWardId = document.querySelector('.ward').value;

                var provinceString = '<option disabled value="">Chọn Tỉnh/TP</option>'
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
                    console.log(hiddenDistrictId)
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
    <script src="./assets/js/validator.js"></script>
    <script>
        Validator({
            form: '#form',
            formGroupSelector: '.form-group',
            errorElement: '.form-message',
            rules: [
                Validator.isRequired('#name', 'Vui lòng nhập đầy đủ họ tên'),
                Validator.isFullName('#name', 'Vui lòng nhập đúng họ tên'),
                Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại'),
                Validator.isPhone('#phone', 'Vui lòng nhập đúng số điện thoại'),
                Validator.isRequired('#province', 'Chọn tỉnh/thành'),
                Validator.isRequired('#district', 'Chọn quận/huyện'),
                Validator.isRequired('#address', "Vui lòng nhập địa chỉ"),

            ],
            // onSubmit: function(data) {
            //     // call API
            //     console.log(data);
            // }
        })
    </script>
@endsection
