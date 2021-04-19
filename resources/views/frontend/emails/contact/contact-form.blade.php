{{-- {{ dd($user) }} --}}

<p>Họ và tên: <strong>{{ $user['firstname'] }} {{ $user['lastname'] }}</strong></p>
<p>Điện thoại: <strong>{{ $user['phone'] }}</strong></p>
<p>Email: <strong>{{ $user['email'] }}</strong></p>
<p>Nội dung: {{ $user['message'] }}</p>

