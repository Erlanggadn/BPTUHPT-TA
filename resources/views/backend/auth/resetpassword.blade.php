@include('layouts.utama.main')
@include('layouts.utama.main2')


<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">{{ __('Atur ulang password anda') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

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

                    <div class="mb-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Kirim') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
