import { defineStore } from 'pinia'

export const useCachePromiseStore = defineStore({
    id: 'promise',
    state: () => ({
        promises: [],
    }),
    getters: {
        getCachedPromise: (state) => {
            return (promiseKey) => {
                const result = state.promises.filter((promise) => promise.key === promiseKey)
                if (Array.isArray(result) && result.length === 1) {
                    return result[0].promise
                }
                return false
            }
        },
    },
    actions: {
        addCachedPromise(key, promise) {
            const i = this.promises.findIndex(_element => _element.key === key);
            if (i > -1) {
                this.promises[i] = {key: key, promise: promise};
            } else {
                this.promises.push({key: key, promise: promise});
            }
        },
        removeCachedPromise(key) {
            const i = this.promises.findIndex(_element => _element.key === key);
            if (i > -1) {
                this.promises.splice(i, 1);
            }
        }
    }
})