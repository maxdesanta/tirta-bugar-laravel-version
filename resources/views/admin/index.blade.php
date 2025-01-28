@extends('app')

@section('content')
    <div>
        <!-- amount member -->
        <section class="amount-member">
            <div class="container">
                <!-- card member -->
                <x-member.card-amount :image="asset('assets/amount-member.svg')" :title="'Jumlah Member'" :amount="$jmlhMember"></x-member.card-amount>
                <x-member.card-amount :image="asset('assets/amount-active.svg')" :title="'Masih Aktif'" :amount="$jmlhMemberAktif"></x-member.card-amount>
                <x-member.card-amount :image="asset('assets/amount-nonactive.svg')" :title="'Tidak Aktif'" :amount="$jmlhNonAktif"></x-member.card-amount>
            </div>
        </section>

        <!-- filtering member -->
        <section class="filtering-member">
            <form action="{{ url('/admin') }}" method="GET" onsubmit="console.log('Form submitted'); return true;">
                <div class="filter-group container">
                    <div class="f container">
                        <div>
                            <div class="filter-member">
                                <select name="combined_filter" id="combined_filter" onchange="this.form.submit()">
                                    <option value="">Filter & Sort</option>
                                    <option value="all-asc" {{ request('combined_filter') == 'all-asc' ? 'selected' : '' }}>A - Z</option>
                                    <option value="all-desc" {{ request('combined_filter') == 'all-desc' ? 'selected' : '' }}>Z - A</option>
                                    <option value="aktif" {{ request('combined_filter') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="hampir_habis" {{ request('combined_filter') == 'hampir_habis' ? 'selected' : '' }}>Hampir Habis</option>
                                    <option value="tidak_aktif" {{ request('combined_filter') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="filter-member">
                                <select name="sort_by_date" id="sort_by_date" onchange="this.form.submit()">
                                    <option value="">Sort by Date</option>
                                    <option value="asc" {{ request('sort_by_date') == 'asc' ? 'selected' : '' }}>Lama ke Baru</option>
                                    <option value="desc" {{ request('sort_by_date') == 'desc' ? 'selected' : '' }}>Baru ke Lama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="search-member container">
                        <input type="text" name="search" id="search" placeholder="Search" value='{{ $search ?? '' }}'>
                        <img src="assets/search.svg" alt="search">
                    </div>    
                </div>
            </form>
        </section>
        <section class="member-table">
            <table>
                <thead>
                    <tr>
                        <td style="text-align: center;width: 16%;">Nama</td>
                        <td style="text-align: center; width: 15%;">Nomor Telepon</td>
                        <td style="text-align: center; width: 10%;">Durasi</td>
                        <td style="text-align: center; width: 15%;">Keterangan</td>
                        <td style="text-align: center; width: 15%;">Private Fitness</td>
                        <td style="text-align: center; width: 15%;">Tanggal Berlaku</td>
                        <td style="text-align: center; width: 15%;">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    {{-- data member --}}
                    @foreach ($members as $member)
                        <tr class="{{ $member->selisih === 0 ? 'habis' : ($member->selisih <= 7 ? 'hampir-habis' : '') }}">
                            <td style="text-align: center;">{{$member->nama_member}}</td>
                            <td style="text-align: center;">{{$member->nomor_telepon}}</td>
                            <td style="text-align: center;">{{$member->keterangan_durasi}}</td>
                            <td style="text-align: center;">{{$member->keterangan_fasilitas}}</td>
                            <td style="text-align: center;">{{$member->keterangan}}</td>
                            <td style="text-align: center;">{{$member->format_tanggal_berakhir}}</td>
                            <td class="action" style="text-align: center;">
                                <div class="container">
                                    <a href="{{ url('/admin/member/' . $member->id_member) }}" class="detail">Detail</a>
                                    <form action="{{ url('/admin/member/' . $member->id_member)}}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hapus" style="padding: 10px 12px;border-radius: 8px;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- Pagination -->          
        <section class="pagination">
            {{ $members->links('vendor.pagination.tailwind') }}
        </section>
    </div>
@endsection