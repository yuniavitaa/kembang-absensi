@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4" style="margin: 1%;">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Absensi dan Presensi</h6>
        <br>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Piket</th>
                        <th>Jam Pulang</th>
                        <th>Bukti Presensi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @php $no=1 @endphp  
                    @foreach ($jadwal as $data)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->tanggal}}</td>
                        <td>{{$data->jam_masuk}}</td>
                        <td>{{$data->jam_piket}}</td>
                        <td>{{$data->jam_pulang}}</td>
                        <td>
                            @if($data->gambar)
                                <img src="{{ asset('images/' . $data->gambar) }}" alt="Gambar" width="100">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>
                            <form action="{{route('jadwal.destroy',$data->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin menghapus')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection