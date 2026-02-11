@extends('layout')

@section('content')
    <div class="card">
        <h2 style="margin-top:0;">Shto kategori</h2>
        <form method="POST" action="{{ route('categories.store') }}" class="grid grid-3">
            @csrf
            <div>
                <label for="name">Emri</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="color">Ngjyra (opsionale)</label>
                <input id="color" name="color" type="text" value="{{ old('color') }}" placeholder="#3b82f6">
                @error('color')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div style="align-self:end;">
                <button type="submit">Shto</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2 style="margin-top:0;">Kategoritë ekzistuese</h2>
        <div class="grid" style="gap:.75rem;">
            @forelse($categories as $category)
                <div style="border:1px solid #e5e7eb; border-radius:8px; padding:.75rem;">
                    <form method="POST" action="{{ route('categories.update', $category) }}" class="grid grid-3">
                        @csrf
                        @method('PUT')
                        <div>
                            <label>Emri</label>
                            <input name="name" type="text" value="{{ $category->name }}" required>
                        </div>
                        <div>
                            <label>Ngjyra</label>
                            <input name="color" type="text" value="{{ $category->color }}">
                        </div>
                        <div style="align-self:end;">
                            <button class="secondary" type="submit">Ruaj</button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('categories.destroy', $category) }}" style="margin-top:.5rem;" onsubmit="return confirm('Ta fshij këtë kategori?');">
                        @csrf
                        @method('DELETE')
                        <button class="danger" type="submit">Fshi</button>
                    </form>
                </div>
            @empty
                <p class="muted">Nuk ka kategori.</p>
            @endforelse
        </div>
    </div>
@endsection
