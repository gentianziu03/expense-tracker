@extends('layout')

@section('content')
    <div class="card">
        <h2 style="margin-top:0;">Edito shpenzimin</h2>
        <form method="POST" action="{{ route('expenses.update', $expense) }}" class="grid grid-2">
            @csrf
            @method('PUT')

            <div>
                <label for="spent_at">Data</label>
                <input id="spent_at" type="date" name="spent_at" value="{{ old('spent_at', $expense->spent_at->format('Y-m-d')) }}" required>
                @error('spent_at')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="category_id">Kategoria</label>
                <select id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('category_id', $expense->category_id) === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="amount">Shuma</label>
                <input id="amount" type="number" step="0.01" min="0.01" name="amount" value="{{ old('amount', $expense->amount) }}" required>
                @error('amount')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div style="grid-column: 1 / -1;">
                <label for="note">Shënim</label>
                <textarea id="note" rows="3" name="note" maxlength="5000">{{ old('note', $expense->note) }}</textarea>
                @error('note')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div style="grid-column: 1 / -1; display:flex; gap:.5rem;">
                <button type="submit">Ruaj ndryshimet</button>
                <a href="{{ route('dashboard', ['month' => $expense->spent_at->format('Y-m')]) }}" style="display:inline-block; padding:.55rem .75rem; background:#374151; color:#fff; border-radius:8px; text-decoration:none;">Kthehu</a>
            </div>
        </form>
    </div>
@endsection
