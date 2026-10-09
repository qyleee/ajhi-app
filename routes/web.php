<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Tampilan + alur 100% ikut prototype/index.html (jangan diubah).
   Halaman utama = SPA persis prototipe. Route server di bawah hanya pendamping. */

Route::get('/', fn () => view('ajhi'))->name('home');
Route::get('/login', fn () => view('ajhi'))->name('login');
Route::get('/scan', fn () => view('ajhi'))->name('scan');

Route::post('/c/token', function (Request $request) {
    $token = strtoupper(trim($request->input('token', '')));
    $customer = collect(config('ajhi.dummy_customers'))->firstWhere('token', $token);

    if (! $customer) {
        return back()->with('status', 'Token tidak ditemukan. Coba KT3MTR7X9A.');
    }

    return redirect()->route('customer.home', $token);
})->name('customer.token');

$customerResolver = function (string $token) {
    $customer = collect(config('ajhi.dummy_customers'))->firstWhere('token', strtoupper($token));
    abort_if(! $customer, 404, 'Token customer tidak valid.');

    $logs = collect(config('ajhi.dummy_logs'))
        ->where('customer_id', $customer['id'])->sortByDesc('date')->values()->all();
    $last = $logs[0] ?? null;

    $reminder = null;
    if ($last) {
        $next = date('Y-m-d', strtotime($last['date'].' +'.config('ajhi.settings.interval_days').' days'));
        $diff = (int) round((strtotime($next) - strtotime(date('Y-m-d'))) / 86400);
        if ($diff <= config('ajhi.settings.lead_days')) {
            $reminder = [
                'next' => $next,
                'diff' => $diff,
                'label' => $diff > 0 ? $diff.' hari lagi' : ($diff === 0 ? 'Jatuh tempo hari ini' : 'Terlambat '.abs($diff).' hari'),
            ];
        }
    }

    return [$customer, $logs, $last, $reminder];
};

Route::get('/c/{token}', function (string $token) use ($customerResolver) {
    [$customer, $logs, $last, $reminder] = $customerResolver($token);

    return view('customer.home', compact('customer', 'logs', 'last', 'reminder') + ['roleBadge' => $customer['plate']]);
})->name('customer.home');

Route::get('/c/{token}/history', function (string $token) use ($customerResolver) {
    [$customer, $logs, $last, $reminder] = $customerResolver($token);

    return view('customer.history', compact('customer', 'logs') + ['roleBadge' => $customer['plate']]);
})->name('customer.history');

Route::get('/admin/dashboard', function () {
    $customers = config('ajhi.dummy_customers');
    $logs = collect(config('ajhi.dummy_logs'))->sortByDesc('date')->values()->all();
    $avg = count($logs) ? round(collect($logs)->avg('score'), 1) : '-';
    $crit = collect($logs)->where('risk', 'PRIORITAS KESELAMATAN')->count();

    return view('admin.dashboard', compact('customers', 'logs', 'avg', 'crit') + ['roleBadge' => 'Admin']);
})->name('admin.dashboard');

Route::get('/admin/customers', fn () => view('admin.customers', [
    'customers' => config('ajhi.dummy_customers'), 'roleBadge' => 'Admin',
]))->name('admin.customers');

Route::get('/admin/logs', fn () => view('admin.logs', [
    'logs' => collect(config('ajhi.dummy_logs'))->sortByDesc('date')->values()->all(), 'roleBadge' => 'Admin',
]))->name('admin.logs');

Route::get('/teknisi/input', fn () => view('teknisi.input', [
    'checklist' => config('ajhi.checklist'), 'roleBadge' => 'Teknisi',
]))->name('tech.input');
