@component('mail::message')
# {{ $introLines[0] }}

{{ $introLines[1] }}

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

{{ $outroLines[0] }}
{{ $outroLines[1] }}

{{ $outroLines[2] }}

fishing
@endcomponent
