@extends('app');

@section('content')
    <!-- form tambah member -->
    <section class="tambah-member">
        <form method="POST" action="/admin/create" class="form-tambah container">
            <div class="form-group container">
                <label for="nama">Nama (Sesuai KTP)</label>
                <input type="text" name="nama" id="nama" class="input-tambah" required>
            </div>
            <div class="form-group container">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input-tambah" required>
            </div>
            <div class="form-group container">
                <label for="nomor-telepon">Nomor Telepon</label>
                <input type="text" name="nomor-telepon" id="nomor-telepon" class="input-tambah" required>
            </div>
            <div class="form-group container">
                <label for="durasi">Pilih Paket</label>
                <select name="durasi" id="durasi" class="input-tambah" onchange="updateEndDate()">
                    <option value="1">Regullar - 1 Bulan 8x Fitness</option>
                    <option value="2">Regullar - 1 Bulan Fitness Sepuasnya</option>
                    <option value="3">Regullar - 3 Bulan Fitness Sepuasnya</option>
                    <option value="4">Regullar - 1 Bulan Sepuasnya + 4x Private Fitness</option>
                </select>
            </div>
            <div class="form-group container">
                <label for="tanggal-awal">Tanggal Awal</label>
                <input type="date" name="tanggal-awal" id="tanggal-awal" class="input-tambah" value="<?= date('Y-m-d') ?>" onchange="updateEndDate()">
            </div>
            <div class="form-group container">
                <label for="tanggal-akhir">Tanggal Akhir</label>
                <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="input-tambah" onchange="updateEndDate()" required>
            </div>
            <div class="btn-group container">
                <button type="submit" name="submit" class="btn-tambah">Tambah Member</button>
                <a href="{{url('admin')}}" class="btn-cancell">Batalkan</a>
            </div>
        </form>
    </section>
@endsection