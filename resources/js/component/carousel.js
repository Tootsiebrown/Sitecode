import Slick from 'vendor/slick';
import Base from './base';

/**
 * Class carousel / Slick
 *
 * @class Carousel
 * @extends Base
 */

export default function CarouselFactory(args) {
    /**
     * Plugin defaults / Base constructor
     * ----------------------------------------------------------- */
    const DEFAULT = {
        name: 'Carousel',
        el: '[data-action="carousel"]',
    };

    const ACTION_DEFAULT = {
        arrows: true,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
    };

    let settings = Base.construct(DEFAULT, args);

    /**
     * Private and public methods
     * ----------------------------------------------------------- */
    let action = function(args) {
        let actionArgs = Object.assign(ACTION_DEFAULT, args);

        $(settings.el).slick(actionArgs);
    };

    /**
     * Method exporter
     * ----------------------------------------------------------- */
    let publicExports = {
        action,
    };

    return Object.assign(Base, publicExports);
};
