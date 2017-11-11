<?php
// Lớp định nghĩa các hàm thao tác trên email
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ChuyenMail;
use Illuminate\Support\MessageBag;
use Mail;

class MailController extends Controller
{
    // Xử lý gửi mail
    public static function GuiMail($name, $email, $ma_so_xac_thuc)
    {
        try{
            // Tạo nội dung dựa theo tên người nhận
            $content = [
                'noidung'=> 'Xin chào '.$name.
                    "<br>Bạn nhận được một yêu cầu kích hoạt điểm danh sự kiện với mã số ".
                    $ma_so_xac_thuc
            ];

            // Gửi mail.
            Mail::to($email)->send(new ChuyenMail($content));

            return true;
        }
        catch(\Exception $e){
            return false;
            // echo $e->getMessage();
        }
    }

    // Kiểm tra mail nhập vào có phải mail quản trị hay không và gửi mail để xác nhận sự kiện
    public function CheckAdminMail(Request $R)
    {
        // Lấy giá trị request
        $ma_so_xac_thuc = $R->ma_so_xac_thuc;
        $mask = $R->mask;
        if ($ma_so_xac_thuc != null) {
            if($ma_so_xac_thuc == \Session()->get('ma_so_xac_thuc')){
                \Session()->put('xac_thuc_sk', $mask);
                return redirect()->route('chonsukien', [
                    'mask' => $mask,
                    'ma_so_xac_thuc' => $ma_so_xac_thuc
                ]);
            }
            else {
                \Session::put('err_xac_thuc', '1');
                $errors = new MessageBag(['mg' => 'Email hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($errors);
            }   
        }

        $email = $R->email;
        $mask = $R->mask;
        $name = \DB::select('SELECT name FROM users WHERE email = ?', [$email]);

        if ($name) {
            $name = $name[0]->name;

            $ma_so_xac_thuc = mt_rand(100000, 999999);
            \Session()->put('ma_so_xac_thuc', $ma_so_xac_thuc);

            $kq = self::GuiMail($name, $email, $ma_so_xac_thuc);
            
            if ($kq == true) {
                WriteLogController::Write_Debug("Gửi mail thành công đến ".$email);
            } else {
                WriteLogController::Write_Debug("Gửi mail đến ".$email." thất bại");
            }

            return redirect()->route('chonsukien', [
                'mask' => $mask,
                'ma_so_xac_thuc' => $ma_so_xac_thuc
            ]);
        }
        else {
            \Session::put('err_xac_thuc', '1');
            $errors = new MessageBag(['mg' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
