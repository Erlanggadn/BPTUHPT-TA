@include('layouts.utama.main')
@include('layouts.utama.main2')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">{{ __('Atur ulang kata sandi') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Anda') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Kata Sandi') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('konfirmasi kata sandi') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="mb-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Atur ulang kata sandi') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
