<?php 
	// Hàm thực hiện tô màu phần từ khóa trong chuỗi ban đầu.
	function ToMau($chuoi_ban_dau, $tukhoa)
	{		
		// // Thay chuỗi từ khóa bằng chuỗi có định dạng màu nền.
		$S = str_ireplace($tukhoa, '<span style="background-color: #ffff33">'.$tukhoa.'</span>', $chuoi_ban_dau );
		return $S;		
	}
?>