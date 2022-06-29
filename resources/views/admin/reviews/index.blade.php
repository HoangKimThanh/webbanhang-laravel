@extends('admin.layouts.main')

@section('title')
    Đánh giá
@endsection

@section('content')
    <h1 style="text-align: center;">Danh sách đánh giá</h1>
    <h2>Đánh giá chưa duyệt</h2>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Tùy biến</th>
            </tr>
        </thead>
        <tbody style="font-size: 14px" id="reviews-not-approved">
            @foreach ($reviewsNotApproved as $each)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $each->product_name }}</td>
                    <td>{{ $each->user_name }}</td>
                    <td>{{ $each->user_email }}</td>
                    <td>{{ $each->content }}</td>
                    <td>{{ $each->created_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-approve" data-id="{{ $each->id }}">
                            Duyệt
                        </a>
                        <a class="btn btn-danger btn-delete" data-id="{{ $each->id }}">
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Đánh giá đã duyệt</h2>
    <table id="tableApproved">
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Tùy biến</th>
            </tr>
        </thead>
        <tbody style="font-size: 14px" id="reviews-approved">
            @foreach ($reviewsApproved as $each)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $each->product_name }}</td>
                    <td>{{ $each->user_name }}</td>
                    <td>{{ $each->user_email }}</td>
                    <td>{{ $each->content }}</td>
                    <td>{{ $each->created_at }}</td>
                    <td>
                        <a class="btn btn-danger btn-delete" data-id="{{ $each->id }}">
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
        let btnApproves = $('.btn-approve');
        btnApproves.each(function(index, btnApprove) {
            $(btnApprove).click(function() {
                let id = $(this).data('id');

                let currentRow = $(this).closest("tr");
                let productName = currentRow.find("td:eq(1)").text();
                let userName = currentRow.find("td:eq(2)").text();
                let useremail = currentRow.find("td:eq(3)").text();
                let content = currentRow.find("td:eq(4)").text();
                let createdAt = currentRow.find("td:eq(5)").text();
                let stt = $('#tableApproved tr:last').find("td:eq(0)").text() - 0 + 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('reviews.ajax') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        action: 'update',
                    },
                    dataType: 'json',
                    success: function(data) {
                        $(btnApprove).parent().parent().remove();
                        let row = `<tr> 
                            <td> ${stt} </td>
                            <td> ${productName} </td> 
                            <td> ${userName} </td>
                            <td> ${useremail} </td> 
                            <td> ${content} </td> 
                            <td> ${createdAt} </td>  
                            <td> 
                                <a class="btn btn-danger btn-delete" data-id="${id}">
                                    Xóa
                                </a>
                            </td>
                        </tr>`;
                        $('#reviews-approved').append(row);
                    }
                })
            })
        })

        let btnDeletes = $('.btn-delete');
        btnDeletes.each(function(index, btnDelete) {
            $(btnDelete).click(function() {
                let id = $(this).data('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('reviews.ajax') }}",
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
            })
        })
    </script>
@endsection
