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
import StripeForm from "./component/checkout/stripe-form";
import NavCart from "./component/nav-cart";
import StickyThing from "./component/sticky-thing";
import AutoSelectOnFocus from "./component/auto-select-on-focus";
import ListingBinBulkEditor from "./component/listing-bin-bulk-editor";
import BillingSameAsShipping from "./component/checkout/billing-same-as-shipping";
import WatchListing from "./component/watch-listing";
import ListingItemAdder from "./component/listing-item-adder";
import ConfirmIfDeleteItems from "./component/confirm-if-delete-items";
import CancelOrder from "./component/cancel-order";
import SearchSidebar from "./component/search-sidebar";
import SortFeaturedListings from "./component/sort-featured-listings";
import CartItemQuantity from "./component/checkout/cart-item-quantity";
import OfferActionForm from "./component/offer-action-form";
import ShippingAddressPicker from "./component/checkout/shipping-address-picker";
import Type from "./component/dashboard/coupons/type";
import FormControlDate from "./component/form-control-date";
import CheckoutSidebarCart from "./component/checkout/checkout-sidebar-cart";
import PaymentMethodPicker from "./component/checkout/payment-method-picker";
import ConfirmLink from "./component/confirm-link";
import ImageField from "./component/dashboard/image-field";
import UsageRestrictions from "./component/dashboard/coupons/usage-restrictions";
import MultiImageSort from "./component/dashboard/multi-image-sort";
import ApplicabilityRestrictions from "./component/dashboard/coupons/applicability-restrictions";

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
        selectComponent('listing-item-adder').each((index, element) => new ListingItemAdder(element))
        selectComponent('billing-same-as-shipping').each((index, element) => new BillingSameAsShipping(element))
        selectComponent('watch-listing').each((index, element) => new WatchListing(element))
        selectComponent('confirm-if-delete-items').each((index, element) => new ConfirmIfDeleteItems(element))
        selectComponent('cancel-order').each((index, element) => new CancelOrder(element))
        selectComponent('search-sidebar').each((index, element) => new SearchSidebar(element))
        selectComponent('sort-featured-listings').each((index, element) => new SortFeaturedListings(element))
        selectComponent('cart-item-quantity').each((index, element) => new CartItemQuantity(element))
        selectComponent('offer-action-form').each((index, element) => new OfferActionForm(element))
        selectComponent('shipping-address-picker').each((index, element) => new ShippingAddressPicker(element))
        selectComponent('dashboard-coupon-type').each((index, element) => new Type(element))
        selectComponent('dashboard-coupon-usage-restrictions').each((index, element) => new UsageRestrictions(element))
        selectComponent('form-control-date').each((index, element) => new FormControlDate(element))
        selectComponent('checkout-sidebar-cart').each((index, element) => new CheckoutSidebarCart(element))
        selectComponent('payment-method-picker').each((index, element) => new PaymentMethodPicker(element))
        selectComponent('confirm-link').each((index, element) => new ConfirmLink(element))
        selectComponent('image-field').each((index, element) => new ImageField(element))
        selectComponent('multi-image-sort').each((index, element) => new MultiImageSort(element))
        selectComponent('dashboard-coupon-applicability-restrictions').each((index, element) => new ApplicabilityRestrictions(element))

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
