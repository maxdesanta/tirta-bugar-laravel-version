@extends('app')

@section('content')
    <div>
        <!-- filtering transaksi -->
        <section class="filtering-transaksi">
            <form method="GET" action="{{url('/admin/transaksi')}}" class="container">
                <!-- filter member -->
                <div class="filter-transaksi">
                    <select name="filter" id="filter" onchange="this.form.submit()">
                        <option value="">Filter</option>
                        <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Bulan ini</option>
                    </select>
                </div>
                <!-- search member -->
                <div class="search-transaksi container">
                    <input type="text" name="search" id="search" placeholder="Search" value="{{ request('search') }}">
                    <img src="{{asset('assets/search.svg')}}" alt="search">
                </div>
        </section>
        <section class="member-table">
            <table>
                <!-- head table -->
                <thead>
                    <tr>
                        <td style="text-align: center;width: 15%;">Tanggal Transaksi</td>
                        <td style="text-align: center;width: 10%;">Invoice</td>
                        <td style="text-align: center;width: 15%;">Nama</td>
                        <td style="text-align: center; width: 15%;">Nomor Telepon</td>
                        <td style="text-align: center; width: 10%;">Durasi</td>
                        <td style="text-align: center; width: 15%;">Keterangan</td>
                        <td style="text-align: center; width: 10%;">Status Pembayaran</td>
                        <td style="text-align: center; width: 15%;">Total Bayar</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction as $t)
                        <tr>
                            <td style="text-align: center;">{{$t->tanggal_transaksi_formated}}</td>
                            <td style="text-align: center;">{{$t->invoice}}</td>
                            <td>{{$t->nama_member}}</td>
                            <td style="text-align: center;">{{$t->nomor_telepon}}</td>
                            <td style="text-align: center;">{{$t->keterangan_durasi}}</td>
                            <td style="text-align: center;">{{$t->keterangan_fasilitas}}</td>
                            <td style="text-align: center;"><b>{{$t->status_pembayaran}}</b></td>
                            <td style="text-align: center;">{{'Rp ' . number_format($t->total_harga,0,',','.')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- Pagination -->
        <section class="pagination">
            {{ $transaction->links('vendor.pagination.tailwind') }}
        </section>
    </div>
@endsection