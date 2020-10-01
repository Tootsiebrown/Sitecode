import selectComponent from "../utilities/select-component";

export default class HomeSlider {
    constructor(element) {
        this.$component = selectComponent(element);
        this.$component.slick();
    }
}
