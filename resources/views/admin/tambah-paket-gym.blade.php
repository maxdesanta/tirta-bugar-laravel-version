@extends('app')

@section('content')
    <!-- form tambah paket -->
    <section class="edit-paket">
        <form method="POST" action='/admin/create-paket-member' class="form-edit container">
            <div class="form-group container">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="input-edit" required>
            </div>
            
            <div class="form-group container">
                <label for="keterangan_fasilitas">Keterangan Fasilitas</label>
                <input type="text" name="keterangan_fasilitas" id="keterangan_fasilitas" class="input-edit" required>
            </div>

            <div class="form-group container">
                <label for="keterangan_durasi">Keterangan Durasi</label>
                <input type="text" name="keterangan_durasi" id="keterangan_durasi" class="input-edit" required>
            </div>

            
            <div class="form-group container">
                <label for="keterangan-private">Keterangan Private</label>
                <input type="text" name="keterangan-private" id="keterangan-private" class="input-edit">
            </div>

            <div class="form-group container">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="input-edit">
            </div>

            <div class="btn-group container">
                <button type="submit" name="submit" class="btn-edit">Simpan</button>
                <a href="/admin/paket-member" class="btn-cancell">Kembali</a>
            </div>
        </form>
    </section>
@endsection