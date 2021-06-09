@component('mail::message')
# Account Details

Hello Dr {{ $fullname }} welcome to BISA 

Please see below for your account details.

<p>Email Id:  {{ $email }}</p>
<p>Default Password: {{ $password }}
<br/>NB:: You are required to change your default password after you have successfully logged in for 
the first. 
</p>
<p><a class="btn btn-primary" target="_blank" href="https://www.bisa.com.gh">Click to login </a>     </p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent