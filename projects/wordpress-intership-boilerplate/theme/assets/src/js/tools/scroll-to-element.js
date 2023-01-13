const DEFAULT_OPTIONS = {
    duration: 300,
    additionalOffset: 0,
    headerSelector: 'header',
};

export function scrollToElement($target, options = {}) {
    options = {
        ...DEFAULT_OPTIONS,
        ...options
    };

    if(!$target || !$target.isPresent()) return;

    const $header = $(options.headerSelector);

    const headerHeight = $header.isPresent() ? $header.height() : 0;
    const targetOffset = $target.offset().top;

    $('html, body').animate({
        scrollTop: targetOffset - headerHeight - options.additionalOffset,
    }, options.duration);
}
