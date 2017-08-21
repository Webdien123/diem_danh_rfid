@extends('admin')

@section('event')
    <div class="col-xs-12">
            
        <div class="pull-right">
			<form action="" method="get" class="form-inline" role="search">
				<input type="hidden" name="_token" value="HdmoKcKa4GbZY5A1e2NUvlH4Jtab0z0bitquS7OQ">
				<b>Tìm kiếm:</b>
				<input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
				<button type="submit" class="btn btn-info">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					Tìm
				</button>
			</form>
		</div>
        
    </div>
        <h1>Danh sách sinh viên đã đăng kí</h1>

        <div class="pull-left">
                <button type="button" class="btn btn-primary"  data-toggle="modal" href='#modal-themsv' id="btn_them_sv">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Thêm sinh viên
                </button>
        </div>

    
@endsection

