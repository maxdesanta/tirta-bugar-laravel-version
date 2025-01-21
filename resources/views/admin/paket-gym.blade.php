@extends('app')

@section('content')
    <!-- paket list -->
    <section class="packet-table">
        <div style="text-align: right; margin-top: 10px;">
            <a href="{{url('admin/tambah-paket-member')}}" class="button">Tambah Paket</a>
        </div>
        <table>
            <!-- head table -->
            <thead>
                <tr>
                    <td>Nama Paket</td>
                    <td>Harga</td>
                    <td>Durasi</td>
                    <td>Keterangan Fasilitas</td>
                    <td>Kunjungan Private</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($paketMember as $paket)
                    <tr>
                        <td>{{$paket->nama_paket}}</td>
                        <td>{{'Rp ' . number_format($paket->harga,0,',','.')}}</td>
                        <td>{{$paket->keterangan_durasi}}</td>
                        <td>{{$paket->keterangan_fasilitas}}</td>
                        @if ($paket->keterangan_private == null)
                            <td>-</td>
                        @else
                            <td>{{$paket->keterangan_private}}</td>
                        @endif
                        <td class="action">
                            <div class="container" style="width: 100%;align-items: center;justify-content: center;gap: 10px;">
                                <a href="/admin/paket-member/{{$paket->id_paket}}/edit" class="btn-edit">Edit</a>
                                <form action="/admin/paket-member/{{$paket->id_paket}}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection