<h1>view này đc return thẳng trong route</h1>
<p>token {{ csrf_token() }}</p>
{{-- comment trong template laravel --}}
{{-- <//?php echo ?> --}}

<form action="{{ route('demo') }}" method="post">
    @csrf
    <!-- render ra mã token trong thẻ input type hidden -->
    <label for="">Email</label>
    <input type="email" name="email">
</form>