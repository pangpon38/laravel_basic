<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class serviceController extends Controller
{
    public function index()
    {
        $service_data = service::paginate(2, ['*'], 'depart');
        return view('admin.services.service', compact('service_data'));
    }

    public function add(Request $request)
    {

        $request->validate(
            [
                'service_name' => 'required|unique:services|max:255',
                'service_image' => 'required|mimes:jpg,jpeg,png'
            ],
            [
                'service_name.required' => 'กรุณาใส่ข้อมูล',
                'service_name.unique' => 'ข้อมูลซํ้าในระบบ',
                'service_name.max' => 'ข้อมูลมีความยาวเกินไป',
                'service_image.required' => "กรุณาแนบรูปภาพ",
                'service_image.mimes' => 'ประเภทไฟล์จะต้องเป็นเป็น jpg,jpeg,png เท่านั้น'
            ]
        );

        //เข้ารหัสไฟล์
        $service_image = $request->file('service_image');

        $image_uncode = hexdec(uniqid());

        //ดึงนามสกุลภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());

        $img_name = $image_uncode . '.' . $img_ext;

        //upload + บันทึกข้อมูล
        $upload_path = 'image/services/';
        $full_path = $upload_path . $img_name;

        service::insert([
            'service_name' => $request->service_name,
            'service_image' => $full_path,
            'created_at' => Carbon::now()
        ]);

        $service_image->move($upload_path, $img_name);
        return redirect()->back()->with('success', "บันทึกเรียบร้อย");
    }

    public function edit($id)
    {
        $editservice = service::find($id);
        return view('admin.services.service_edit', compact('editservice'));
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'service_name' => 'max:255',
                'service_image' => 'mimes:jpg,jpeg,png'
            ],
            [
                'service_name.max' => 'ข้อมูลมีความยาวเกินไป',
                'service_image.mimes' => 'ประเภทไฟล์จะต้องเป็นเป็น jpg,jpeg,png เท่านั้น'
            ]
        );

        $service_image = $request->file('service_image');

        if ($service_image) {

            $image_uncode = hexdec(uniqid());

            //ดึงนามสกุลภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());

            $img_name = $image_uncode . '.' . $img_ext;

            //upload + บันทึกข้อมูล
            $upload_path = 'image/services/';
            $full_path = $upload_path . $img_name;

            //ลบรูปเก่าทิ้ง
            $old_image = $request->old_img;
            unlink($old_image);

            service::find($request->id)->update([
                'service_name' => $request->service_name,
                'service_image' => $full_path
            ]);

            $service_image->move($upload_path, $img_name);
        } else {
            service::find($request->id)->update([
                'service_name' => $request->service_name
            ]);
        }
        return redirect()->route('services')->with('success', "อัพเดตเรียบร้อย");
    }

    public function delete($id)
    {
        //ลบรูปภาพ//
        $img = service::find($id);
        unlink($img->service_image);

        $delete = service::find($id)->delete();
        return redirect()->route('services')->with('success', "ลบข้อมูลเรียบร้อย");
    }
}
