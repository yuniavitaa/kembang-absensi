@extends('layouts.anggota')

@section('content')
<div class="card" style="margin: 2%">
    <div class="card-header bg-primary text-white">Masukkan Laporan Jadwal Anda</div>
    <div class="card-body">
        <a href="/jadwal" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
        <form action="{{ route('jadwal.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="karyawan_id">Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" class="form-control" required>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <br>
                <label for="">Masukan Nama</label>
                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                @error('nama')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="">Masukan Tanggal</label>
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Masukkan Tangal">
                @error('tanggal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="">Masukan Jam Masuk</label>
                <input type="text" name="jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror" placeholder="Masukkan Jam Masuk, jika Absensi ketik absen dan berikan S/I nya">
                @error('jam_masuk')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="">Masukan Jam Piket</label>
                <input type="text" name="jam_piket" class="form-control @error('jam_piket') is-invalid @enderror" placeholder="Masukkan Jam Piket, jika tidak Piket di hari anda bekerja ketik --">
                @error('jam_piket')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="">Masukan Jam Pulang</label>
                <input type="text" name="jam_pulang" class="form-control @error('jam_pulang') is-invalid @enderror" placeholder="Masukkan Jam Pulang, jika tidak hadir ketik --">
                @error('jam_pulang')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="gambar">Unggah Gambar</label>
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                @error('gambar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <br>
            <center>
            <div class="form-group">
                <button type="reset" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                    <i class="fas fa-window-restore fa-sm text-white-50"></i> Reset</button>
                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-check fa-sm text-white-50"></i> Simpan</button>
            </div>
            </center>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#karyawan_id').change(function() {
            var karyawanId = $(this).val();
            if (karyawanId) {
                $.ajax({
                    url: '/get-karyawan/' + karyawanId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if(data) {
                            $('#nama').val(data.nama);
                        } else {
                            $('#nama').val('');
                        }
                    }
                });
            } else {
                $('#nama').val('');
            }
        });
    });
</script>
@endsection
