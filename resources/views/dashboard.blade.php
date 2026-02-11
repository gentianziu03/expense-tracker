@extends('layout')

@section('content')
    <div class="card">
        <form method="GET" action="{{ route('dashboard') }}" class="grid grid-3">
            <div>
                <label for="month">Muaji</label>
                <input id="month" type="month" name="month" value="{{ $selectedMonth }}">
            </div>
            <div>
                <label for="category_id">Kategoria (opsionale)</label>
                <select id="category_id" name="category_id">
                    <option value="">Të gjitha</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected($selectedCategoryId === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="align-self:end;">
                <button type="submit">Apliko filtrin</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2 style="margin-top:0;">Shto shpenzim</h2>
        <form method="POST" action="{{ route('expenses.store') }}" class="grid grid-3">
            @csrf
            <div>
                <label for="spent_at">Data</label>
                <input id="spent_at" type="date" name="spent_at" value="{{ old('spent_at', $today) }}" required>
                @error('spent_at')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="new_category_id">Kategoria</label>
                <select id="new_category_id" name="category_id" required>
                    <option value="">Zgjidh</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('category_id') === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="amount">Shuma</label>
                <input id="amount" type="number" step="0.01" min="0.01" name="amount" value="{{ old('amount') }}" required>
                @error('amount')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div style="grid-column: 1 / -1;">
                <label for="note">Shënim (opsional)</label>
                <textarea id="note" name="note" rows="3" maxlength="5000">{{ old('note') }}</textarea>
                @error('note')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div style="grid-column: 1 / -1;">
                <button type="submit">Ruaj shpenzimin</button>
            </div>
        </form>
    </div>

    <div class="grid grid-2">
        <div class="card">
            <p class="muted">Totali i muajit</p>
            <h2 style="margin:.25rem 0 0 0;">{{ number_format($totalMonthly, 2) }} Lek</h2>
        </div>
        <div class="card">
            <p class="muted">Mesatarja ditore</p>
            <h2 style="margin:.25rem 0 0 0;">{{ number_format($dailyAverage, 2) }} Lek</h2>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-top:0;">Ndarja sipas kategorisë (muaji i plotë)</h2>
        <table>
            <thead>
            <tr>
                <th>Kategoria</th>
                <th>Totali</th>
            </tr>
            </thead>
            <tbody>
            @forelse($totalsByCategory as $row)
                <tr>
                    <td>{{ $row->category?->name ?? 'Pa kategori' }}</td>
                    <td>{{ number_format((float) $row->total, 2) }} Lek</td>
                </tr>
            @empty
                <tr><td colspan="2" class="muted">Nuk ka të dhëna për këtë muaj.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2 style="margin-top:0;">Shpenzimet</h2>
        <table>
            <thead>
            <tr>
                <th>Data</th>
                <th>Kategoria</th>
                <th>Shuma</th>
                <th>Shënimi</th>
                <th>Veprime</th>
            </tr>
            </thead>
            <tbody>
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $expense->spent_at->format('Y-m-d') }}</td>
                    <td>{{ $expense->category?->name }}</td>
                    <td>{{ number_format((float) $expense->amount, 2) }} Lek</td>
                    <td>{{ $expense->note }}</td>
                    <td class="row-actions">
                        <a href="{{ route('expenses.edit', $expense) }}">Edito</a>
                        <form method="POST" action="{{ route('expenses.destroy', $expense) }}" onsubmit="return confirm('Ta fshij këtë shpenzim?');">
                            @csrf
                            @method('DELETE')
                            <button class="danger" type="submit">Fshi</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Nuk ka shpenzime për filtrin aktual.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
