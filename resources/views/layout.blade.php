<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Shpenzimet e Mia' }}</title>
    <style>
        :root { color-scheme: light; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background:#f6f7fb; color:#111827; }
        .container { max-width: 1100px; margin: 0 auto; padding: 1rem; }
        .card { background:#fff; border-radius:10px; box-shadow:0 1px 2px rgba(0,0,0,.08); padding:1rem; margin-bottom:1rem; }
        .grid { display:grid; gap:1rem; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); }
        label { font-size:.9rem; font-weight:600; display:block; margin-bottom:.3rem; }
        input, select, textarea, button { width:100%; box-sizing:border-box; padding:.55rem .65rem; border:1px solid #d1d5db; border-radius:8px; font-size:.95rem; }
        button { background:#2563eb; color:white; border:none; cursor:pointer; font-weight:600; }
        button.danger { background:#dc2626; }
        button.secondary { background:#374151; }
        table { width:100%; border-collapse:collapse; }
        th, td { text-align:left; padding:.6rem; border-bottom:1px solid #e5e7eb; vertical-align:top; }
        .row-actions { display:flex; gap:.5rem; align-items:center; }
        .row-actions form { margin:0; }
        .topbar { display:flex; justify-content:space-between; align-items:center; gap:.75rem; flex-wrap:wrap; }
        .muted { color:#6b7280; font-size:.9rem; }
        .success { background:#dcfce7; color:#166534; padding:.6rem .75rem; border-radius:8px; margin-bottom:1rem; }
        .error { color:#b91c1c; font-size:.85rem; margin-top:.25rem; }
        nav a { color:#1d4ed8; text-decoration:none; margin-right:.75rem; font-weight:600; }
    </style>
</head>
<body>
<div class="container">
    <div class="topbar" style="margin-bottom: 1rem;">
        <h1 style="margin:0;">Shpenzimet e Mia</h1>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('categories.index') }}">Kategoritë</a>
        </nav>
    </div>

    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
