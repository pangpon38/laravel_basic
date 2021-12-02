<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mb-3">
                    <div class="header" style="padding: 5px 5px 5px 5px;"></div>
                    <h3>Services</h3>
                    <div class="row">
                        <div class="col-md-8">
                            @if (session("success"))
                                <div class="alert alert-success">{{session("success")}}</div>
                                @endif

                                <div class="card">
                                    <div class="card-header">
                                        ตารางข้อมูลบริการ
                                    </div>
                                    <table width="100%" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><div align="center">ลำดับ</div></th>
                                                <th><div align="center">ชื่อไฟล์</div></th>
                                                <th><div align="center">รูปภาพ</div></th>
                                                <th><div align="center">Createdatetime</div></th>
                                                <th><div align="center">จัดการ</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($service_data as $row)
                                            <tr>
                                               <td>{{$service_data->firstItem()+$loop->index}}</td>
                                               <td>{{$row->service_name}}</td>
                                               <td><img src="{{asset($row->service_image)}}" alt="" style="width:200px; height: 200px;"></td>
                                               {{-- <td>{{$row->name}}</td> --}}
                                               <td>@if ($row->created_at == NULL)
                                                   -
                                               @else
                                               {{$row->created_at}}</td>
                                               @endif
                                               <td><div align="center"><a href="{{ url('/services/edit/' . $row->id ) }}" class="btn btn-primary">แก้ไข</a>&nbsp;
                                                 <a href="{{ url('/services/delete/' . $row->id ) }}" class="btn btn-warning">ลบข้อมูล</a></div></td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$service_data->links()}}
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    ฟอร์มรูปภาพ
                                </div>
                            <div class="card-body">
                                <form action="{{route('add_services')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                    <div class="form-group">
                                        <label for="service_name">ชื่อไฟล์:</label>
                                        <input type="text" class="form-control" value="{{old('service_name')}}" name="service_name" id="service_name">
                                    </div>
                                    @error('service_name')
                                        <div class="py-2">
                                            <span class="error-message text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                    <div class="form-group">
                                        <label for="service_name">ไฟล์แนบ:</label>
                                        <input type="file" class="form-control" name="service_image" id="service_image">
                                    </div>
                                    @error('service_image')
                                        <div class="py-2">
                                            <span class="error-message text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                    </div>
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