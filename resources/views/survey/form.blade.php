@extends('layouts.app')

@section('title', 'Isi Survey')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Survey untuk {{ $agenda->judul }}</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('survey.submit', $agenda->slug) }}" method="POST">
        @csrf
        <div class="mb-3">
            @foreach($agenda->survey->question as $question)
                <div class="mb-4">
                    <label class="form-label fw-bold">{{ $question->question }} @if($question->required) <span class="text-danger">*</span> @endif</label>

                    @if($question->type === 'text')
                        <textarea name="answers[{{ $question->id }}]" class="form-control" rows="4" required></textarea>

                    @elseif($question->type === 'multiple_choice')
                        @php
                            $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
                        @endphp
                        <select name="answers[{{ $question->id }}]" class="form-select" required>
                            <option value="" selected disabled>Pilih jawaban</option>
                            @foreach($options as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                    @elseif($question->type === 'rating')
                        <select name="answers[{{ $question->id }}]" class="form-select" required>
                            <option value="" selected disabled>Pilih rating</option>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('agenda.show', $agenda->slug) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary px-4">Kirim Survey</button>
        </div>
    </form>
</div>
@endsection
