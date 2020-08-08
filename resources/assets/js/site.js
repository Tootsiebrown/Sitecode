import selectComponent from './utilities/select-component'
import BarcodeReader from "./component/barcode-reader";
import ProductSuggestion from "./component/product-suggestion";
import SelectOrNew from "./component/select-or-new";
import SelectWithChild from "./component/select-with-child";
import NewProductImage from "./component/new-product-image";
import ProductImage from "./component/product-image";
import ListingTypeSelect from "./component/listing-type-select";

export default function Site() {

    const init = () => {
        startCustom()
    }

    const startCustom = () => {
        selectComponent('barcode-reader').each((index, element) => new BarcodeReader(element))
        selectComponent('product-suggestion').each((index, element) => new ProductSuggestion(element))
        selectComponent('select-with-child').each((index, element) => new SelectWithChild(element))
        selectComponent('select-or-new').each((index, element) => new SelectOrNew(element))
        selectComponent('new-product-image').each((index, element) => new NewProductImage(element))
        selectComponent('lister-product-image').each((index, element) => new ProductImage(element))
        selectComponent('listing-type-select').each((index, element) => new ListingTypeSelect(element))
    }

    return {
        init
    }
}
