import selectComponent from 'utilities/select-component'
import BaseMap from 'component/GoogleMap/BaseMap'
import GoogleMapOverlay from 'component/GoogleMap/Overlay'
import 'vendor/jquery.debouncedresize'

export default class GoogleMap {

    // Optional array of object for image overlays
    // - supports SVGs or bitmap images,
    //   using importSVG to embed the SVG directly
    // - optional showBounds to provide outline to
    //   help with image placement
    

    constructor(index = 0, element, options = {}) {
        this.$component = selectComponent(element)
        this.$map = this.$component.elements.map
        this.icon = options.icon
        this.locations = options.locations
        this.index = index
        this.imageOverlays = options.imageOverlays

        this.mapDefaults = {
            center: {
                lat: parseFloat(this.$map.data('lat')),
                lng: parseFloat(this.$map.data('lng'))
            },
            mapTypeControl: false,
            streetViewControl: false,
            zoom: parseFloat(this.$map.data('zoom')),
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_BOTTOM
            }
        };

        this.mapOptions = {...this.mapDefaults, ...options.mapConfig}

        this.initMap()
    }

    initMap() {
        this.googleMap = new BaseMap(this.$map[0], this.mapOptions)
        this.infoWindow = new google.maps.InfoWindow()
        this.setCenterPoint(this.$map.data('lat'), this.$map.data('lng'))

        if (this.locations && this.locations.length) {
            this.addLocations()
        }

        if (this.imageOverlays) {
            this.createOverlays()
        }

        this.bindEvents()
    }

    bindEvents() {

        if (this.$component.elements.control) {
            this.initCustomControls()
        }

        if (this.$component.elements.select) {
            this.initCustomSelects()
        }

        this.$component.on('addedOverlay', () => {
            this.$component.refresh()
        })

        $(window).on('debouncedresize.googleMap-' + this.index , () => this.recenterMap())
    }

    unbindEvents() {
        $(window).off('.googleMap-' + this.index)

        this.$component.off()

        if (this.$component.elements.control) {
            this.$component.elements.control.off()
        }

        if (this.$component.elements.select) {
            this.$component.elements.select.off()
        }
    }

    destroyMap() {
        // This deletes the map and unbinds its events, but does not unbind
        // Google Map API events, they'll stay in the memory until JS garbage collection
        // removes them. This is a known issue with Google Maps.

        this.unbindEvents()
        this.$component.remove()
    }

    recenterMap() {
        this.googleMap.panToLocation(this.centerPoint.lat(), this.centerPoint.lng())
        this.$map.removeAttr('style')
        this.googleMap.refresh()
    }

    setCenterPoint(lat, lng) {
        this.centerPoint = this.googleMap.setLatLng(parseFloat(lat), parseFloat(lng))
    }

    addLocations() {
        this.locations.forEach(location => {
            this.googleMap.addMarker({
                lat: location.lat,
                lng: location.lng,
                icon: this.icon,
                infoWindowTemplate: this.infoWindowTemplate,
                infoWindowFields: location
            })
        })
    }

    createOverlays() {
        this.imageOverlays.forEach(location => {
            const bounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(location.southWest.lat, location.southWest.lng),
                new google.maps.LatLng(location.northEast.lat, location.northEast.lng)
            )

            return new GoogleMapOverlay(bounds, location.image, this.googleMap, location.showBounds, location.importSVG)
        })
    }

    initCustomSelects() {
        this.$component.elements.select.each((index, element) => {
            const $control = $(element)

            $control.on('change', () => {
                const $option = $control.find('option:selected')
                this.setMapPosition($option)
                this.activeControl = $option.val().trim()
                this.setActiveControls()
                this.setCenterPoint($option.data('lat'), $option.data('lng'))
                
            })
        })
    }

    initCustomControls() {
        this.$component.elements.control.each((index, element) => {
            const $control = $(element)

            $control.on('click', () => {
                this.setMapPosition($control)
                this.activeControl = $control.text().trim()
                this.setActiveControls()
                this.setCenterPoint($control.data('lat'), $control.data('lng'))
            })
        })
    }

    setActiveControls() {
        const $controls = this.$component.elements.control
        const $selects = this.$component.elements.select
        $controls.attr('data-status', 'off')

        if ($controls) {
            $controls.each((index, element) => {
                if ($(element).text().trim() == this.activeControl) {
                    $(element).attr('data-status', 'on')
                }
            })
        }

        if ($selects) {
            const option = $selects.find('option:contains(' + this.activeControl + ')')
            option.parent('select').val(this.activeControl)
        }
    }

    setMapPosition(control) {
        const $control = control
        const controlLat = parseFloat($control.data('lat'))
        const controlLng = parseFloat($control.data('lng'))
        let controlZoom = this.mapOptions.zoom

        if ($control.data('zoom')) {
            controlZoom = $control.data('zoom')
        }

        if (controlLat && controlLng) {
            this.googleMap.panToLocation(controlLat, controlLng)
            this.googleMap.setZoomAmount(controlZoom)
            this.$component.elements.control.attr('data-status', 'off')
            $control.attr('data-status', 'on')
        }
    }

    infoWindowTemplate = location => `
        <div class="info-window">
            <div class="info-window__content">
                <h4 class="info-window__location">${location.title}</h4>
                ${(location.phone || location.fax) && `
                    <div class="info-window__meta">
                        ${location.phone && `
                            <label class="info-window__label">Tel</label>
                            <a href="tel:${location.phone}" class="info-window__phone">${location.phone}</a>
                        `}
                        ${location.fax && `
                            <label class="info-window__label">Fax</label>
                            <a href="tel:${location.fax}" class="info-window__phone">${location.fax}</a>
                        `}
                    </div>
                `}
                <address class="info-window__address">
                    ${location.address1}
                    <br />
                    ${location.city}, ${location.state} ${location.zip}
                    <br />
                    ${location.country}
                </address>
            </div>
        </div>
    `;
}