const Inline = Quill.import('blots/inline')
const LinkFormatAttributesList = [
    'href',
    'target'
];

export default class LinkType extends Inline {

    static create(value) {
        let node = super.create(value);
        value = this.sanitize(value);

        if (typeof value == 'string') {
            node.setAttribute('href', value)
        } else {
            for (let key in value) {
                if (value.hasOwnProperty(key)) {
                    const sanitizedValue = this.sanitize(value[key])

                    node.setAttribute(key, sanitizedValue)
                }
            }
        }

        return node
    }

    static formats(domNode) {
        return LinkFormatAttributesList.reduce(function(formats, attribute) {
            if (domNode.hasAttribute(attribute)) {
                formats[attribute] = domNode.getAttribute(attribute);
            }
            return formats;
        }, {});
    }

    format(name, value) {
        if (LinkFormatAttributesList.indexOf(name) > -1) {
            if (value) {
                value = this.constructor.sanitize(value)
                this.domNode.setAttribute(name, value)
            } else {
                this.domNode.removeAttribute(name)
            }
        } else {
            super.format(name, value);
        }
    }


    removeTargetBlank() {
        this.domNode.removeAttribute('target')
    }

    setTargetBlank() {
        this.domNode.setAttribute('target', '_blank')
    }

    static sanitize(url) {
        return sanitize(url, this.PROTOCOL_WHITELIST) ? url : this.SANITIZED_URL;
    }

    static targetBlank(node) {
        if (node.hasAttribute('target')) {
            return true
        }
        return false
    }

    static setTargetBlank() {
        node.setAttribute('target', '_blank')
    }
}
LinkType.blotName = 'link';
LinkType.tagName = 'A';
LinkType.SANITIZED_URL = 'about:blank';
LinkType.PROTOCOL_WHITELIST = ['http', 'https', 'mailto', 'tel'];

function sanitize(url, protocols) {
    let anchor = document.createElement('a');
    anchor.href = url;
    let protocol = anchor.href.slice(0, anchor.href.indexOf(':'));
    return protocols.indexOf(protocol) > -1;
}