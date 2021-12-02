<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class departmentController extends Controller
{
    public function index(){

        //join table query builder
        // $depart_data = DB::table('departments')
        // ->join('users', 'departments.user_id','users.id')
        // ->select('departments.*','users.name')->paginate(5);
        //get all data
        // $depart_data = Department::all();

        //get data paging eloquent
        $depart_data = Department::paginate(2,['*'],'depart');
        $trash_depart_data = Department::onlyTrashed()->paginate(2,['*'],'trashdepart');

        //get data paging query builder
        //$depart_data = DB::table('departments')->paginate(5);
        return view('admin.department.depart',compact('depart_data','trash_depart_data'));
    }

    public function add_depart(Request $request){
        //debug data//
        // dd($request->depart_name);
        
        //validate data//
        $request->validate([
            'depart_name'=>'required|unique:departments,department_name|max:255'
        ],
        ['depart_name.required'=>'กรุณาใส่ข้อมูล',
         'depart_name.unique'=>'ข้อมูลซํ้าในระบบ',
         'depart_name.max'=> 'ข้อมูลมีความยาวเกินไป'
        ]);

        //insert data eloquent
        // $depart = new Department;
        // $depart->department_name = $request->depart_name;
        // $depart->user_id = Auth::user()->id;
        // $depart->save();

        //set time zone//
        date_default_timezone_set('Asia/Bangkok');

        //insert data query builder
        $data = array(
            "department_name" => $request->depart_name,
            "user_id" => Auth::user()->id,
            "created_at" =>  date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        );

        DB::table("departments")->insert($data);
        return redirect()->back()->with('success',"บันทึกเรียบร้อย");
    }

    public function edit($id){
        $edit_depart = Department::find($id);
        return view('admin.department.edit',compact('edit_depart'));
    }

    public function update(Request $request){
                //validate data//
                $request->validate([
                    'depart_name'=>'required|unique:departments,department_name|max:255'
                ],
                ['depart_name.required'=>'กรุณาใส่ข้อมูล',
                 'depart_name.unique'=>'ข้อมูลซํ้าในระบบ',
                 'depart_name.max'=> 'ข้อมูลมีความยาวเกินไป'
                ]);

                Department::find($request->id)->update([
                    'department_name' => $request->depart_name,
                    'user_id' => Auth::user()->id]);
                    return redirect()->route('department')->with('success',"บันทึกเรียบร้อย");

    }

    public function delete($id){
       $delete = Department::find($id)->delete();
       return redirect()->route('department')->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function restore($id){
       $restore = Department::withTrashed()->find($id)->restore();
       return redirect()->route('department')->with('success',"กู้ข้อมูลเรียบร้อย");
    }

    public function force_del($id){
        $delete = Department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('department')->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }
}
