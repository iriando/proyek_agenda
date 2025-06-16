@extends('layouts.app')

@section('title', 'Isi Survey')

@section('content')

<section id="service-details" class="service-details section">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

            @include('components.sidebar', ['agenda' => $agenda])

            <div class="service-box">
            <h4>Share Webinar</h4>
                <div class="">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($agenda->judul . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success">
                    <i class="bi bi-whatsapp"></i>
                    </a>

                    <!-- Share via Native API (untuk perangkat yang mendukung) -->
                    <button id="shareButton" class="btn btn-secondary">
                        <i class="bi bi-share-fill"></i>
                    </button>
                </div>
            </div><!-- End Services List -->
        </div>

        <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">

            <form action="{{ route('survey.submit', [$agenda->slug, $survey->slug]) }}" method="POST">
                @csrf
            <h4 class="text-center"> {{ $survey->title }} untuk {{ $agenda->judul }}</h4>
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                @foreach($survey->question as $question)
                    <div class="mb-3">
                        <label class="form-label">{{ $question->question }}</label>

                        @if($question->type === 'text')
                            <textarea name="answers[{{ $question->id }}]" class="form-control"></textarea>

                        @elseif($question->type === 'multiple_choice')
                            @php
                                $options = is_array($question->options)
                                    ? $question->options
                                    : json_decode($question->options, true);
                            @endphp
                            <select name="answers[{{ $question->id }}]" class="form-select">
                                <option value="">-- Pilih jawaban --</option>
                                @foreach($options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>

                        @elseif($question->type === 'rating')
                            <select name="answers[{{ $question->id }}]" class="form-select">
                                <option value="">-- Pilih rating --</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ str_repeat('⭐', $i) }}</option>
                                @endfor
                            </select>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">Kirim Survey</button>
            </div>
            </form>

        </div>
    </div>
</section><!-- /Service Details Section -->

@endsection
