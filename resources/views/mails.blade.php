<h1>hello {{$name}}</h1>
<h2>Your registered email-id is {{$email}} , Please click on the below link to verify your email account</h2>
<h2>{{ $code }}</h2>
<a href="{{ url('user/verify', $code) }}">Verify Email</a>
