

import { defineStore } from 'pinia';

export const useSetAndGetData = defineStore('setAndGetData', {
    state: () => ({
        counter: 100,
    }),
    getters: {
        getCounter: (state) => state.counter,
    },
    actions: {
        setCounter(counter) {
            this.counter = counter;
        },
    }

});