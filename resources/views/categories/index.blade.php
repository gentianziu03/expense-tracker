@extends('layouts.app')

@section('content')
    <h1>Menaxhimi i kategorive</h1>

    <section class="card">
        <h2>Shto kategori</h2>
        <form method="POST" action="{{ route('categories.store') }}" class="grid grid-2">
            @csrf
            <div>
                <label for="name">Emri</label>
                <input id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="color">Ngjyra (opsionale)</label>
                <input id="color" name="color" value="{{ old('color') }}" placeholder="#3B82F6">
            </div>
            <div>
                <button type="submit">Shto</button>
            </div>
        </form>
    </section>

    <section class="card">
        <h2>Kategoritë ekzistuese</h2>
        <table>
            <thead>
            <tr>
                <th>Emri</th>
                <th>Ngjyra</th>
                <th>Veprime</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>
                        <form method="POST" action="{{ route('categories.update', $category) }}" class="grid">
                            @csrf
                            @method('PUT')
                            <input name="name" value="{{ old('name.'.$category->id, $category->name) }}" required>
                    </td>
                    <td>
                            <input name="color" value="{{ old('color.'.$category->id, $category->color) }}" placeholder="#3B82F6">
                    </td>
                    <td>
                            <div class="actions">
                                <button class="secondary" type="submit">Ruaj</button>
                        </form>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline"
                                      onsubmit="return confirm('Je i sigurt?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="danger" type="submit">Fshi</button>
                                </form>
                            </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="muted">Nuk ka kategori.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
@endsection
