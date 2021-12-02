<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
                {{-- {{$user}} --}}
                <div class="container">
                    <div class="header" style="padding: 5px 5px 5px 5px">
                        <h3>Edit Department</h3>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        แก้ไขแบบฟอร์ม
                                    </div>
                                    <div class="card-body">
                                    <form action="{{route('update_services',['id' => $editservice->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                        <label for="service_name">ชื่อไฟล์: </label>
                                        <input type="text" class="form-control" name="service_name" id="service_name" value="{{$editservice->service_name}}">
                                    </div>
                                        @error('service_name')
                                        <div class="py-2">
                                            <span class="error-message text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="service_image">ภาพประกอบ: </label>
                                            <input type="file" class="form-control" name="service_image" id="service_image" value="{{$editservice->service_image}}">
                                        </div>
                                            @error('service_image')
                                            <div class="py-2">
                                                <span class="error-message text-danger">{{$message}}</span>
                                            </div>
                                            @enderror
                                        <br>
                                        <input type="hidden" name="old_img" id="old_img" value="{{$editservice->service_image}}">
                                        <div class="form-group">
                                            <img src="{{asset($editservice->service_image)}}" style="width:200px; height: 200px;" alt="">
                                        </div>
                                        <br>
                                            <input type="submit" class="btn btn-success"value="แก้ไข">
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
