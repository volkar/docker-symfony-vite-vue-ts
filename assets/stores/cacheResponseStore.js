import { defineStore } from 'pinia'

export const useCacheResponseStore = defineStore({
    id: 'cache',
    state: () => ({
        responses: [],
    }),
    getters: {
        getCachedResponse: (state) => {
            return (responseKey) => {
                const result = state.responses.filter((response) => response.key === responseKey)
                if (Array.isArray(result) && result.length === 1) {
                    return result[0].data
                }
                return false
            }
        },

    },
    actions: {
        addCachedResponse(key, data) {
            const i = this.responses.findIndex(_element => _element.key === key);
            if (i > -1) {
                this.responses[i] = {key: key, data: data};
            } else {
                this.responses.push({key: key, data: data});
            }
        }
    }
})