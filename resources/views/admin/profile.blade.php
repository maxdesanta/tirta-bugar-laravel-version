@extends('app')

@section('content')
    <!-- form tambah member -->
    <section class="tambah-member">
        <form class="form-tambah container" method="POST" action="/admin/setting/{{$valueAdmin->id_admin}}">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="id" value="{{ $valueAdmin->id_admin }}">
            <div class="form-group container">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="input-tambah" value="{{ $valueAdmin->username }}">
            </div>
            <div class="form-group container">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input-tambah" value="{{ $valueAdmin->email }}">
            </div>
            <div class="btn-group container">
                <button type="submit" name="submit" class="btn-tambah">Edit Akun</button>
                <button class="btn-cancell">Batalkan</button>
            </div>
        </form>
    </section>
@endsection