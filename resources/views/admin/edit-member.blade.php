@extends('app')

@section('content')
    <!-- form tambah member -->
    <section class="tambah-member">
        <form class="form-tambah container" action="/admin/member/{{$detailMember->id_member}}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="id" value="{{ $detailMember->id_member }}">
            <div class="form-group container">
                <label for="nama">Nama (Sesuai KTP)</label>
                <input type="text" name="nama" id="nama" class="input-tambah" value="{{ $detailMember->nama_member }}">
            </div>
            <div class="form-group container">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input-tambah" value="{{ $detailMember->email }}">
            </div>
            <div class="form-group container">
                <label for="nomor-telepon">Nomor Telepon</label>
                <input type="text" name="nomor-telepon" id="nomor-telepon" class="input-tambah" value="{{ $detailMember->nomor_telepon }}">
            </div>
            <div class="form-group container">
                <label for="durasi">Pilihan Paket</label>
                <select name="durasi" id="durasi" class="input-tambah" onchange="updateEndDate()">
                    <option value="1" {{ $detailMember->id_paket == 1 ? 'selected' : ''}}>Regullar - 1 Bulan 8x Fitness</option>
                    <option value="2" {{ $detailMember->id_paket == 2 ? 'selected' : ''}}>Regullar - 1 Bulan Fitness Sepuasnya</option>
                    <option value="3" {{ $detailMember->id_paket == 3 ? 'selected' : ''}}>Regullar - 3 Bulan Fitness Sepuasnya</option>
                    <option value="4" {{ $detailMember->id_paket == 4 ? 'selected' : ''}}>Regullar - 1 Bulan Sepuasnya + 4x Private Fitness</option>
                </select>
            </div>
            <div class="form-group container">
                <label for="tanggal-awal">Tanggal Perpanjangan</label>
                <input type="date" name="tanggal-awal" id="tanggal-awal" class="input-tambah" onchange="updateEndDate()" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group container">
                <label for="tanggal-akhir">Tanggal Berakhir</label>
                <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="input-tambah" value="{{ $detailMember->tanggal_berakhir }}">
            </div>
            <div class="btn-group container">
                <button type="submit" name="submit" class="btn-tambah">Edit Member</button>
                <a href="/admin/member/{{$detailMember->id_member}}" class="btn-cancell">Batalkan</a>
            </div>
        </form>
    </section>
@endsection
