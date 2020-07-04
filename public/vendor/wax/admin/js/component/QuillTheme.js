import QuillTooltip from 'component/QuillTooltip'
const icons = Quill.import('ui/icons')
const SnowTheme = Quill.import('themes/snow')

export default class QuillTheme extends SnowTheme {
    constructor(quill, options) {
        super(quill, options)
    }

    extendToolbar (toolbar) {
        toolbar.container.classList.add('ql-snow');
        this.buildButtons([].slice.call(toolbar.container.querySelectorAll('button')), icons);
        this.buildPickers([].slice.call(toolbar.container.querySelectorAll('select')), icons);
        this.tooltip = new QuillTooltip(this.quill, this.options.bounds)
        if (toolbar.container.querySelector('.ql-link')) {
            const range = this.quill.getSelection()
            this.quill.keyboard.addBinding({ key: 'K', shortKey: true }, function(range, context) {
                toolbar.handlers['link'].call(toolbar, !context.format.link);
            });

            toolbar.container.querySelector('.ql-link').addEventListener('click', (event) => {
                this.tooltip.addNewWindowCheck()
            })
        }
    }
}