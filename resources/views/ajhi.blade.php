<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Auto Jats Health Index (AJHI)</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/ajhi.css') }}">
</head>
<body class="bg-slate-100 min-h-screen text-slate-800">

<!-- ==================== LOGIN SCREEN ==================== -->
<div id="login-screen" class="fixed inset-0 z-[100] bg-indigo-900 flex items-center justify-center p-4 overflow-y-auto">
  <div class="absolute inset-0 opacity-20" style="background-image:radial-gradient(circle at 20% 20%, #6366f1 0, transparent 40%), radial-gradient(circle at 80% 70%, #f59e0b 0, transparent 40%)"></div>
  <div class="relative bg-white p-7 sm:p-8 rounded-3xl shadow-2xl max-w-sm w-full text-center my-auto fade-in">
    <div class="bg-amber-400 text-indigo-950 w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl mb-4 shadow-lg">
      <i class="fa-solid fa-motorcycle"></i>
    </div>
    <h1 class="text-2xl font-black text-slate-800">AJHI Portal</h1>
    <p class="text-sm text-slate-500 mb-6">Auto Jats Health Index System</p>

    <div id="login-menu" class="space-y-3">
      <button onclick="showStaffLogin('admin')" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl flex items-center justify-center gap-3 transition">
        <i class="fa-solid fa-user-shield"></i> Login Admin
      </button>
      <button onclick="showStaffLogin('teknisi')" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 rounded-xl flex items-center justify-center gap-3 transition">
        <i class="fa-solid fa-wrench"></i> Login Teknisi
      </button>
      <div class="pt-4 border-t border-slate-100">
        <button onclick="openScan()" class="w-full bg-emerald-100 hover:bg-emerald-200 text-emerald-800 font-bold py-3 rounded-xl flex items-center justify-center gap-3 transition">
          <i class="fa-solid fa-qrcode"></i> Login Customer (Scan QR)
        </button>
      </div>
    </div>

    <form id="staff-login-form" class="hidden text-left">
      <button type="button" onclick="backToLoginMenu()" class="text-xs text-slate-400 hover:text-slate-600 mb-3"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
      <div class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 mb-3 text-center">
        <span id="staff-role-label" class="text-xs font-bold text-indigo-700 uppercase tracking-wider">Admin</span>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Username</label>
        <input type="text" id="login-username" autocomplete="username" class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-indigo-500" placeholder="username">
      </div>
      <div class="mb-4">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Password</label>
        <input type="password" id="login-password" autocomplete="current-password" class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-indigo-500" placeholder="••••••••">
      </div>
      <p id="login-error" class="hidden text-xs text-rose-600 font-semibold mb-3 text-center"></p>
      <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition">
        <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk
      </button>
      <div class="mt-4 text-[11px] text-slate-400 leading-relaxed">
        Demo: <b>admin / admin123</b> &nbsp;·&nbsp; <b>teknisi / teknisi123</b>
      </div>
    </form>
  </div>
</div>

<!-- ==================== SCAN SCREEN ==================== -->
<div id="scan-screen" class="hidden fixed inset-0 z-[110] bg-slate-900/95 flex items-center justify-center p-4">
  <div class="bg-white rounded-3xl max-w-sm w-full overflow-hidden shadow-2xl fade-in">
    <div class="bg-indigo-900 text-white px-5 py-4 flex justify-between items-center">
      <div>
        <h2 class="font-bold">Scan QR Customer</h2>
        <p class="text-[11px] text-indigo-200">Arahkan kamera ke QR login Anda</p>
      </div>
      <button onclick="closeScan()" class="text-indigo-200 hover:text-white text-lg"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div id="scan-view" class="p-4">
      <div class="relative bg-slate-900 rounded-2xl overflow-hidden aspect-square mb-4">
        <video id="scan-video" class="w-full h-full hidden" playsinline></video>
        <div id="scan-placeholder" class="absolute inset-0 flex flex-col items-center justify-center text-slate-400">
          <i class="fa-solid fa-camera text-4xl mb-2"></i>
          <span class="text-xs">Kamera belum aktif</span>
        </div>
        <div class="absolute inset-6 border-2 border-amber-400/80 rounded-xl pointer-events-none"></div>
      </div>
      <p id="scan-msg" class="hidden text-xs text-center text-rose-600 font-semibold mb-3"></p>
      <div class="space-y-2">
        <button id="btn-cam" onclick="startCamera()" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl text-sm">
          <i class="fa-solid fa-video mr-2"></i> Aktifkan Kamera
        </button>
        <label class="block w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl text-sm text-center cursor-pointer">
          <i class="fa-regular fa-image mr-2"></i> Pilih Gambar QR
          <input type="file" accept="image/*" class="hidden" onchange="scanFromFile(event)">
        </label>
        <button onclick="showManualToken()" class="w-full text-slate-500 hover:text-slate-700 text-xs font-semibold py-2">
          Gunakan token manual
        </button>
      </div>
      <div id="manual-token" class="hidden mt-3">
        <div class="flex gap-2">
          <input type="text" id="token-input" placeholder="Masukkan token" class="flex-1 border rounded-xl px-3 py-2 text-sm uppercase outline-none focus:ring-2 focus:ring-indigo-500">
          <button onclick="loginManualToken()" class="bg-slate-800 text-white px-4 rounded-xl text-sm font-bold">Masuk</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ==================== INVALID QR SCREEN ==================== -->
