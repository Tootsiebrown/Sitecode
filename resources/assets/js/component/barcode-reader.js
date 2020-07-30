// import 'velocity-animate'
// import 'velocity-animate/velocity.ui.min'
import selectComponent from '../utilities/select-component'
import Quagga from '@ericblade/quagga2'; // ES6

export default class BarcodeReader {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$input = this.$component.elements.input
        this.viewport = this.$component.elements.viewport.get(0);
// console.log(this.viewport)
        this.$input.on('focus', this.initQuagga)
    }

    initQuagga = (event) => {
        Quagga.init({
            inputStream : {
                name : "Live",
                type : "LiveStream",
                target: this.viewport
            },
            numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
            decoder : {
                readers : ["code_128_reader"]
            }
        }, function(err) {
            if (err) {
                console.log(err);
                return
            }
            console.log("Initialization finished. Ready to start quagga");
            Quagga.start();
        });
    }
}
