@extends ('site.layouts.base')

@section('body')
    <div class="container">
        <h1 class="page-title">Frontend Test</h1>
        <form data-component="ajax-form" action="/contact">
            <div class="input-group">
                <div class="input-group__item">
                    @include('forms.components.standard-input', [
                        'input' => [
                            'name' => 'text-field-1',
                            'label' => 'Text Field 1',
                            'required' => true
                        ]
                    ])
                </div>
            </div>
            <div class="input-group">
                <div class="input-group__item">
                    @include('forms.components.standard-input', [
                        'input' => [
                            'name' => 'text-field-2',
                            'label' => 'Text Field 2',
                            'required' => true
                        ]
                    ])
                </div>
            </div>
            <div class="input-group">
                <div class="input-group__item input-group__item--half">
                    @include('forms.components.standard-select', [
                        'input' => [
                            'name' => 'text-field-select',
                            'label' => 'Select Field',
                            'options' => [
                                [
                                    'label' => 'Option 1',
                                    'value' => 'option-1',
                                    'isDisabled' => false,
                                    'isSelected' => true,
                                ],
                                [
                                    'label' => 'Option 2',
                                    'value' => 'option-2',
                                    'isDisabled' => true,
                                    'isSelected' => false,
                                ],
                                [
                                    'label' => 'Option 3',
                                    'value' => 'option-3',
                                    'isDisabled' => false,
                                    'isSelected' => false,
                                ],
                            ],
                            'required' => true
                        ]
                    ])
                </div>
                <div class="input-group__item input-group__item--half">
                    @include('forms.components.standard-select', [
                        'input' => [
                            'name' => 'text-field-select-2',
                            'labelClass' => 'label--modifier',
                            'fieldClass' => 'field--modifier',
                            'label' => 'Select Field',
                            'options' => [
                                [
                                    'label' => 'Option 1',
                                    'value' => 'option-1',
                                    'isDisabled' => false,
                                    'isSelected' => true,
                                ],
                                [
                                    'label' => 'Option 2',
                                    'value' => 'option-2',
                                    'isDisabled' => false,
                                    'isSelected' => false,
                                ],
                            ],
                            'required' => true
                        ]
                    ])
                </div>
            </div>
            @include('forms.components.standard-textarea', [
                'input' => [
                    'name' => 'textarea-field-1',
                    'labelClass' => 'label--modifier',
                    'fieldClass' => 'field--modifier',
                    'label' => 'Textarea Field 1',
                    'required' => true
                ]
            ])
            {!! (new \Wax\Contact\Form())->drawHoneypot() !!}
            <button data-element="submit" type="submit">Submit</button>
        </form>

        @include('site.components.share')

    </div>

    <hr>

    <div class="container">
        <h3 style="font-size: 18px; font-weight: bold;">Show/Hide modifiers</h3>
        <div class="-show-mobile-sm">Shows in mobile-sm</div>
        <div class="-hide-mobile-sm">Hides in mobile-sm</div>
        <br><br>
        <div class="-show-mobile">Shows in mobile</div>
        <div class="-hide-mobile">Hides in mobile</div>
        <br><br>
        <div class="-show-mobile-lg">Shows in mobile-lg</div>
        <div class="-hide-mobile-lg">Hides in mobile-lg</div>
        <br><br>
        <div class="-show-tablet">Shows in tablet</div>
        <div class="-hide-tablet">Hides in tablet</div>
        <br><br>
        <div class="-show-mobile-nav">Shows in mobile-nav</div>
        <div class="-hide-mobile-nav">Hides in mobile-nav</div>
        <br><br>
        <div class="-show-laptop">Shows in laptop</div>
        <div class="-hide-laptop">Hides in laptop</div>
        <br><br>
        <div class="-show-lg">Shows in lg</div>
        <div class="-hide-lg">Hides in lg</div>
        <br><br>
        <div class="-show-xl">Shows in xl</div>
        <div class="-hide-xl">Hides in xl</div>
        <br><br>
        <div class="-show-xxl">Shows in xxl</div>
        <div class="-hide-xxl">Hides in xxl</div>
    </div>

    <div class="container">

        <div class="locations-map" data-component="locations-map">
            <div
              class="locations-map__map-container"
              data-element="map"
              data-lat="38.242655"
              data-lng="-85.76633"
              data-zoom="12"
            ></div>

            <ul class="locations-map__controls-list">
                <li class="locations-map__controls-item">
                    <button
                      data-element="control"
                      data-lat="38.242655"
                      data-lng="-85.76633"
                      data-zoom="12"
                      data-status="on"
                      class="button"
                    >
                        Regional View
                    </button>
                </li>
                <li class="locations-map__controls-item locations-map__controls-item--section-break">
                    Select an option
                </li>
                <li class="locations-map__controls-item">
                    <button
                      data-element="control"
                      data-lat="38.242655"
                      data-lng="-85.76633"
                      data-zoom="18"
                      data-status="off"
                      class="button"
                    >
                        OOHology
                    </button>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('footer-js')
    <script>
        window.LOCATIONS = [
            {
                "id":1,
                "primary": 1,
                "name":"OOHology",
                "notes":"",
                "address1":"908 S 8th St",
                "address2":"",
                "address3":"",
                "city":"Louisville",
                "state":"KY",
                "zip":"40203",
                "email":"",
                "phone":"",
                "fax":"",
                "image":"",
                "image_metadata":"",
                "hours":"Monday: 9 - 5",
                "lat":38.242655,
                "lng":-85.76633,
                "cms_sort_id":1,
                "title":"OOHology",
                "url_slug":"oohology",
                "meta_description":"",
                "meta_keywords":"",
                "url_lock":"",
                "country":"United States"
            }
        ]
        </script>
    @parent
@endsection
