<div id="ebay-listing-fields-root">
    @if (!empty($level1Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_1',
            'prettyTitle' => 'Ebay Category',
            'options' => $level1Categories,
            'inputAttributes' => 'id="ebay_category_1"',
            'value' => $ebayCategory1,
        ])
    @endif

    @if (!empty($level2Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_2',
            'prettyTitle' => '',
            'options' => $level2Categories,
            'inputAttributes' => 'id="ebay_category_2"',
            'value' => $ebayCategory2
        ])
    @endif

    @if (!empty($level3Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_3',
            'prettyTitle' => '',
            'options' => $level3Categories,
            'inputAttributes' => 'id="ebay_category_3"',
            'value' => $ebayCategory3
        ])
    @endif

    @if (!empty($level4Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_4',
            'prettyTitle' => '',
            'options' => $level4Categories,
            'inputAttributes' => 'id="ebay_category_4"',
            'value' => $ebayCategory4
        ])
    @endif

    @if (!empty($level5Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_5',
            'prettyTitle' => '',
            'options' => $level5Categories,
            'inputAttributes' => 'id="ebay_category_5"',
            'value' => $ebayCategory5
        ])
    @endif

    @if (!empty($level6Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_6',
            'prettyTitle' => '',
            'options' => $level6Categories,
            'inputAttributes' => 'id="ebay_category_6"',
            'value' => $ebayCategory6
        ])
    @endif

    @if (!empty($level7Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_7',
            'prettyTitle' => '',
            'options' => $level7Categories,
            'inputAttributes' => 'id="ebay_category_7"',
            'value' => $ebayCategory7
        ])
    @endif

    @if($conditionsPolicy)
        @if ($conditionsPolicy['required'])
            <input type="hidden" name="conditionRequired" value="true">
        @endif

        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_condition',
            'prettyTitle' => 'eBay Condition',
            'options' => $conditionsPolicy['conditions'],
            'inputAttributes' => 'id="ebay_condition"',
            'value' => $ebayCondition
        ])
    @endif

    @if($allAspects)
        @foreach($allAspects as $aspect)
            @if (! $aspect->isRequired())
                @continue
            @endif

            <input type="hidden" name="required_aspects[]" value="{{ $aspect->getName() }}">
            <input type="hidden" name="ebay_aspect_cardinality[{{ $aspect->getName() }}]" value="{{ $aspect->getCardinality() }}">

            @switch($aspect->getType())
                @case('select')
                    @include('dashboard.form-elements.form-group', [
                        'type' => 'select',
                        'name' => 'ebay_aspects[' . $aspect->getName() . ']',
                        'prettyTitle' => $aspect->getName(),
                        'options' => $aspect->getOptions(),
                        'inputAttributes' => 'id="ebay_aspect-' .  Str::kebab($aspect->getName()) . '"'
                            . ' data-manual-id="ebay_manual_aspect-' .  Str::kebab($aspect->getName()) . '"',
                        'value' => old('ebay_aspects.' . $aspect->getName(), $aspects[$aspect->getName()] ?? null),
                    ])

                    @if($aspect->allowsManualEntry())
                        @include('dashboard.form-elements.form-group', [
                            'type' => 'text',
                            'name' => 'ebay_manual_aspects[' . $aspect->getName() . ']',
                            'prettyTitle' => 'Manual ' . $aspect->getName(),
                            'groupAttributes' => 'id="ebay_manual_aspect-' .  Str::kebab($aspect->getName()) . '"',
                            'value' => old('ebay_manual_aspects.' . $aspect->getName(), $manualAspects[$aspect->getName()] ?? null),
                        ])
                    @endif
                    @break
                @case('checkboxes')
                    @include('dashboard.form-elements.form-group', [
                        'type' => 'checkboxes',
                        'name' => 'ebay_aspect[' . $aspect->getName() . '][]',
                        'prettyTitle' => $aspect->getName(),
                        'options' => $aspect->getOptions(),
                        'value' => old('ebay_aspects.' . $aspect->getName(), $aspects[$aspect->getName()] ?? []),
                        'columns' => true,
                    ])
                    @break
                @default
                    @php throw new Exception('aspect type ' . $aspect->getType() . ' is not implemented yet') @endphp
                    @break
            @endswitch
        @endforeach
    @endif

    <div wire:loading.class="wire-loading-block" class="wire-loader">
        @include('dashboard.form-elements.form-group', [
            'type' => 'note',
            'name' => '',
            'prettyLabel' => '',
            'value' => 'Requesting additional fields...'
        ])
    </div>
</div>

@push('scripts')
    <script>
        var $categoriesContainer = jQuery('#ebay-categories-container');
        $categoriesContainer.on('change', '[name=ebay_category_1]',
            function(e) {
            console.log(@this);
                @this.set('ebayCategory1', $(this).select2('val'));
            }
        )
        $categoriesContainer.on('change', '[name=ebay_category_2]',
            function(e) {
                @this.set('ebayCategory2', $(this).select2('val'));
            }
        )
        $categoriesContainer.on('change', '[name=ebay_category_3]',
            function(e) {
                @this.set('ebayCategory3', $(this).select2('val'));
            }
        )
        $categoriesContainer.on('change', '[name=ebay_category_4]',
            function(e) {
                @this.set('ebayCategory4', $(this).select2('val'));
            }
        )
        $categoriesContainer.on('change', '[name=ebay_category_5]',
            function(e) {
                @this.set('ebayCategory5', $(this).select2('val'));
            }
        )
        $categoriesContainer.on('change', '[name=ebay_category_6]',
            function(e) {
                @this.set('ebayCategory6', $(this).select2('val'));
            }
        )
        $categoriesContainer.on('change', '[name=ebay_category_7]',
            function(e) {
                @this.set('ebayCategory7', $(this).select2('val'));
            }
        )



        document.addEventListener("livewire:load", function(event) {
            console.log('load fired')

            const handleAspectChanges = (e) => {
                $target = $(e.target)
                console.log($target)
                $manualInput = $('#' + $target.attr('data-manual-id'))
                console.log($manualInput);
                if ($target.val() === 'manual_entry') {
                    $manualInput.show()
                } else {
                    $manualInput.hide()
                }
            };

            $aspects = jQuery('select[name^=ebay_aspects]')
            $aspects.on('change', handleAspectChanges)
            $aspects.trigger('change')

            window.livewire.hook('afterDomUpdate', () => {
                jQuery('' +
                    '[name=ebay_category_1],' +
                    '[name=ebay_category_2],' +
                    '[name=ebay_category_3],' +
                    '[name=ebay_category_4],' +
                    '[name=ebay_category_5],' +
                    '[name=ebay_category_6],' +
                    '[name=ebay_category_7],' +
                    '[name=ebay_condition],' +
                    'select[name^=ebay_aspects]'
                ).select2()

                $aspects.off('change');
                $aspects = jQuery('select[name^=ebay_aspects]')
                $aspects.on('change', handleAspectChanges());
            });
        });
    </script>
    <style>
        pre.sf-dump {
            z-index: 1 !important;
        }
    </style>
@endpush
