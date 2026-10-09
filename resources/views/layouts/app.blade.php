<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Auto Jats Health Index (AJHI)')</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  html,body{ -webkit-tap-highlight-color: transparent; }
  .fade-in{ animation: fadeIn .25s ease both; }
  @keyframes fadeIn{ from{opacity:0; transform:translateY(6px)} to{opacity:1; transform:none} }
  .nav-btn{ transition: all .15s ease; }
  .scroll-x::-webkit-scrollbar{ height:6px }
  .scroll-x::-webkit-scrollbar-thumb{ background:#c7d2fe; border-radius:99px }
  @media (max-width: 640px){
    .rtable thead{ display:none }
    .rtable, .rtable tbody, .rtable tr, .rtable td{ display:block; width:100% }
    .rtable tr{ border:1px solid #e2e8f0; border-radius:14px; margin-bottom:10px; padding:6px 4px; background:#fff; box-shadow:0 1px 2px rgba(15,23,42,.04) }
    .rtable td{ border:none !important; padding:6px 10px; display:flex; justify-content:space-between; align-items:center; gap:14px; text-align:right }
    .rtable td::before{ content: attr(data-label); font-weight:700; color:#64748b; font-size:10px; text-transform:uppercase; letter-spacing:.05em; text-align:left; flex:none }
    .rtable td[data-label=""]::before{ content:"" }
  }
</style>
@stack('head')
</head>
<body class="bg-slate-100 min-h-screen text-slate-800">

<header class="bg-indigo-900 text-white shadow sticky top-0 z-50">
  <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center gap-3">
    <a href="{{ url('/') }}" class="flex items-center space-x-3 min-w-0">
      <div class="bg-amber-400 text-indigo-950 p-2 rounded-xl font-black text-lg shadow flex-none">
        <i class="fa-solid fa-motorcycle"></i>
      </div>
      <div class="min-w-0">
        <h1 class="text-base sm:text-lg font-bold truncate">Auto Jats Service</h1>
        <p class="text-[10px] sm:text-xs text-indigo-200 truncate">AJHI - Health Index &amp; Service Passport</p>
      </div>
    </a>
    <div class="flex items-center gap-2 sm:gap-3 flex-none">
      <span class="px-2.5 py-1 text-[10px] sm:text-xs font-bold rounded-full bg-indigo-800 border border-indigo-600 whitespace-nowrap">{{ $roleBadge ?? 'Portal' }}</span>
      <a href="/staff" class="text-[11px] sm:text-xs text-amber-300 hover:text-amber-100 whitespace-nowrap font-semibold">
        <i class="fa-solid fa-right-to-bracket"></i><span class="hidden sm:inline"> Staff</span>
      </a>
    </div>
  </div>
  @hasSection('nav')
  <div class="bg-indigo-950 px-4 py-2 border-t border-indigo-800/60">
    <nav class="max-w-5xl mx-auto flex gap-2 text-xs font-semibold overflow-x-auto scroll-x pb-0.5">
      @yield('nav')
    </nav>
  </div>
  @endif
</header>

<main class="max-w-5xl mx-auto px-4 py-6">
  @if(session('status'))
    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold px-4 py-3 rounded-xl">{{ session('status') }}</div>
  @endif
  <div class="fade-in">@yield('content')</div>
</main>

@stack('scripts')
</body>
</html>
