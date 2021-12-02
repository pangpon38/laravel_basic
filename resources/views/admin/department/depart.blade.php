<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
                {{-- {{$user}} --}}
                <div class="container">
                    <div class="header" style="padding: 5px 5px 5px 5px">
                        <h3>Department</h3>
                        <div class="row">
                            <div class="col-md-8">
                                @if (session("success"))
                                <div class="alert alert-success">{{session("success")}}</div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        ตารางข้อมูล
                                    </div>
                                    <table width="100%" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><div align="center">ลำดับ</div></th>
                                                <th><div align="center">ชื่อแผนก</div></th>
                                                <th><div align="center">ชื่อผู้ใช้</div></th>
                                                <th><div align="center">Createdatetime</div></th>
                                                <th><div align="center">จัดการ</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach ($depart_data as $row)
                                           <tr>
                                              <td>{{$depart_data->firstItem()+$loop->index}}</td>
                                              <td>{{$row->department_name}}</td>
                                              <td>{{$row->user->name}}</td>
                                              {{-- <td>{{$row->name}}</td> --}}
                                              <td>@if ($row->created_at == NULL)
                                                  -
                                              @else
                                              {{$row->created_at}}</td>
                                              @endif
                                              <td><div align="center"><a href="{{ url('/depart/edit/' . $row->id ) }}" class="btn btn-primary">แก้ไข</a>&nbsp;
                                                <a href="{{ url('/depart/delete/' . $row->id ) }}" class="btn btn-warning">ลบข้อมูล</a></div></td>
                                           </tr> 
                                           @endforeach
                                        </tbody>
                                    </table>
                                    {{$depart_data->links()}}
                                </div>
                                @if (count($trash_depart_data) > 0)
                                <div class="card">
                                    <div class="card-header">
                                        ถังขยะ
                                    </div>
                                    <table width="100%" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><div align="center">ลำดับ</div></th>
                                                <th><div align="center">ชื่อแผนก</div></th>
                                                <th><div align="center">ชื่อผู้ใช้</div></th>
                                                <th><div align="center">Createdatetime</div></th>
                                                <th><div align="center">กู้คืน</div></th>
                                                <th><div align="center">ลบถาวร</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trash_depart_data as $row)
                                            <tr>
                                               <td>{{$trash_depart_data->firstItem()+$loop->index}}</td>
                                               <td>{{$row->department_name}}</td>
                                               <td>{{$row->user->name}}</td>
                                               {{-- <td>{{$row->name}}</td> --}}
                                               <td>@if ($row->created_at == NULL)
                                                   -
                                               @else
                                               {{$row->created_at}}</td>
                                               @endif
                                               <td><div align="center"><a href="{{ url('/depart/restore/' . $row->id ) }}" class="btn btn-primary">Restore</a></div></td>
                                                 <td><div align="center"><a href="{{ url('/depart/forcedelete/' . $row->id ) }}" class="btn btn-danger">ลบข้อมูลถาวร</a></div></td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$trash_depart_data->links()}}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        แบบฟอร์ม
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('add_depart')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                            <label for="depart_name">ชื่อตำแหน่ง: </label>
                                            <input type="text" class="form-control" placeholder="" name="depart_name" id="depart_name">
                                        </div>
                                        @error('depart_name')
                                        <div class="py-2">
                                            <span class="error-message text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                        <br>
                                            <input type="submit" class="btn btn-primary"value="บันทึก">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
