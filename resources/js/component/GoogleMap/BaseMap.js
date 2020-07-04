// Creates JS class out of Google Map API

export default class BaseMap {
    markers = []
    markerBounds = new google.maps.LatLngBounds()

    mapOptionsDefaults = {
        zoom        : 12,
        scrollwheel : false
    }

    mapCenterDefaults = {
        lat : 38.232069,
        lng : -85.742059,
    }

    constructor(mapElement, mapOptions = {}) {
        this.map = this.initMap(mapElement, mapOptions)
        this.getMap = () => this.map
    }

    initMap(mapElement, mapOptions) {
        if (typeof google !== 'object') {
            throw new Error('Google Maps JavaScript API is required.')
        }

        mapOptions = {
            ...this.mapOptionsDefaults,
            ...mapOptions
        }

        if (!mapOptions.hasOwnProperty('center')) {
            mapOptions.center = new google.maps.LatLng(
                this.mapCenterDefaults.lat,
                this.mapCenterDefaults.lng
            )
        }

        return new google.maps.Map(mapElement, mapOptions)
    }

    setStyles(styles) {
        this.map.mapTypes.set('styled_map', new google.maps.StyledMapType(styles))
        this.map.setMapTypeId('styled_map')
    }

    /**
     * Adds a new location marker to the map. Custom markup for info windows should be passed in as
     * a function that returns a template literal.
     *
     * Example Usage:
     *
     * var locationFields = {
     *      title: 'Location Name',
     *      message: 'Location information'
     * }
     *
     * var locationTemplate = fields => `
     *      <h2>${fields.title}</h2>
     *      <p>${fields.message}</p>
     * `
     *
     * googleMaps.addLocation(123, 456, locationTemplate, locationFields, '/path/to/icon.png')
     *
     *
     * @param {number} lat
     * @param {number} lng
     * @param {string} (optional) infoWindowTemplate - Mustache.js formatted template for info window markup
     * @param {object} (optional) infoWindowFields - object used to fill in the template's data
     * @param {string} (optional) icon - URL path to the custom map tack icon for this location
     *
     * @return {void}
     */
    addMarker({ lat, lng, infoWindowTemplate, infoWindowFields, icon }) {
        const markerCenter = new google.maps.LatLng(lat, lng)
        const map = this.map
        const markerParams = {
            position: markerCenter,
            map,
        }

        if (icon) {
            markerParams.icon = icon
        }

        const marker = new google.maps.Marker(markerParams)

        // Add an info window only if infoWindowTemplate is defined
        if (infoWindowTemplate) {
            const infoWindowMarkup = infoWindowTemplate(infoWindowFields)
            const infoWindow = new google.maps.InfoWindow({
                content: infoWindowMarkup,
                enableEventPropagation: true,
                disableAutoPan: false,
                maxWidth: 150,
                zIndex: null,
                closeBoxURL: '/assets/images/icons/close.svg',
            })

            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.open(map, marker)
            }.bind(this))
        }

        this.markerBounds.extend(marker.position)
        this.markers.push(marker)
    }

    fitMarkerBounds() {
        this.map.fitBounds(this.markerBounds)
    }

    panToLocation(lat, lng) {
        const markerLocation = new google.maps.LatLng(lat, lng)
        this.map.panTo(markerLocation)
    }

    setZoomAmount(zoom) {
        this.map.setZoom(zoom)
    }

    /**
     * Fits the map bounds to a radius (in miles) around a given center point
     *
     * @param {number} lat
     * @param {number} lng
     * @param {number} distance - map bounds radius in miles
     *
     * @return {void}
     */
    fitRadiusBounds(lat, lng, distance) {
        const circle = new google.maps.Circle({
            center: new google.maps.LatLng(lat, lng),
            radius: (distance * 1609.34 / 2),
            visible: false
        })

        this.map.fitBounds(circle.getBounds())
    }

    /**
     * Clears all markers from the map
     *
     * @return {void}
     */
    clearMarkers() {
        for (let i = 0; i < this.markers.length; i++) {
            this.markers[i].setMap(null)
        }

        this.markers = []
    }

    geolocate() {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation){
                navigator.geolocation.getCurrentPosition((position) => {
                    resolve({
                        byIP: false,
                        coordinates: {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        }
                    })
                }, () => {
                    resolve({byIP: true})
                })
            } else {
                resolve({byIP: true})
            }
        })
    }

    createListener(event, listenerFunction) {
        this.map.addListener(event, listenerFunction)
    }

    geolocateByIP(fallbackEndpoint) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: fallbackEndpoint,
                success: function(data) {
                    resolve({
                        coordinates: $.parseJSON(data)
                    })
                },
                error: function(data) {
                    resolve({
                        coordinates: undefined
                    })
                }
            })
        })
    }

    /**
     * Uses geo-location to find the user's lat/lng coordinates. Uses browser-based
     * location if possible, falls back to server-side geo-location using IP address.
     *
     * The method expects a callback function as the second argument to handle the
     * user's coordinates.
     *
     * Example Usage:
     *
     * googleMaps.getUserLatLng('/path/to/fallback.php', function(coords) {
     *     console.log(coords.lat) // 123
     *     console.log(coords.lng) // 456
     * })
     *
     *
     * @param {string} fallbackEndpoint   - URL path to server-side script that processes IP-based geo-location.
     *                                      NOTE: the script should return a JSON object in the format { 'lat': 123, 'lng': 456 }
     *
     * @param {function} successCallback  - callback function to handle user's coordinates. Receives a coordinate object
     *                                      in the format { lat: 123, lng: 456 }
     *
     * @return {void}
     */
    getUserLatLng(fallbackEndpoint, successCallback) {
        this.geolocate().then((data) => {
            if (data.byIP) {
                this.geolocateByIP(fallbackEndpoint).then((data) => {
                    successCallback(data.coordinates)
                })
            } else {
                successCallback(data.coordinates)
            }
        })
    }

    /**
     * Retrieves lat and lng values from a given address or postal code.
     *
     * The method expects a callback function as the second argument to handle the
     * retrieved coordinates.
     *
     * Example Usage:
     *
     * googleMaps.getLatLngFromAddress('40217', function(coords) {
     *     console.log(coords.lat) // 38.2131874
     *     console.log(coords.lng) // -85.74102619999996
     * }, function() {
     *     console.log('Error finding coordinates')
     * })
     *
     *
     * @param {string} address            - Address or ZIP string that Google will use to determine coordinates
     *
     * @param {function} successCallback  - callback function to handle coordinates. Passed a coordinate object
     *                                      in the format { lat: 123, lng: 456 }
     *
     * @param {function} errorCallback    - callback function called when geocoder fails to find lat/lng values
     *
     * @return {void}
     */
    getLatLngFromAddress(address, successCallback, errorCallback) {
        const geocoder = new google.maps.Geocoder

        geocoder.geocode({
            address: address
        }, function(data) {
            if (data.length) {
                const lat = data[0].geometry.location.lat()
                const lng = data[0].geometry.location.lng()
                successCallback({lat, lng})
            } else {
                errorCallback()
            }
        })
    }

    /**
     * Retrieves an array of addresses near a given coordinate.
     *
     *
     * Example Usage:
     *
     * googleMaps.getAddressesFromLatLng(38.2131874, -85.74102619999996, function(addresses) {
     *     console.log(addresses.length) // 10
     * }, function() {
     *     console.log('No addresses found')
     * })
     *
     *
     * @param {number} lat
     * @param {number} lng
     * @param {function} successCallback  - callback function to handle retrieved addresses. Passed an array of address data
     * @param {function} errorCallback    - callback function to handle when no addresses are found at given coordinates
     *
     * @return {void}
     */
    getAddressesFromLatLng(lat, lng, successCallback, errorCallback) {
        const geocoder = new google.maps.Geocoder

        geocoder.geocode({
            location: new google.maps.LatLng(lat, lng)
        }, function(addresses) {
            if (addresses.length) {
                successCallback(addresses)
            } else {
                errorCallback()
            }
        })
    }

    setPoint(x, y) {
        const ne = this.map.getBounds().getNorthEast()
        const sw = this.map.getBounds().getSouthWest()
        const projection = this.map.getProjection()
        const topRight = projection.fromLatLngToPoint(ne)
        const bottomLeft = projection.fromLatLngToPoint(sw)
        const scale = 1 << this.map.getZoom();

        const position = projection.fromPointToLatLng(new google.maps.Point(x / scale + bottomLeft.x, y / scale + topRight.y))

        return position
    }

    setLatLng(lat, lng) {
        return new google.maps.LatLng(lat, lng)
    }

    refresh() {
        google.maps.event.trigger(this.map, 'resize')
    }
}
