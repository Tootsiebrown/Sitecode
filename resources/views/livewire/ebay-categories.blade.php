<div id="ebay-category-root">
    @if (!empty($level1Categories))
        @include('dashboard.form-elements.form-group', [
            'type' => 'select',
            'name' => 'ebay_category_1',
            'prettyTitle' => 'Primary Ebay Category',
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
                window.livewire.hook('afterDomUpdate', () => {
                    jQuery('' +
                        '[name=ebay_category_1],' +
                        '[name=ebay_category_2],' +
                        '[name=ebay_category_3],' +
                        '[name=ebay_category_4],' +
                        '[name=ebay_category_5],' +
                        '[name=ebay_category_6],' +
                        '[name=ebay_category_7]').select2()
                });
            });
        </script>
    @endpush
</div>


