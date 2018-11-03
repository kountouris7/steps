<form action="{{ route('process') }}" method="POST">
    {{ csrf_field() }}
    <input type="email" name="email" placeholder="email@example.com">
    <button type="submit">Send invite</button>
</form>
<hr>
<form action="{{ route('send.multiple') }}" method="POST">
    {{ csrf_field() }}
    <button type="submit">Invite All</button>
</form>
<hr>