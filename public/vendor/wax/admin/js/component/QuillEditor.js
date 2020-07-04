import 'vendor/magnific-popup/jquery.magnific-popup.min.js'
import 'quill-image-resize-module'
import QuillTheme from 'component/QuillTheme'
import QuillLinkFormat from 'component/QuillLinkFormat'
import QuillImageFormat from 'component/QuillImageFormat'
import QuillImageAltText from 'component/QuillImageAltText'
import Delta from 'quill-delta'
import without from 'lodash/without'

Quill.register('themes/QuillTheme', QuillTheme)
Quill.register('formats/link', QuillLinkFormat, true)
Quill.register('formats/image', QuillImageFormat, true)
Quill.register('modules/imageAltText', QuillImageAltText)

export default class QuillEditor {
    toolbar = [
        [{ header: [3, 4, 5, 6, false] }],
        ['bold', 'italic', 'underline', 'blockquote'],
        [{ 'align': '' }, { 'align': 'right' }, { 'align': 'center' }, { 'align': 'justify' }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'indent': '-1'}, { 'indent': '+1' }],
        ['link', 'image', 'video']
    ]

    constructor(element) {
        this.$element = element
        this.checkForCustomTools()
        this.createEditor()
        this.bindEvents()
    }

    checkForCustomTools() {
        if ($(this.$element).attr('data-toolbar')) {
            const extraTools = JSON.parse($(this.$element).attr('data-toolbar')).map(item => Array.isArray(item) ? item : [item])

            if (extraTools.find(option => option == 'replaceDefault')) {
                this.toolbar = []
                extraTools.map(item => {
                    if (item != 'replaceDefault') {
                        this.toolbar.push(item)
                    }
                })
            } else {
                this.toolbar = this.toolbar.concat(extraTools)
            }
        }

    }

    createEditor() {
        this.quillEditor = new Quill(this.$element, {
            modules: {
                clipboard: {
                    matchVisual: false
                },
                toolbar: this.toolbar,
                imageResize: {
                    modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                },
                imageAltText: true
            },
            theme: 'QuillTheme'
        })

        this.quillEditor.getModule("toolbar").addHandler("image", this.imageUpload)

        this.quillEditor.clipboard.addMatcher('B, em, STRONG, I, a, DIV, span', function (node, delta) {
            const text = $(node).text()
            return new Delta().insert(text)
        })

        this.quillEditor.clipboard.addMatcher('IMG', function (node, delta) {
            const image = $(node).attr('src')
            return new Delta().insert(image)
        })
    }

    bindEvents() {
        this.quillEditor.on('editor-change', function(eventName, ...args) {
            if (eventName === 'text-change' && !window.editorChange) {
                window.editorChange = true
                $(window).bind('beforeunload', function() {
                    return 'There are pending changes on this page that will be discarded if you cancel.';
                });
            }
        })

        $(".cancelLeavePageAlert").click(function() {
            window.editorChange = null
            $(window).unbind('beforeunload');
        });
    }

    imageUpload = () => {  

        $.magnificPopup.open({
            items: {
                src: '/admin/file-upload'
            },
            type: 'ajax',
            mainClass : 'wax-modal-inline mfp-zoom-in file-upload',
            removalDelay : 250,
            closeOnContentClick: false,
            closeOnBgClick: false,
            callbacks: {
                open: () => {
                    window.openEditor = this.quillEditor
                    window.editorCurrentPos = this.quillEditor.getSelection().index;
                    window.magnificPopup = $.magnificPopup.instance
                    // bind insert embed

                },
                close: () => {
                    window.openEditor = false;
                    window.magnificPopup = false;
                    this.quillEditor.setSelection(window.editorCurrentPos);
                    window.editorCurrentPos = false;
                    // unbind insert embed
                }
            }
        });
    }
}