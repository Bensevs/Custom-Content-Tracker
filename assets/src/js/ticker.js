import $ from 'jquery';
import 'slick-carousel';

// This is the most important line: it tells Webpack to process the SCSS file.
import '../scss/ticker.scss';

const initializeContentTicker = ($scope) => {
    const $widgetWrapper = $scope.find('.custom-content-ticker-wrapper');
    if (!$widgetWrapper.length) {
        return;
    }

    const $slider = $widgetWrapper.find('.cct__slider');
    const settings = $widgetWrapper.data();

    // Prevent re-initialization
    if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
    }

    $slider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: settings.speed,
        rtl: settings.direction === 'right',
        arrows: settings.showArrows === 'yes',
        pauseOnHover: settings.pauseOnHover === 'yes',
        infinite: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="eicon-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="eicon-chevron-right"></i></button>',
    });
};

// Hook into Elementor's frontend initialization
$(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/custom_content_ticker.default',
        initializeContentTicker
    );
});