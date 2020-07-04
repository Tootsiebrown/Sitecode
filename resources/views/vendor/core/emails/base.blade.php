<table class="email" style="background-color: #273C89; font-family: sans-serif; color: #495057; width: 100%;"
       width="100%">
    <tbody>
    <tr>
        <td>
            <table class="email__container"
                   style="width: 100%; max-width: 600px; margin-left: auto; margin-right: auto;">
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