<div id="invalid-screen" class="hidden fixed inset-0 z-[120] bg-rose-900/95 flex items-center justify-center p-4">
  <div class="bg-white rounded-3xl max-w-sm w-full p-7 text-center shadow-2xl fade-in">
    <div class="bg-rose-100 text-rose-600 w-16 h-16 mx-auto rounded-full flex items-center justify-center text-3xl mb-4">
      <i class="fa-solid fa-triangle-exclamation"></i>
    </div>
    <h2 class="text-xl font-black text-slate-800 mb-2">QR Tidak Valid</h2>
    <p id="invalid-msg" class="text-sm text-slate-500 mb-6">Token tidak ditemukan di perangkat ini. Pastikan Anda scan QR dari bengkel Auto Jats.</p>
    <button onclick="dismissInvalid()" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 rounded-xl">Kembali</button>
  </div>
</div>

<!-- ==================== HEADER ==================== -->
<header id="main-header" class="hidden bg-indigo-900 text-white shadow sticky top-0 z-50 no-print">
  <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center gap-3">
    <div class="flex items-center space-x-3 min-w-0">
      <div class="bg-amber-400 text-indigo-950 p-2 rounded-xl font-black text-lg shadow flex-none">
        <i class="fa-solid fa-motorcycle"></i>
      </div>
      <div class="min-w-0">
        <h1 class="text-base sm:text-lg font-bold truncate">Auto Jats Service</h1>
        <p class="text-[10px] sm:text-xs text-indigo-200 truncate">AJHI - Health Index &amp; Service Passport</p>
      </div>
    </div>
    <div class="flex items-center gap-2 sm:gap-3 flex-none">
      <span id="role-badge" class="px-2.5 py-1 text-[10px] sm:text-xs font-bold rounded-full bg-indigo-800 border border-indigo-600 whitespace-nowrap">-</span>
      <button onclick="logout()" class="text-[11px] sm:text-xs text-rose-300 hover:text-rose-100 whitespace-nowrap">
        <i class="fa-solid fa-arrow-right-from-bracket"></i><span class="hidden sm:inline"> Keluar</span>
      </button>
    </div>
  </div>
  <div class="bg-indigo-950 px-4 py-2 border-t border-indigo-800/60">
    <nav id="nav-menu" class="max-w-5xl mx-auto flex gap-2 text-xs font-semibold overflow-x-auto scroll-x pb-0.5"></nav>
  </div>
</header>

<main id="main-content" class="hidden max-w-5xl mx-auto px-4 py-6 no-print">
  <div id="dynamic-view" class="fade-in"></div>
</main>

<div id="modal-root" class="hidden fixed inset-0 z-[90] bg-slate-900/60 backdrop-blur-sm items-center justify-center p-4">
  <div id="modal-card" class="bg-white rounded-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto p-5 sm:p-6 relative"></div>
</div>

<div id="toast-root" class="fixed top-4 right-4 z-[95] space-y-2 w-[calc(100%-2rem)] max-w-xs no-print"></div>

<script src="{{ asset('js/ajhi-app.js') }}"></script>
</body>
</html>
