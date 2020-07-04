import camelCase from 'lodash/camelCase'

const componentSelectorTemplate = name => `[data-component='${name}']`
const elementSelector = '[data-element]'
const componentSelector = '[data-component]'

export default function selectComponent(target, debug = false) {
    const selector = $.type(target) === 'string'
        ? componentSelectorTemplate(target)
        : false
        
    let $component
    let elements

    const init = () => {
        if (target instanceof jQuery) {
            $component = target
        } else {
            $component = selector ? $(selector) : $(target)
        }

        $component.elements = buildElements($component)
        $component.refresh = refresh
        $component.selector = selector
    }

    const buildElements = component => {
        const elementMap = {}
        let $elements = component.find(elementSelector)

        if (debug) {
            console.log('Original elements', $elements);
        }

        if ($elements.length) {
            const $excludedElements = $elements.filter((index, element) => {
                return $(element).parentsUntil($component).filter(componentSelector).length
            })

            $elements = $elements.not($excludedElements)

            if (debug) {
                console.log('Filtered elements', $elements);
            }

            $elements.each((index, element) => {
                const $element = $(element)
                const elementName = camelCase($element.data('element'))

                if (elementMap.hasOwnProperty(elementName)) {
                    elementMap[elementName] = elementMap[elementName].add($element)
                } else {
                    elementMap[elementName] = $element
                }
            })

            return elementMap
        }

        return {}
    }

    const refresh = debugSetting => {
        debug = debugSetting
        $component.elements = buildElements($component)
    }

    init()

    return $component
}