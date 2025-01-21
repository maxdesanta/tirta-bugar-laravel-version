@extends('app')

@section('content')
    <!-- form edit paket -->
    <section class="edit-paket">
        <form class="form-edit container" action="/admin/paket-member/{{$detailPaket->id_paket}}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id_paket" value="{{ $detailPaket->id_paket}}">
            <div class="form-group container">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="input-edit" value="{{$detailPaket->nama_paket}}" required>
            </div>
            
            <div class="form-group container">
                <label for="keterangan_fasilitas">Keterangan Fasilitas</label>
                <input type="text" name="keterangan_fasilitas" id="keterangan_fasilitas" class="input-edit" value="{{ $detailPaket->keterangan_fasilitas}}" required>
            </div>

            <div class="form-group container">
                <label for="keterangan_durasi">Keterangan Durasi (berapa pertemuan)</label>
                <input type="text" name="keterangan_durasi" id="keterangan_durasi" class="input-edit" value="{{ $detailPaket->keterangan_durasi}}" required>
            </div>

            
            <div class="form-group container">
                <label for="keterangan_private">Keterangan Private (berapa pertemuan)</label>
                <input type="text" name="keterangan_private" id="keterangan_private" value="{{ $detailPaket->keterangan_private}}" class="input-edit">
            </div>

            <div class="form-group container">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="input-edit" value="{{$detailPaket->harga}}" required>
            </div>

            <div class="btn-group container">
                <button type="submit" name="submit" class="btn-edit">Simpan</button>
                <a href="/admin/paket-member" class="btn-cancell">Kembali</a>
            </div>
        </form>
    </section>
@endsection