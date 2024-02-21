<template>
    <div class="w-full flex flex-col lg:items-center mt-1">
        <label class="pt-1 font-bold w-auto">
            {{ labelName }}
            <span v-if="required" class="text-red-400 inl">*</span>
        </label>
        <input
            class="rounded-lg w-full border border-gray-300"
            :class="{'invalid': error}"
            :id="id"
            :labelName="labelName"
            :value="modelValue"
            :type="typeInput"
            :placeholder="placeholder"
            :disabled="disabled"
            :readonly="readonly"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <div class="relative w-full">
            <span v-if="error" class="text-red-500 float-left">{{
                errorMessage
            }}</span>
        </div>
    </div>
</template>

<script>

export default {
    name: "CustomInput",
    props: {
        id: String,
        labelName: { type: String, required: true, default: "Label"},
        modelValue: { type: [String,Number, null] },
        required: { type: Boolean, default: false,},
        typeInput: { type: String, default: "text"},
        placeholder: {type: String, default: ""},
        errorMessage:String,
        error:Boolean,
        disabled:Boolean,
        readonly:Boolean

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
input[type="text"]:disabled {
    background: #f2f2f2;
    color: #ccc;
}
</style>
