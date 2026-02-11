@extends('layouts.app')

@section('content')
    <h1>Edito shpenzimin</h1>

    <section class="card">
        <form method="POST" action="{{ route('expenses.update', $expense) }}" class="grid grid-2">
            @csrf
            @method('PUT')

            <div>
                <label for="spent_at">Data</label>
                <input type="date" id="spent_at" name="spent_at"
                       value="{{ old('spent_at', $expense->spent_at->toDateString()) }}" required>
            </div>

            <div>
                <label for="category_id">Kategoria</label>
                <select id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int)old('category_id', $expense->category_id) === $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="amount">Shuma</label>
                <input type="number" id="amount" name="amount" step="0.01" min="0.01"
                       value="{{ old('amount', $expense->amount) }}" required>
            </div>

            <div>
                <label for="note">Shënim</label>
                <textarea id="note" name="note" rows="3">{{ old('note', $expense->note) }}</textarea>
            </div>

            <div class="actions">
                <button type="submit">Ruaj ndryshimet</button>
                <a href="{{ route('dashboard') }}">Kthehu te dashboard</a>
            </div>
        </form>
    </section>
@endsection
