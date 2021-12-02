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
                                    <form action="{{route('update_depart',['id' => $edit_depart->id])}}" method="post">
                                        @csrf
                                        <label for="depart_name">ตำแหน่ง: </label>
                                        <input type="text" class="form-control" name="depart_name" id="depart_name" value="{{$edit_depart->department_name}}">
                                        @error('depart_name')
                                        <div class="py-2">
                                            <span class="error-message text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
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
