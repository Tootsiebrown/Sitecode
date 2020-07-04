const Keyboard = Quill.import('modules/keyboard')
import LinkBlot from 'component/QuillLinkFormat'

class Range {
    constructor(index, length = 0) {
        this.index = index;
        this.length = length;
    }
}

export default class QuillTooltip {
    constructor(quill, bounds) {
        this.quill = quill;
        this.boundsContainer = bounds || document.body;
        this.root = quill.addContainer('ql-tooltip');
        this.shadow = quill.addContainer('ql-tooltip-shadow');
        this.root.innerHTML = this.constructor.TEMPLATE;
        // if (this.quill.root === this.quill.scrollingContainer) {
        //     this.quill.root.addEventListener('scroll', () => {
        //         this.root.style.marginTop = (-1*this.quill.root.scrollTop) + 'px';
        //     });
        // }
        this.hide();

        this.textbox = this.root.querySelector('input[type="text"]');
        this.listen();
        this.preview = this.root.querySelector('a.ql-preview');
    }

    checkTarget() {
        if (!this.checkbox.checked && this.link) {
            this.preview.removeAttribute('target')
            this.link.removeTargetBlank()
            return
        }
        this.preview.setAttribute('target', '_blank')
        if (this.link) {
            this.link.setTargetBlank()
        }
    }

    hide() {
        if (this.newWindow) {
            this.root.removeChild(this.newWindow)
            this.newWindow = null
        }
        this.root.classList.add('ql-hidden');
        this.shadow.classList.add('ql-hidden');
    }

    position(reference) {
        // let left = reference.left + reference.width/2 - this.root.offsetWidth/2;
        // // root.scrollTop should be 0 if scrollContainer !== root
        // let top = reference.bottom + this.quill.root.scrollTop;
        // this.root.style.left = left + 'px';
        // this.root.style.top = top + 'px';
        // this.root.classList.remove('ql-flip');
        let containerBounds = this.boundsContainer.getBoundingClientRect();
        let rootBounds = this.root.getBoundingClientRect();
        let shift = 0;
        if (rootBounds.right > containerBounds.right) {
            shift = containerBounds.right - rootBounds.right;
            // this.root.style.left = (left + shift) + 'px';
        }
        if (rootBounds.left < containerBounds.left) {
            shift = containerBounds.left - rootBounds.left;
            // this.root.style.left = (left + shift) + 'px';
        }
        // if (left + shift < 0) {
        //     this.root.style.left = '8px'
        // }
        // if (rootBounds.bottom > containerBounds.bottom) {
        //     let height = rootBounds.bottom - rootBounds.top;
        //     let verticalShift = reference.bottom - reference.top + height;
        //     this.root.classList.add('ql-flip');

        //     if (top - verticalShift < 16) {
        //         this.root.style.top = '16px'
        //         return
        //     }
        //     this.root.style.top = (top - verticalShift) + 'px';
        // }
        this.root.style.top = '50%'
        this.root.style.left = '50%'
        return shift;
    }

    listen() {
        this.textbox.addEventListener('keydown', (event) => {
            if (Keyboard.match(event, 'enter')) {
                this.save();
                event.preventDefault();
            } else if (Keyboard.match(event, 'escape')) {
                this.cancel();
                event.preventDefault();
            }
        });
        this.root.querySelector('a.ql-action').addEventListener('click', (event) => {
            if (this.root.classList.contains('ql-editing')) {
                this.save();
            } else {
                this.edit('link', this.preview.textContent);
            }
            event.preventDefault();
        });
        this.root.querySelector('a.ql-remove').addEventListener('click', (event) => {
            if (this.linkRange != null) {
                let range = this.linkRange;
                this.restoreFocus();
                this.quill.formatText(range, 'link', false);
                delete this.linkRange;
            }
            event.preventDefault();
            this.hide();
        });
        this.quill.on('selection-change', (range, oldRange, source) => {
            if (range == null) return;
            if (range.length === 0 && source === Quill.sources.USER) {
                let [link, offset] = this.quill.scroll.descendant(LinkBlot, range.index);
                this.link = link
                if (this.link != null) {
                    const rangeIndex = range.index - offset
                    this.linkRange = new Range(rangeIndex, this.link.length());
                    let preview = LinkBlot.formats(link.domNode);
                    this.preview.removeAttribute('target')
                    if (link.domNode.hasAttribute('target')) {
                        this.preview.setAttribute('target', '_blank')
                    }
                    this.preview.textContent = preview.href;
                    this.preview.setAttribute('href', preview.href)
                    if (!this.newWindow) {
                        this.addNewWindowCheck()
                    }
                    this.show()
                    this.position(this.quill.getBounds(this.linkRange))
                    return;
                }
            } else {
                delete this.linkRange;
            }
            this.hide();
        });
    }

