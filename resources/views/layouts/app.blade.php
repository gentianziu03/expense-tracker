<!doctype html>
<html lang="sq">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Shpenzimet e Mia' }}</title>
    <style>
        :root { color-scheme: light; }
        body { font-family: Arial, sans-serif; background: #f8fafc; margin: 0; color: #0f172a; }
        .container { max-width: 1100px; margin: 0 auto; padding: 1rem; }
        .topbar { background: white; border-bottom: 1px solid #e2e8f0; }
        .topbar a { margin-right: 1rem; text-decoration: none; color: #1d4ed8; font-weight: 600; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; }
        .grid { display: grid; gap: 1rem; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
        form.inline { display: inline; }
        input, select, textarea, button { width: 100%; padding: .55rem; border-radius: 6px; border: 1px solid #cbd5e1; font-size: .95rem; }
        button { background: #1d4ed8; border-color: #1d4ed8; color: white; cursor: pointer; }
        button.secondary { background: #475569; border-color: #475569; }
        button.danger { background: #b91c1c; border-color: #b91c1c; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: .6rem; border-bottom: 1px solid #e2e8f0; text-align: left; vertical-align: top; }
        .muted { color: #64748b; }
        .flash { padding: .75rem; border-radius: 6px; margin-bottom: 1rem; }
        .ok { background: #dcfce7; color: #166534; }
        .err { background: #fee2e2; color: #991b1b; }
        .actions { display: flex; gap: .5rem; }
    </style>
</head>
<body>
<header class="topbar">
    <div class="container">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('categories.index') }}">Kategoritë</a>
    </div>
</header>
<main class="container">
    @if(session('status'))
        <div class="flash ok">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="flash err">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
