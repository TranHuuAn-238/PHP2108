<form action="{{ route('test.login.user') }}" method="post">
    @csrf
    <label for="">Username</label>
    <input type="text" name="username">
    <br>
    <label for="">Password</label>
    <input type="password" name="password">
    <br>
    <button tyoe="submit" name="btnSubmit">Submit</button>
</form>