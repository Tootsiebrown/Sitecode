import selectComponent from './utilities/select-component'
import BarcodeReader from "./component/barcode-reader";
import ProductSuggestion from "./component/product-suggestion";
import SelectOrNew from "./component/select-or-new";
import SelectWithChild from "./component/select-with-child";

export default function Site() {

    const init = () => {
        startCustom()
    }

    const startCustom = () => {
        selectComponent('barcode-reader').each((index, element) => new BarcodeReader(element))
        selectComponent('product-suggestion').each((index, element) => new ProductSuggestion(element))
        selectComponent('select-with-child').each((index, element) => new SelectWithChild(element))
        selectComponent('select-or-new').each((index, element) => new SelectOrNew(element))
    }

    return {
        init
    }
}
