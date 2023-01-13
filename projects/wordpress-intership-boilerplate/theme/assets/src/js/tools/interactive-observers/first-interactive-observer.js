import { SubscribersCollection } from './reuse/subscribers-collection';
import { scrollObserver } from './scroll-observer';
import { resizeObserver } from './resize-observer';

export const firstInteractiveObserver = (function() {
    const $document = $(document);

    const subscribersCollection = new SubscribersCollection();

    let scrollSubscriber;
    let resizeSubscriber;

    let isInteracted = false;

    function subscribe(callback) {
        isInteracted
            ? callback()
            : subscribersCollection.insert(callback);
    }

    function handleSubscriber(subscriber) {
        subscriber.callback();

        subscribersCollection.destroy(subscriber);
    }

    function handleInteractive() {
        if(isInteracted) return;
        isInteracted = true;

        subscribersCollection.forEach(handleSubscriber);

        uninstallHandlers();
    }

    function setupHandlers() {
        scrollSubscriber = scrollObserver.subscribe(handleInteractive, true);
        resizeSubscriber = resizeObserver.subscribe(handleInteractive, true);

        $document.on('mousemove', handleInteractive);
        $document.on('touchdown', handleInteractive);
        $document.on('mousedown', handleInteractive);
        $document.on('keyup', handleInteractive);
    }

    function uninstallHandlers() {
        scrollObserver.unsubscribe(scrollSubscriber);
        resizeObserver.unsubscribe(resizeSubscriber);

        $document.off('mousemove', handleInteractive);
        $document.off('touchdown', handleInteractive);
        $document.off('mousedown', handleInteractive);
        $document.off('keyup', handleInteractive);
    }

    setupHandlers();

    return {
        subscribe,
    };
})();
