const BaseImageFormat = Quill.import('formats/image');
const ImageFormatAttributesList = [
    'alt',
    'height',
    'width',
    'style'
];

class QuillImageFormat extends BaseImageFormat {

    static formats(domNode) {
        return ImageFormatAttributesList.reduce(function(formats, attribute) {
            if (domNode.hasAttribute(attribute)) {
                formats[attribute] = domNode.getAttribute(attribute);
            }
            return formats;
        }, {});
    }

    format(name, value) {
        if (ImageFormatAttributesList.indexOf(name) > -1) {
            if (value) {
                this.domNode.setAttribute(name, value);
            } else {
                this.domNode.removeAttribute(name);
            }
        } else {
            super.format(name, value);
        }
    }

    deleteAt(index, length) {
        if (document.activeElement.tagName.toUpperCase() === 'INPUT') {
            return false
        }
        super.deleteAt(index, length)
    }
}
QuillImageFormat.blotName = 'image';
QuillImageFormat.tagName = 'IMG';

export default QuillImageFormat