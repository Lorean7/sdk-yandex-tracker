import { SubscribersCollection } from './reuse/subscribers-collection';

import { scrollObserver } from './scroll-observer';
import { resizeObserver } from './resize-observer';

export const viewportHitsObserver = (function() {
    const subscribersCollection = new SubscribersCollection();

    function subscribe(callback, selector, threshold = 0, isDisposable = true) {
        subscribersCollection.insert(callback, isDisposable, {
            $element: $(selector),
            threshold,
        });

        handleViewport();
    }

    function unsubscribe(subscriber) {
        subscribersCollection.destroy(subscriber);
    }

    function handleViewport() {
        subscribersCollection.forEach(subscriber => {
            if(subscriber.meta.$element.isInViewport(subscriber.meta.threshold)) {
                subscriber.callback();

                if(subscriber.isDisposable) {
                    subscribersCollection.destroy(subscriber);
                }
            }
        });
    }

    scrollObserver.subscribe(handleViewport);
    resizeObserver.subscribe(handleViewport);

    return {
        subscribe,
        unsubscribe,
    };
})();
