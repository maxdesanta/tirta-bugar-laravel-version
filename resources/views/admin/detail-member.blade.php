@extends('app')

@section('content')
    <!-- detail member -->
    <section class="detail-member">
        <!-- detail member layout -->
        <div class="container">
            <div class="detail-member-group container">
                <p class="label-nama">Nama</p>
                <p>:</p>
                <p id="nama-member">{{$detailMember['nama_member']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-phone">Nomor Telepon</p>
                <p>:</p>
                <p id="nomor-telepon">{{$detailMember['nomor_telepon']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-email">Email</p>
                <p>:</p>
                <p id="email">{{$detailMember['email']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-password">Password</p>
                <p>:</p>
                <p id="password">{{base64_decode($detailMember['password'])}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-paket">Jenis Paket</p>
                <p>:</p>
                <p id="paket">{{$detailMember['nama_paket']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-durasi">Durasi</p>
                <p>:</p>
                <p id="durasi">{{$detailMember['keterangan_durasi']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-date-start">Tanggal Awal</p>
                <p>:</p>
                <p id="date-start">{{$detailMember['tanggal_awal']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-date-end">Tanggal Akhir</p>
                <p>:</p>
                <p id="date-end">{{$detailMember['tanggal_berakhir']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-keterangan">Keterangan</p>
                <p>:</p>
                <p id="keterangan">{{$detailMember['keterangan_fasilitas']}}</p>
            </div>
            <div class="detail-member-group container">
                <p class="label-keterangan">Private Fitness</p>
                <p>:</p>
                <p id="private">{{$detailMember['keterangan_private']}}</p>
            </div>
        </div>
        <div class="btn-group container">
            <a href="/admin/member/{{$detailMember['id_member']}}/edit" class="btn-edit">Edit Member</a>
            <a href="/admin" class="btn-delete">Batalkan</a>
        </div>      
    </section>
@endsection