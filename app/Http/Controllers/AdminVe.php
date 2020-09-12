<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Ve;
use App\ChuyenXe;
use App\TuyenXe;
use App\NguoiDi;

class AdminVe extends Controller
{
    //
      function getNguoidi(){
    	$nguoidi = DB::table('nguoidi')->get();
        $stt = 0;
        foreach($nguoidi as $v)
        {
            $stt = $stt+1;
            $v->stt = $stt;
        }
    	return view('admin.page.phieudatve.dsve.danhsach',compact('nguoidi'));
    }

    function getThem(){   
        $nguoidi = DB::table('nguoidi')->get();
        return view('admin.page.phieudatve.dsve.danhsach',compact('nguoidi'));
    }

    function postThem(Request $req){
        $nguoidi = new Phieunguoidi();
        $nguoidi->bienso = $req->bienso;
        $nguoidi->soghe = $req->soghe;
        $nguoidi->loaiPhieunguoidi = $req->loaiPhieunguoidi;
        $nguoidi->hinhPhieunguoidi = $req->hinhPhieunguoidi;
        $nguoidi->sanguoidi();   
       return redirect('admin/ve/danhsach')->with('thongbao','Thêm thành công');
    }

    function getSua($id){
        $nguoidi = DB::table('nguoidi')
        ->where('idPhieunguoidi',$id)->first();
        return view('admin.page.phieudatve.dsve.sua',compact('Phieunguoidi'));
    }

    function postSua(Request $req,$id){
        $nguoidi = nguoidi::find($id);
        $nguoidi->cmnd = $req->cmnd;
        $nguoidi->hoten = $req->hoten;
        $nguoidi->gioitinh = $req->gioitinh;
        $nguoidi->sdt = $req->sdt;
        $nguoidi->soluong = $req->soluong;
        $nguoidi->tongtien = $req->tongtien;
        $nguoidi->trangthai = $req->trangthai;     
        $nguoidi->sanguoidi();
        return redirect('admin/ve/danhsach')->with('thongbao','Sửa thành công');   
    }

    public function getXoa($id)
    {
        $nguoidi = DB::table('nguoidi')->where('idnguoidi',$id)->delete();
        return redirect('admin/ve/danhsach')->with('thongbao','Xóa thành công');
    }
    
}
