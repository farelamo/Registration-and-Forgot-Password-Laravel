<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    @include('partials.head')
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/pages/page-auth.css') }}" />
</head>

<body>
    @include('sweetalert::alert')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('images/logo.png') }}" alt="" width="200">
                                </span>
                                {{-- <span class="app-brand-text demo text-body fw-bolder">Xiehokki</span> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-5">Silahkan Mendaftar 😋</h4>
                        {{-- <p class="mb-4">Silahkan sign in demi kesejahteraan bersama</p> --}}

                        <form id="formAuthentication" class="mb-3" action="/signup" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" placeholder="Nama"
                                        value="{{ old('name') }}" name="name" />
                                    @error('name')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username"
                                        placeholder="Username" value="{{ old('username') }}" name="username" />
                                    @error('username')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" name="gender" id="gender">
                                        <option value="">-- Pilih Gender --</option>
                                        <option value="L" @if (old('gender') == 'L') selected @endif>
                                            Laki - Laki
                                        </option>
                                        <option value="P" @if (old('gender') == 'P') selected @endif>
                                            Perempuan
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="domisili" class="form-label">Domisili</label>
                                    <input type="text" class="form-control" id="domisili"
                                        placeholder="Domisili" value="{{ old('domisili') }}" name="domisili" />
                                    @error('domisili')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="tipe" class="form-label">Tipe Kerja</label>
                                    <select class="form-select" name="type" id="tipe">
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="full" @if (old('type') == 'full') selected @endif>
                                            Full Time
                                        </option>
                                        <option value="part" @if (old('type') == 'part') selected @endif>
                                            Part Time
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="posisi" class="form-label">Posisi</label>
                                    <select class="form-select" name="posisi" id="posisi">
                                        <option value="">-- Pilih Posisi --</option>
                                        <option value="kitchen" @if (old('posisi') == 'kitchen') selected @endif>
                                            Kitchen
                                        </option>
                                        <option value="dishwash" @if (old('posisi') == 'dishwash') selected @endif>
                                            Dishwash
                                        </option>
                                        <option value="gudang" @if (old('posisi') == 'gudang') selected @endif>
                                            Gudang
                                        </option>
                                    </select>
                                    @error('posisi')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">Nomor Telepon</label>
                                <input type="number" class="form-control" id="telp"
                                    placeholder="Nomor Telepon" value="{{ old('telp') }}" name="telp" />
                                @error('telp')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="telp"
                                    placeholder="Email" value="{{ old('email') }}" name="email" />
                                @error('email')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">
                                        Password
                                    </label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="password" value="{{ old('password') }}" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-danger d-grid w-100" type="submit">Sign up</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>sudah punya akun ?</span>
                            <a href="/">
                                <span>login</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.script')
</body>

</html>
