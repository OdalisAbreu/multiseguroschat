<template>
    <div class="m-2">
        <v-combobox
            :value="modelValue"
            :label="label"
            :items="items"
            :auto-select-first="true"
            :clear-on-select="true"
            :clearable="true"
            variant='solo-filled'
            @update:modelValue="$emit('update:modelValue', $event);"
        ></v-combobox>
    </div>
</template>

<script>
export default {
    name:'CAutoComplete',
    props:{
        label:String,
        items:Array,
        modelValue:String
    },
    methods: {
    },
    data() {
        return {
            search: ''
        }
    },
}
</script>

<style>

</style>