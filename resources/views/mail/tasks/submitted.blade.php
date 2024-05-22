<x-mail::message>
# Tugas Baru

Halo, ada tugas baru yang perlu di cek. Silahkan klik tombol dibawah ini untuk melihat detail tugas.

<x-mail::button :url="$url">
Detail Tugas
</x-mail::button>

Jika anda mengalami kesulitan untuk mengakses tombol diatas, silahkan copy link dibawah dan paste ke browser anda :

{{ $url }}

Terima Kasih,<br>
{{ config('app.name') }}
</x-mail::message>
