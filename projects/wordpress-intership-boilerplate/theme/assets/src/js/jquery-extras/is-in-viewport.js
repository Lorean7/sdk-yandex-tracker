$.fn.isInViewport = function(threshold = 0) {
    const elementTop = $(this).offset().top;
    const elementBottom = elementTop + $(this).outerHeight();
    const viewportTop = window.scrollY - threshold;
    const viewportBottom = viewportTop + window.innerHeight + threshold * 2;

    return elementBottom > viewportTop && elementTop < viewportBottom;
};