    cancel() {
        this.hide();
    }

    edit(mode = 'link', preview = null) {
        this.root.classList.remove('ql-hidden');
        this.shadow.classList.remove('ql-hidden');
        this.root.classList.add('ql-editing');
        if (preview != null) {
            this.textbox.value = preview;
        } else if (mode !== this.root.getAttribute('data-mode')) {
            this.textbox.value = '';
        }
        this.position(this.quill.getBounds(this.quill.selection.savedRange));
        this.textbox.select();
        this.textbox.setAttribute('placeholder', this.textbox.getAttribute(`data-${mode}`) || '');
        this.root.setAttribute('data-mode', mode);
    }

    restoreFocus() {
        let scrollTop = this.quill.scrollingContainer.scrollTop;
        this.quill.focus();
        this.quill.scrollingContainer.scrollTop = scrollTop;
    }

    save() {
        let value = this.textbox.value;
        switch(this.root.getAttribute('data-mode')) {
            case 'link': {
                let scrollTop = this.quill.root.scrollTop;
                let linkOptions = {
                    href: value
                }
                if (this.checkbox.checked) {
                    linkOptions.target = '_blank'
                }
                if (this.linkRange) {
                    this.quill.formatText(this.linkRange, 'link', linkOptions, Quill.sources.USER);
                    delete this.linkRange;
                } else {
                    this.restoreFocus();
                    this.quill.format('link', linkOptions, Quill.sources.USER);
                }
                this.quill.root.scrollTop = scrollTop;
                break;
            }
            case 'video': {
                value = extractVideoUrl(value);
          } // eslint-disable-next-line no-fallthrough
          case 'formula': {
            if (!value) break;
            let range = this.quill.getSelection(true);
            if (range != null) {
                let index = range.index + range.length;
                this.quill.insertEmbed(index, this.root.getAttribute('data-mode'), value, Quill.sources.USER);
                if (this.root.getAttribute('data-mode') === 'formula') {
                    this.quill.insertText(index + 1, ' ', Quill.sources.USER);
                }
                this.quill.setSelection(index + 2, Quill.sources.USER);
            }
            break;
          }
          default:
        }
        this.textbox.value = '';
        this.hide();
    }

    addNewWindowCheck() {
        const checkbox = document.createElement('label')
        checkbox.innerHTML = this.constructor.NEWWINDOW
        checkbox.className = 'new-window'

        this.root.appendChild(checkbox)

        this.newWindow = this.root.querySelector('.new-window')
        
        this.checkbox = this.root.querySelector('input[type="checkbox"]')
        this.checkbox.addEventListener('click', (event) => {
            this.checkTarget()
        })
        this.checkbox.checked = false

        if (this.preview.hasAttribute('target') || !this.link) {
            this.checkbox.checked = true
        }
    }

    show() {
        this.root.classList.remove('ql-editing');
        this.root.classList.remove('ql-hidden');
        this.shadow.classList.remove('ql-hidden');
        this.root.removeAttribute('data-mode');
    }
}


function extractVideoUrl(url) {
    let match = url.match(/^(?:(https?):\/\/)?(?:(?:www|m)\.)?youtube\.com\/watch.*v=([a-zA-Z0-9_-]+)/) ||
    url.match(/^(?:(https?):\/\/)?(?:(?:www|m)\.)?youtu\.be\/([a-zA-Z0-9_-]+)/);
    if (match) {
        return (match[1] || 'https') + '://www.youtube.com/embed/' + match[2] + '?showinfo=0';
    }
  if (match = url.match(/^(?:(https?):\/\/)?(?:www\.)?vimeo\.com\/(\d+)/)) {  // eslint-disable-line no-cond-assign
    return (match[1] || 'https') + '://player.vimeo.com/video/' + match[2] + '/';
  }
  return url;
}

function fillSelect(select, values, defaultValue = false) {
    values.forEach(function(value) {
        let option = document.createElement('option');
        if (value === defaultValue) {
            option.setAttribute('selected', 'selected');
        } else {
            option.setAttribute('value', value);
        }
        select.appendChild(option);
    });
}

QuillTooltip.TEMPLATE = [
'<div>',
'<a class="ql-preview" href="about:blank"></a>',
'<input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL">',
'<a class="ql-action"></a>',
'<a class="ql-remove"></a>',
'</div>'
].join('');

QuillTooltip.NEWWINDOW = [
'<input type="checkbox" data-id="new-window">',
'<span>',
'Open link in new window',
'</span>'
].join('');