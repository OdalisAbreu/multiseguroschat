<template>
    <div class="relative mx-2 min-w-48">
        <label
            for="first_name"
            class="block mb-2 text-sm font-medium text-gray-900 light:text-black"
            >{{ label }}</label
        >
        <ModelSelect
            :options="options"
            v-model="search"
            :placeholder="placeholder"
            :isDisabled="disabled"
            @update:modelValue="updateModelValue"
        />
    </div>
</template>

<script>
import { ModelSelect } from "vue-search-select";
import "vue-search-select/dist/VueSearchSelect.css";

export default {
    name: "CAutoComplete",
    components: {
        ModelSelect,
    },
    props: {
        label: String,
        options: Array,
        modelValue: String,
        disabled: Boolean,
        placeholder: String
    },
    data(){
        return {
            search: ""
        }
    },
    methods: {
        updateModelValue(newValue) {
            this.search = newValue || "";
            this.$emit("update:modelValue", this.search);
        }
    }
};
</script>

<style></style>
