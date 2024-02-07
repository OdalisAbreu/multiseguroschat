<template>
  
<form class="w-full">   
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ligth:text-white">{{labelName}}</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 ligth:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input 
            :id="id"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 ligth:bg-gray-700 ligth:border-gray-600 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-blue-500 ligth:focus:border-blue-500" 
            :class="{'invalid': error}"
            :placeholder="placeholder"
            :labelName="labelName"
            :value="modelValue"
            :type="typeInput"
            :disabled="disabled"
            @input="$emit('update:modelValue', $event.target.value)"
            @focus="$emit('focus',$event)"
            >
        <button 
            type="submit" 
            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ligth:bg-blue-600 ligth:hover:bg-blue-700 ligth:focus:ring-blue-800"
            >Search</button>
    </div>
    <div class="relative w-full">
        <span v-if="error" class="text-red-500 float-left">{{
            errorMessage
        }}</span>
    </div>
</form>

</template>

<script>
export default {
    name:"SearchInput",
    props: {
        id: String,
        labelName: {
            type: String,
            required: true,
            default: "Label",
        },
        modelValue: { type: String, required: true },
        isObligatory: { type: Boolean, default: false,},
        typeInput: { type: String, default: "search"},
        placeholder: {type: String, default: "Search"},
        errorMessage:String,
        error:Boolean,
        disabled:Boolean

    },

}
</script>

<style>
.invalid {
    background-color: pink;
    border: solid 1px red;
}
</style>