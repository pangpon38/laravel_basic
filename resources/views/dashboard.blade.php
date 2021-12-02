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
                    <h3>ข้อมูลผู้ใช้</h3>
                    <h4 class="float-end">จำนวนทั้งหมด: {{count($user)}}</h4>
                     </div>
                    <br>
                    <table width="100%" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><div align="center">ลำดับ</div></th>
                                <th><div align="center">ชื่อ</div></th>
                                <th><div align="center">E-mail</div></th>
                                <th><div align="center">Createdatetime</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1; ?>
                            @foreach ($user as $row)
                            <tr>
                                <td><?php echo $i."."; ?></td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                {{-- <td>{{$row->created_at->diffForHumans()}}</td> --}}
                                <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
