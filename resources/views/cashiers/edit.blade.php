@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Cashier Information</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{--成功時のメッセージ--}}
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            endif@
                            {{-- エラーメッセージ --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form action="/cashier/{{ $cashiers->id }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$cashiers->name) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email',$cashiers->email) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">Status</label>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <select name="role" id="role">
                                            <option value=1>Manager</option>
                                            <option value=2>Cashier</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name='action' value='edit'>
                                            {{ __('Save') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary" name='action' value='back'>
                                            {{ __('Cancel') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
