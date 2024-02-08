<template>
    <div>
        <label
            for="first_name"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >First name</label
        >
        <input
            type="text"
            id="first_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="John"
        />
    </div>
    <div
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ligth:bg-gray-700 ligth:border-gray-600 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-blue-500 ligth:focus:border-blue-500"
    >
        <div class="options" v-show="showOptions">
            <div
                v-for="option in options"
                :key="option.value"
                @click="selectOption(option)"
            >
                {{ option }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            options: [
                { value: "US", label: "United States" },
                { value: "CA", label: "Canada" },
                { value: "FR", label: "France" },
                { value: "DE", label: "Germany" },
            ],
            selectedOption: "Choose a country",
            showOptions: false,
        };
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
        selectOption(option) {
            this.selectedOption = option.label;
            this.showOptions = false;
        },
    },
};
</script>

<style></style>
