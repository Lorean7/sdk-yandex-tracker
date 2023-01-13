export function throttle(func, durationInMs) {
    let lastCall = 0;

    return function (...args) {
        const now = new Date().getTime();

        if (now - lastCall < durationInMs) {
            return;
        }

        lastCall = now;

        return func(...args);
    };
}
