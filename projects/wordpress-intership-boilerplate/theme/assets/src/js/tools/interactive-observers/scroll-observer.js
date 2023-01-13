import { SubscribersCollection } from './reuse/subscribers-collection';

export const scrollObserver = (function() {
    const subscribersCollection = new SubscribersCollection();

    function subscribe(callback, isDisposable = false) {
        return subscribersCollection.insert(callback, isDisposable);
    }

    function unsubscribe(subscriber) {
        subscribersCollection.destroy(subscriber);
    }

    function handleScroll() {
        subscribersCollection.forEach(subscriber => {
            subscriber.callback(window.scrollY);

            if(subscriber.isDisposable) {
                subscribersCollection.destroy(subscriber);
            }
        });
    }

    window.addEventListener('scroll', handleScroll, { passive: true });

    return {
        subscribe,
        unsubscribe,
    };
})();
