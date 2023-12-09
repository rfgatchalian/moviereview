@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset('users/assets/css/index.css')}}">
@endsection

@section('content')
<div class="container d-flex justify-content-center mt-5" id="main-container">
    <div class="row">
        <div class="col-12 col-md-6 text-center" style="margin-top: 170px;">
            <h1 class="title mb-0">
                <span class="gold">CINE</span><span class="white">SPECTRUM</span>
            </h1>
            <p class="sub-title" style="font-size: 1rem;
            color: #ffbd59;">Where Movies Unveiled and Opinions Unleashed</p>
            <div class="ps-3">
                <p>CineSpectrum is a user-friendly movie review platform for film lovers. It's a place where you can discover movies, read and write reviews, and connect with others who share your passion for cinema. Our tagline, "Movies Unveiled, Opinions Unleashed," reflects our belief that every film has a story to tell and every moviegoer has a unique voice. Join us to explore, review, and discuss movies in a welcoming community. Your opinions matter, and we're here to make the world of cinema come alive through your reviews. Welcome to CineSpectrum!</p>
            </div>
        </div>
        <div class="col-12 col-md-6" style="margin-top: 140px; margin-bottom: 80px;">
            <div class="container form-container">
                <h2 class="mb-0">Get Started</h2>
                <p class="login-here mt-0">Already have an account? <a class="hove" href="#">Login here</a></p>
                <form id="registrationForm" method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
                    {{ csrf_field() }}

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                      <label class="form-check-label" for="terms">I agree to the <a class="hove" href="{{route('terms')}}">CineSpectrum terms of service.</a></label>
                    </div>
                    <button type="submit" class="custom-btn">Register</button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
