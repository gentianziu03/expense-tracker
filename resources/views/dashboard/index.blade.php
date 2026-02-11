@extends('layouts.app')

@section('content')
    <h1>Shpenzimet e Mia</h1>

    <section class="card">
        <form method="GET" action="{{ route('dashboard') }}" class="grid grid-2">
            <div>
                <label for="month">Muaji</label>
                <input type="month" id="month" name="month" value="{{ $selectedMonth }}">
            </div>
            <div>
                <label for="category_id">Kategoria</label>
                <select id="category_id" name="category_id">
                    <option value="">Të gjitha</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int)$selectedCategoryId === $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit">Apliko filtrat</button>
            </div>
        </form>
    </section>

    <section class="card">
        <h2>Shto shpenzim</h2>
        <form method="POST" action="{{ route('expenses.store') }}" class="grid grid-2">
            @csrf
            <div>
                <label for="spent_at">Data</label>
                <input type="date" id="spent_at" name="spent_at" value="{{ old('spent_at', $today) }}" required>
            </div>
            <div>
                <label for="new_category_id">Kategoria</label>
                <select id="new_category_id" name="category_id" required>
                    <option value="">Zgjidh kategorinë</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int)old('category_id') === $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="amount">Shuma (ALL)</label>
                <input type="number" id="amount" step="0.01" min="0.01" name="amount" value="{{ old('amount') }}" required>
            </div>
            <div>
                <label for="note">Shënim (opsionale)</label>
                <textarea id="note" name="note" rows="2">{{ old('note') }}</textarea>
            </div>
            <div>
                <button type="submit">Ruaj</button>
            </div>
        </form>
    </section>

    <section class="grid grid-2">
        <article class="card">
            <h3>Total mujor</h3>
            <p><strong>{{ number_format((float)$totalMonthly, 2) }} ALL</strong></p>
            <p class="muted">Për muajin {{ $selectedMonth }}</p>
        </article>
        <article class="card">
            <h3>Mesatare ditore</h3>
            <p><strong>{{ number_format((float)$dailyAverage, 2) }} ALL</strong></p>
            <p class="muted">Llogaritur mbi {{ $daysInMonth }} ditë</p>
        </article>
    </section>

    <section class="card">
        <h2>Ndarja sipas kategorive (muaji i plotë)</h2>
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
                    <td>{{ $row->name }}</td>
                    <td>{{ number_format((float)$row->total, 2) }} ALL</td>
                </tr>
            @empty
                <tr><td colspan="2" class="muted">Nuk ka të dhëna.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>

    <section class="card">
        <h2>Lista e shpenzimeve</h2>
        <table>
            <thead>
            <tr>
                <th>Data</th>
                <th>Kategoria</th>
                <th>Shuma</th>
                <th>Shënim</th>
                <th>Veprime</th>
            </tr>
            </thead>
            <tbody>
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $expense->spent_at->format('Y-m-d') }}</td>
                    <td>{{ $expense->category->name }}</td>
                    <td>{{ number_format((float)$expense->amount, 2) }} ALL</td>
                    <td>{{ $expense->note ?: '-' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('expenses.edit', $expense) }}">Edito</a>
                            <form method="POST" action="{{ route('expenses.destroy', $expense) }}" class="inline"
                                  onsubmit="return confirm('Je i sigurt që do ta fshish?')">
                                @csrf
                                @method('DELETE')
                                <button class="danger" type="submit">Fshi</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Nuk ka shpenzime për filtrin e zgjedhur.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1rem;">{{ $expenses->links() }}</div>
    </section>
@endsection
