<template>
    <div class="m-2">
        <v-autocomplete
            :v-model="modelValue"
            :label="label"
            :items="items"
            :auto-select-first="true"
            :clear-on-select="true"
            @input="$emit('update:modelValue', $event.target.value)"
        ></v-autocomplete>
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
    data(){
        return{
            selectedItem:"",
        }
    }
}
</script>

<style>

</style>