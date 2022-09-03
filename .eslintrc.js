module.exports = {
    extends: [
        "plugin:vue/vue3-essential",
        "eslint:recommended",
        "@vue/eslint-config-typescript/recommended",
    ],
    rules: {
        'vue/no-multiple-template-root': 0,
        'vue/multi-word-component-names': 0,
        'vue/valid-v-for': 0
    },
}