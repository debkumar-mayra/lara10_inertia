<x-mail::message>
# Confirmation Code
{{-- @dd($data) --}}
  <p>Do not share your OTP with anyone</p>
 <b>{{$data['code']}}</b>

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>