<template>
  <div>
       <custom-input
        :labelName="'Crear Marca'"
       />
  </div>
</template>

<script>
import CustomInput from "../../../components/CustomInput.vue";

export default {
    name:'CreateBrand',
    components:{
        CustomInput
    }
}
</script>

<style>

</style>