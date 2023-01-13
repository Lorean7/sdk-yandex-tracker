export const hooks = (function() {
    const TYPE_ACTION = 'action';
    const TYPE_FILTER = 'filter';

    const hooks = {
        [TYPE_ACTION]: {},
        [TYPE_FILTER]: {},
    };

    function addHook(type, name, handler, priority) {
        const collection = hooks[type];

        if(!collection[name]) {
            collection[name] = [];

            collection[name].push({
                handler,
                priority,
            });

            return;
        }

        for(let index = 0; index < collection[name].length; index++) {
            if(priority < collection[name][index].priority) {
                collection[name].splice(index, 0, {
                    handler,
                    priority,
                });

                return;
            }
        }

        collection[name].push({
            handler,
            priority,
        });
    }

    function removeHook(type, name, handler) {
        hooks[type][name] = hooks[type][name].filter(hook => hook.handler !== handler);
    }

    /********** ACTIONS **********/

    function addAction(name, handler, priority = 10) {
        addHook(TYPE_ACTION, name, handler, priority);
    }

    function removeAction(name, handler) {
        removeHook(TYPE_ACTION, name, handler);
    }

    function doAction(name, ...parameters) {
        if(!hooks[TYPE_ACTION][name]) return;

        hooks[TYPE_ACTION][name].forEach(action => {
            action.handler(...parameters);
        });
    }

    /********** FILTERS **********/

    function addFilter(name, handler, priority = 10) {
        addHook(TYPE_FILTER, name, handler, priority);
    }

    function removeFilter(name, handler) {
        removeHook(TYPE_FILTER, name, handler);
    }

    function applyFilters(name, value, ...parameters) {
        if(!hooks[TYPE_FILTER][name]) return value;

        hooks[TYPE_FILTER][name].forEach(filter => {
            value = filter.handler(value, ...parameters);
        });

        return value;
    }

    return Object.freeze({
        addAction,
        removeAction,
        doAction,
        addFilter,
        removeFilter,
        applyFilters,
    });
})();
