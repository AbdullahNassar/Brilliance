@component('mail::message')

{{$subject}}

@component('mail::button', ['url' => 'https://edu.marj3.com/'])
View Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent