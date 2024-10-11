<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script type="text/javascript">
        function closethisasap() {
            document.forms["redirectpost"].submit();
        }
    </script>
</head>

<body onload="closethisasap();">
    <h1>Please wait you will be redirected soon to <br>Easypaisa Payment Page</h1>
    <form name="redirectpost" method="POST" action="{{ Config::get('constants.easypaisa.TRANSACTION_POST_URL1') }}">
        @foreach ($post_data as $key => $value)
            @if ($key == 'storeId' || $key == 'amount')
                <input type="number" name="{{ $key }}" value="{{ $value }}" hidden>
            @else
                <input type="text" name="{{ $key }}" value="{{ $value }}" hidden>
            @endif
        @endforeach
    </form>
</body>

</html>
