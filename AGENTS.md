# Proyek AdminLTE Laravel

Aturan lengkap proyek ini (stack AdminLTE 2 + Bootstrap 3, struktur view, konvensi, pengujian, dan panduan Laravel Boost) ada di [CLAUDE.md](CLAUDE.md). Baca file itu sebelum mengubah apa pun.

Ringkasan penting:

- Balas dan tulis teks UI dalam Bahasa Indonesia; kode (class, method, route) dalam Bahasa Inggris.
- UI memakai AdminLTE 2.4.18 + Bootstrap 3, bukan Tailwind. Assets di `public/` jangan diubah.
- Halaman admin memakai `@extends('layouts.app')`; menu sidebar diatur di `config/adminlte.php`.
- Jalankan tes terkait (`php artisan test --compact`) dan `vendor/bin/pint --dirty --format agent` setelah mengubah PHP.
- Commit/push hanya saat diminta.
