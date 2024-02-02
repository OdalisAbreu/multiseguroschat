<template>
    <div class="w-full flex flex-col lg:items-center mt-1">
        <label class="pt-1 font-bold w-auto">
            {{ labelName }}
            <span v-if="isObligatory" class="text-red-400 inl">* {{ value }}</span>
        </label>
        <input
            class="rounded-lg w-full border-gray-300"
            :class="{'invalid': error}"
            :id="id"
            :labelName="labelName"
            :value="modelValue"
            :type="typeInput"
            :placeholder="placeholder"
            :disabled="disabled"
            @input="$emit('input', $event.target.value)"
        />
    </div>
    <div class="relative w-full">
        <span v-if="error" class="text-red-500 float-left">{{
            errorMessage
        }}</span>
    </div>
</template>

<script>

export default {
    name: "CustomInput",
    props: {
        id: String,
        labelName: {
            type: String,
            required: true,
            default: "Label",
        },
        modelValue: { type: String, required: true },
        isObligatory: { type: Boolean, default: false,},
        typeInput: { type: String, default: "text"},
        placeholder: {type: String, default: ""},
        errorMessage:String,
        error:Boolean,
        disabled:Boolean

    },
    data() {
        return {};
    },
};
</script>

<style>
.invalid {
    background-color: pink;
    border: solid 1px red;
}
</style>
