import selectComponent from './utilities/select-component'
import BarcodeReader from "./component/barcode-reader";
import DateTimePickerWrapper from "./component/datetime-picker";
import ProductSuggestion from "./component/product-suggestion";
import SelectOrNew from "./component/select-or-new";
import NewProductImage from "./component/new-product-image";
import ProductImage from "./component/product-image";
import ListingTypeSelect from "./component/listing-type-select";
import ProductCategoriesHierarchy from "./component/product-categories-hierarchy";
import FocusableInputGroup from "./component/focusable-input-group";
import TaxonomyNav from "./component/taxonomy-nav";
import ListingResult from "./component/listing-result";
import StripeForm from "./component/stripe-form";
import NavCart from "./component/nav-cart";
import StickyThing from "./component/sticky-thing";
import AutoSelectOnFocus from "./component/auto-select-on-focus";
import ListingBinBulkEditor from "./component/listing-bin-bulk-editor";

export default function Site() {

    const init = () => {
        startCustom()
    }

    const startCustom = () => {
        new StickyThing()
        selectComponent('barcode-reader').each((index, element) => new BarcodeReader(element))
        selectComponent('product-suggestion').each((index, element) => new ProductSuggestion(element))
        selectComponent('product-categories-hierarchy').each((index, element) => new ProductCategoriesHierarchy(element))
        selectComponent('select-or-new').each((index, element) => new SelectOrNew(element))
        selectComponent('new-product-image').each((index, element) => new NewProductImage(element))
        selectComponent('lister-product-image').each((index, element) => new ProductImage(element))
        selectComponent('listing-type-select').each((index, element) => new ListingTypeSelect(element))
        selectComponent('focusable-input-group').each((index, element) => new FocusableInputGroup(element))
        selectComponent('datetime-picker').each((index, element) => new DateTimePickerWrapper(element))
        selectComponent('listing-result').each((index, element) => new ListingResult(element))
        selectComponent('stripe-form').each((index, element) => new StripeForm(element))
        selectComponent('nav-cart').each((index,element) => new NavCart(element))
        selectComponent('auto-select-on-focus').each((index, element) => new AutoSelectOnFocus(element))
        selectComponent('listing-bin-bulk-editor').each((index, element) => new ListingBinBulkEditor(element))
        let taxonomyNavs = selectComponent('taxonomy-nav').map((index, element) => new TaxonomyNav(element))
        taxonomyNavs.each((index, thisNav) => {
            let otherTaxonomyNavs = []

            $.each(taxonomyNavs, (i, e) => {
                if (i !== index) {
                    otherTaxonomyNavs.push(e);
                }
            })

            thisNav.setOtherNavs(otherTaxonomyNavs)
        })
    }

    return {
        init
    }
}
