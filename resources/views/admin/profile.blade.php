@extends('app')

@section('content')
    <!-- form tambah member -->
    <section class="tambah-member">
        <form class="form-tambah container" method="POST">
            <div class="form-group container">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="input-tambah">
            </div>
            <div class="form-group container">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input-tambah">
            </div>
            <div class="btn-group container">
                <button type="submit" name="submit" class="btn-tambah">Edit Akun</button>
                <button class="btn-cancell">Batalkan</button>
            </div>
        </form>
    </section>
@endsection