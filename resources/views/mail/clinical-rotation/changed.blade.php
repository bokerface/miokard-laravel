<x-mail::message>
# Pemberitahuan kepada {{ $user->userProfile->name }},

Stase anda dinyatakan telah selesai, dan anda akan dipindahkan ke stase baru {{ $newClinicalRotation->name }}

Terima Kasih,<br>
{{ config('app.name') }}
</x-mail::message>
