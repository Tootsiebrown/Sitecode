import selectComponent from './utilities/select-component'
import BarcodeReader from "./component/barcode-reader";
import ProductSuggestion from "./component/product-suggestion";
import SelectOrNew from "./component/select-or-new";
import NewProductImage from "./component/new-product-image";
import ProductImage from "./component/product-image";
import ListingTypeSelect from "./component/listing-type-select";
import ProductCategoriesHierarchy from "./component/product-categories-hierarchy";
import FocusableInputGroup from "./component/focusable-input-group";

export default function Site() {

    const init = () => {
        startCustom()
    }

    const startCustom = () => {
        selectComponent('barcode-reader').each((index, element) => new BarcodeReader(element))
        selectComponent('product-suggestion').each((index, element) => new ProductSuggestion(element))
        selectComponent('product-categories-hierarchy').each((index, element) => new ProductCategoriesHierarchy(element))
        selectComponent('select-or-new').each((index, element) => new SelectOrNew(element))
        selectComponent('new-product-image').each((index, element) => new NewProductImage(element))
        selectComponent('lister-product-image').each((index, element) => new ProductImage(element))
        selectComponent('listing-type-select').each((index, element) => new ListingTypeSelect(element))
        selectComponent('focusable-input-group').each((index, element) => new FocusableInputGroup(element))
    }

    return {
        init
    }
}
