<html>
<head>
    <style>
        @php include(public_path('assets/css/email.css')) @endphp
    </style>
</head>
<body>
<table class="email" width="100%">
    <tbody>
        <tr>
            <td>
                <table class="email__container">
                    <tbody>
                    <tr>
                        <td>
                            @include ('core::emails.components.header')
                            @yield('body')
                            @include ('core::emails.components.footer')
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>
