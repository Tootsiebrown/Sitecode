export default class GoogleMapOverlay extends google.maps.OverlayView {

    constructor(bounds, image, mapObject, showBounds = false, importSVG = false) {
        super()

        this.bounds = bounds
        this.image = image
        this.map = mapObject.map
        this.container = null
        this.showBounds = showBounds
        this.containerBorder
        this.importSVG = importSVG

        this.setMap(this.map)
    }

    onAdd() {
        const panes = this.getPanes()

        this.$imageContainer = $('<div/>')
         .css({
            'position' : 'absolute'
         })
         .appendTo(panes.overlayMouseTarget)

        if (this.showBounds) {
            this.addContainerBorder()
        }

        if (this.importSVG) {
            const $image = $(this.image, {
            })
             .css({
                'width'    : '100%',
                'height'   : '100%',
                'position' : 'absolute'
            })
             .appendTo(this.$imageContainer)
             .trigger('addedOverlay')
        } else {
            const $image = $('<img/>', {
                src: this.image
            })
             .css({
                'width'    : '100%',
                'height'   : '100%',
                'position' : 'absolute'
            })
             .appendTo(this.$imageContainer)
        }

    }

    addContainerBorder() {
        this.$imageContainer.css({
            'border' : '1px solid red'
        })
    }

    draw() {
        const overlayProjection = this.getProjection()
        const sw = overlayProjection.fromLatLngToDivPixel(this.bounds.getSouthWest())
        const ne = overlayProjection.fromLatLngToDivPixel(this.bounds.getNorthEast())

        this.$imageContainer
         .css({
            'left'   : sw.x + 'px',
            'top'    : ne.y + 'px',
            'width'  : (ne.x - sw.x) + 'px',
            'height' : (sw.y - ne.y) + 'px'
         })
    }

    onRemove() {
        this.$imageContainer[0].parentNode.removeChild(this.$imageContainer[0])
        this.$imageContainer = null
    }
}