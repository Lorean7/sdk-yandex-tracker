export class SubscribersCollection {
    _subscribers = [];

    insert(callback, isDisposable, meta) {
        const subscriber = {
            callback,
            isDisposable,
            meta,
        };

        this._subscribers.push(subscriber);

        return subscriber;
    };

    destroy(subscriber) {
        const index = this._subscribers.findIndex(s => s === subscriber);
        this._subscribers.splice(index, 1);
    };

    forEach(callback) {
        const subscribers = [...this._subscribers];

        for(let index = 0; index < subscribers.length; index++) {
            callback(subscribers[index], index);
        }
    };
}
