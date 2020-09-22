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
