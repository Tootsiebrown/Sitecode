// import 'velocity-animate'
// import 'velocity-animate/velocity.ui.min'
import selectComponent from '../utilities/select-component'
import Quagga from '@ericblade/quagga2'; // ES6
import * as $ from 'jquery';
import "magnific-popup";

export default class BarcodeReader {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)

        this.$input = this.$component.elements.input
        this.$button = this.$component.elements.button
        this.$parentForm = this.$input.closest('form')

        this.$modalContainer = $('#quagga-popup')
        this.$barcodeInput = $('#barcode-reader-input')
        this.$barcodeButton = $('#barcode-reader-button')
        this.$barcodeRefresh = $('#barcode-reader-refresh')
        this.$freezeFrame = $('#freeze-frame')

        this.$button.on('click', this.openCameraModal)
    }

    openCameraModal = (event) => {
        $.magnificPopup.open({
            items: {
                type: 'inline',
                src: '#quagga-popup'
            },
            callbacks: {
                open: () => {
                    this.initQuagga()
                    this.attachBarcodeActions()
                },
                close: () => {
                    if (Quagga) {
                        Quagga.stop()
                    }
                    this.detachBarcodeActions()
                }
                // e.t.c.
            }
        });
    }

    initQuagga = () => {
        if (Quagga) {
            Quagga.stop()
        }

        Quagga.init({
            inputStream : {
                name : "Live",
                type : "LiveStream",
                target: '#quagga-popup__video'
            },
            numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
            decoder : {
                readers : ["code_128_reader", 'upc_reader', 'ean_reader', 'ean_8_reader']
            }
        }, function(err) {
            if (err) {
                $('#quagga-popup__video')
                    .html('<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> '+err.name+'</strong>: '+err.message+'</div>')
                return
            }
            Quagga.start();
        });

        // Make sure, QuaggaJS draws frames an lines around possible
        // barcodes on the live stream
        Quagga.onProcessed((result) => {
            var drawingCtx = Quagga.canvas.ctx.overlay,
                drawingCanvas = Quagga.canvas.dom.overlay;

            if (result) {
                if (result.boxes) {
                    drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                    result.boxes.filter(function (box) {
                        return box !== result.box;
                    }).forEach(function (box) {
                        Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                    });
                }

                if (result.box) {
                    Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
                }

                if (result.codeResult && result.codeResult.code) {
                    Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
                }
            }
        });

        // Once a barcode had been read successfully, stop quagga and
        // close the modal after a second to let the user notice where
        // the barcode had actually been found.
        Quagga.onDetected((result) => {
            if (result.codeResult.code){
                this.$barcodeInput.val(result.codeResult.code)
                Quagga.pause()
                this.enableBarcodeActions()
                this.$freezeFrame.attr('src', Quagga.canvas.dom.image.toDataURL())
                this.$modalContainer.addClass('paused')
            }
        });
    }

    attachBarcodeActions = () => {
        this.$barcodeRefresh.on('click', this.handleBarcodeRefresh)
        this.$barcodeButton.on('click', this.handleBarcodeSubmit)
    }

    detachBarcodeActions = () => {
        this.$barcodeRefresh.off('click')
        this.$barcodeButton.off('click')
    }

    enableBarcodeActions = () => {
        this.$barcodeRefresh.prop('disabled', false);
        this.$barcodeButton.prop('disabled', false);
    }

    handleBarcodeRefresh = () => {
        this.$barcodeInput.val('')
        Quagga.start();
        this.$modalContainer.removeClass('paused')
        this.disableBarcodeActions()
    }

    handleBarcodeSubmit = () => {
        this.$input.val(this.$barcodeInput.val())
        $.magnificPopup.close()
        this.$parentForm.submit()
        console.log(this.$parentForm)
    }

    disableBarcodeActions = () => {
        this.$barcodeRefresh.prop('disabled', true);
        this.$barcodeButton.prop('disabled', true);
    }
}
