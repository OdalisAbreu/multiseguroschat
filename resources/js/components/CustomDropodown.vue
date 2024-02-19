<template>
    <div class="relative mx-2 min-w-48" @blur="showOptions = false">
        <label
            for="first_name"
            class="block mb-2 text-sm font-medium text-gray-900 light:text-black"
            >{{ label }}</label
        >
        <input
            type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
            :placeholder="placeholder"
            :value="selectedOption"
            @click="toggleOptions"
        />
        <div
            v-show="showOptions"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ligth:bg-gray-700 ligth:border-gray-600 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-blue-500 ligth:focus:border-blue-500 overflow-auto max-h-48 absolute z-40"
        >
            <div>
                <div
                    class="hover:bg-blue-500 rounded"
                    v-for="option in options"
                    :key="option"
                    @click="selectOption(option)"
                >
                    {{ option }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"CustomDropdown",
    props:{
        label:String,
        options:Array,
        placeholder:String,
        modelValue:String
    },
    data() {
        return {
            selectedOption: " ",
            showOptions: false,
        };
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
        selectOption(option) {
            this.selectedOption = option;
            this.showOptions = false;
            this.$emit('update:modelValue', this.selectedOption)
        },
    },
};
</script>

<style></style>
