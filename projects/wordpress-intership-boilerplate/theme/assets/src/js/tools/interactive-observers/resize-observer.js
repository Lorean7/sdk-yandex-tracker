import { SubscribersCollection } from './reuse/subscribers-collection';

export const resizeObserver = (function() {
    const subscribersCollection = new SubscribersCollection();

    function subscribe(callback, isDisposable = false) {
        return subscribersCollection.insert(callback, isDisposable);
    }

    function unsubscribe(subscriber) {
        subscribersCollection.destroy(subscriber);
    }

    function handleResize() {
        subscribersCollection.forEach(subscriber => {
            subscriber.callback();

            if(subscriber.isDisposable) {
                subscribersCollection.destroy(subscriber);
            }
        });
    }

    window.addEventListener('resize', handleResize);

    return {
        subscribe,
        unsubscribe,
    };
})();
