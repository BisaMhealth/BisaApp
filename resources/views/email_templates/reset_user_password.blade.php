@component('mail::message')
# Reset Passwords

Hello {{ $username }}

Click on the link below to reset your password


<p> <a href="{{ $text  }}" class="btn btn-primary"> {{$text}} </a>  </p>

<p>Ignore this mail if you are not the one who initiated this request </p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
