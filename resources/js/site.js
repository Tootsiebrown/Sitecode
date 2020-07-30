// import AjaxForm from 'component/ajax-form'
// import CustomInput from 'component/custom-input'
// import GoogleMap from 'component/GoogleMap'
// import modalMFP from 'component/modal-mfp'
// import MainNav from 'component/main-nav'
// import PhotoSwipe from 'component/gallery-photoswipe'
// import selectComponent from 'utilities/select-component'
// import Share from 'component/Share'
// import SubNav from 'component/subnav'
//import BarcodeReader from "component/barcode-reader";

// const AUTO_MODULES = [
//     PhotoSwipe
// ]

export default function Site() {

    const init = () => {
        //startDefault()
        startCustom()
    }
    //
    // const startDefault = function() {
    //     $.each(AUTO_MODULES, (key, Module) => {
    //         const instance = Module()
    //         instance.start()
    //     })
    // }
    //
    const startCustom = () => {
    //
    //     // selectComponent('ajax-form').each((index, element) => new AjaxForm(element))
    //     //
    //     // const mapIcon = {
    //     //     path: 'M1152 640q0-106-75-181t-181-75-181 75-75 181 75 181 181 75 181-75 75-181zm256 0q0 109-33 179l-364 774q-16 33-47.5 52t-67.5 19-67.5-19-46.5-52l-365-774q-33-70-33-179 0-212 150-362t362-150 362 150 150 362z',
    //     //     fillColor: '#000',
    //     //     fillOpacity: 1,
    //     //     strokeOpacity: 1,
    //     //     scale: .02,
    //     //     anchor: new google.maps.Point(896, 1792)
    //     // }
    //     //
    //     // const imageOverlays = [
    //     //     {
    //     //         northEast: {
    //     //             "lat" : 38.2665,
    //     //             "lng" : -85.6277
    //     //         },
    //     //         southWest: {
    //     //             "lat" : 38.229607,
    //     //             "lng" : -85.720607
    //     //         },
    //     //         image: 'http://via.placeholder.com/400x200',
    //     //         showBounds: true,
    //     //         importSVG: false
    //     //     },
    //     // ]
    //     //
    //     // selectComponent('locations-map').each((index, element) => new GoogleMap(index, element, {locations: window.LOCATIONS, icon: mapIcon, imageOverlays: imageOverlays}))
    //     //
    //     // selectComponent('toggle-nav').each((index, element) => new Nav(element))
    //     //
    //     // selectComponent('select').each((index, element) => new CustomInput(element))
    //     //
    //     // selectComponent('ajax-form').each((index, element) => new AjaxForm(element))
    //     //
    //     // selectComponent('main-nav').each((index, element) => new MainNav(element))
    //     //
    //     // selectComponent('share').each((index, element) => new Share(element))
    //
        selectComponent('barcode-reader').each((index, element) => new BarcodeReader(element))
    }

    return {
        init
    }
}
