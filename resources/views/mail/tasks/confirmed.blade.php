<x-mail::message>
# Pemberitahuan kepada {{ $user->userProfile->name }},

Tugas yang anda ajukan dengan judul {{ $task->title }}, diterima.

Terima Kasih,<br>
{{ config('app.name') }}
</x-mail::message>
