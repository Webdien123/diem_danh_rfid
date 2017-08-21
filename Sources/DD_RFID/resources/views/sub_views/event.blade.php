@extends('admin')

@section('event')
    <div class="col-xs-12">
            
        <div class="pull-right">
			<form action="" method="get" class="form-inline" role="search">
				<input type="hidden" name="_token" value="HdmoKcKa4GbZY5A1e2NUvlH4Jtab0z0bitquS7OQ">
				<b>Tìm kiếm:</b>
				<input type="text" class="form-control" name="TuKhoa" placeholder="Nhập nội dung tìm kiếm" required>
				<button type="submit" class="btn btn-success">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					Tìm
				</button>
			</form>
		</div>
        
    </div>
    </div>
    <div class="row">
    </div>
        <center><h1>Danh sách sự kiện</h1></center>

        <div class="pull-left">
                <button type="button" class="btn btn-primary"  data-toggle="modal" href='#modal-themsv' id="btn_them_sv">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Thêm sự kiện
                </button>
        </div>

    
@endsection

