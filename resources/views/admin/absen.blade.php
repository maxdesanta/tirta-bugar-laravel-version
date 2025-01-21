@extends('app')

@section('content')
    <div>
        <!-- filtering absen -->
        <section class="filtering-absen">
            <div class="container">
                <form method="GET">
                    <!-- search absen -->
                    <div class="search-absen container">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <img src="{{asset('assets/search.svg')}}" alt="search">
                    </div>
                </form>
            </div>
        </section>
        <section class="absen-table">
            <table>
                <!-- head table -->
                <thead>
                    <tr>
                        <td style="text-align: center;width: 15%;">Tanggal Datang</td>
                        <td style="text-align: center; width: 20%;">nama</td>
                        <td style="text-align: center; width: 10%;">Durasi</td>
                        <td style="text-align: center; width: 15%;">Tanggal Berlaku</td>
                        <td style="text-align: center; width: 15%;">Keterangan Member</td>
                        <td style="text-align: center; width: 15%;">Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absen as $a)
                        <tr>
                            <td>{{$a->tanggal_datang}}</td>
                            <td style="text-align: center;">{{$a->nama_member}}</td>
                            <td style="text-align: center;">{{$a->keterangan_durasi}}</td>
                            <td style="text-align: center;">{{$a->tanggal_berakhir}}</td>
                            <td style="text-align: center;">{{$a->keterangan_fasilitas}}</td>
                            <td style="text-align: center;">{{$a->keterangan_absen}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- Pagination -->
        <section class="pagination">
            {{ $absen->links('vendor.pagination.tailwind') }}
        </section>
    </div>
@endsection