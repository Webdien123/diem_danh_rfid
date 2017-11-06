
// Hiển thị danh sách thống kê theo tên id tương ứng.
function HienDanhSach(id_ds, ten_ds, so_luong_ds) {
    $(".danhsach").hide(0);
    $("#"+id_ds).show(0);
    $("#ten_ds").text(ten_ds);
    $("#so_luong_ds").text(so_luong_ds);
    var ki_tu = id_ds.substring(0, 2);
    if (ki_tu == "sv") {
        $(".loai_ds").text("sinh viên");
        $("#loai_ng_chuyen").val("sv");
    }
    if (ki_tu == "cb") {
        $(".loai_ds").text("cán bộ");
        $("#loai_ng_chuyen").val("cb");
    }
}

// Hàm lấy số lượng danh sách theo id danh sách tương ứng.
function LaySoLuong(id_ds) {
    var sl = 0;
    var id_ds = id_ds.replace(/\s/g,'');

    if (id_ds == 'sv_vang_mat') {
        sl = sv_vang_mat;
    }
    if (id_ds == 'sv_co_mat') {
        sl = sv_co_mat;
    }
    if (id_ds == 'sv_co_v_k_ra') {
        sl = sv_co_vao_k_ra;
    }
    if (id_ds == 'sv_co_ra_k_v') {
        sl = sv_co_ra_k_vao;
    }
    if (id_ds == 'sv_chua_co_ttin') {
        sl = sv_k_co_ttin;
    }
    
    if (id_ds == 'cb_vang_mat') {
        sl = cb_vang_mat;
    }
    if (id_ds == 'cb_co_mat') {
        sl = cb_co_mat;
    }
    if (id_ds == 'cb_co_v_k_ra') {
        sl = cb_co_vao_k_ra;
    }
    if (id_ds == 'cb_co_ra_k_v') {
        sl = cb_co_ra_k_vao;
    }
    if (id_ds == 'cb_chua_co_ttin') {
        sl = cb_k_co_ttin;
    }

    return sl;
}

$(document).ready(function () {
    // Xử lý chuyển danh sách khi chọn tên danh sách trong hộp select
    $( "#sel1" ).change(function () {
        var id_ds = "";
        var ten_ds = "";
        $( "#sel1 option:selected" ).each(function() {
            id_ds += $( this ).val() + " ";
            ten_ds += $( this ).text() + " ";
        });
        var so_luong_ds = LaySoLuong(id_ds);
        HienDanhSach(id_ds, ten_ds, so_luong_ds);
    })
    .change();
});