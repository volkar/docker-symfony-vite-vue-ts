import { unref, Ref } from 'vue'
import { useCacheResponseStore } from "@/stores/cacheResponseStore";
import { useCachePromiseStore } from "@/stores/cachePromiseStore";
import ky from "ky";

export function useGetRequest(
    url: Ref<string> | string,
    key: Ref<string> | string | undefined = undefined,
) {
    const cache = useCacheResponseStore()
    const promises = useCachePromiseStore()

    // Check the cache
    let cachedResponse = false;
    if (key !== undefined) {
        cachedResponse = cache.getCachedResponse(unref(key))
    }

    if (key !== undefined && cachedResponse === false) {
        // Check cached promises and return it if available
        const cachedPromise = promises.getCachedPromise(unref(key))
        if (cachedPromise !== false) {
            return cachedPromise
        }
    }

    const newPromise = new Promise(function(resolve, reject) {

        if (cachedResponse !== false) {
            // Cached already, resolve
            resolve(cachedResponse)
        } else {
            // Retrieve data
            ky.get(unref(url)).json()
                .then((newData) => {
                    // Add to the cache
                    if (key !== undefined) {
                        cache.addCachedResponse(unref(key), newData)
                    }

                    // Remove promise from the cache
                    promises.removeCachedPromise(unref(key))

                    // Resolve
                    resolve(newData)

                })
                .catch((err) => {
                    // Reject
                    reject(err)
                })
        }
    });

    if (cachedResponse === false) {
        // Cache new promise
        promises.addCachedPromise(unref(key), newPromise)
    }

    return newPromise
}
