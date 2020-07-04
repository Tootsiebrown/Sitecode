@extends ('site.layouts.base')

@section('body')
    <div class="container">
        <h1 class="page-title">Contact</h1>
        @if ($success)
            <p>Yay, it worked!</p>
        @else
            {!! waxView('Errors/list', ['items' => $form->errors]) !!}

            <form class="form-style" id="contact-form" action="{{ Request::url() }}#contactFormContainer" method="post" enctype="multipart/form-data" data-action="ajax" novalidate>
                {!! $form->drawForm(false) !!}
                <input type="submit" />
            </form>
        @endif
    </div>
@endsection