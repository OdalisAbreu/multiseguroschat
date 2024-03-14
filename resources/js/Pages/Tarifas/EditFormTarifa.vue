<template>
<div class="w-full bg-white p-2 border border-gray-200 rounded-lg shadow ligth:bg-gray-800 ligth:border-gray-700">
    <div class="grid gap-2 grid-cols-1">
        <CustomInput
            v-model="data.tipoDeVehiculo"
            :label-name="'Nombre'"
            :typeInput="'text'"
            :readonly="true"
            :disabled="true"
        />
    </div>
    <div class="grid gap-2 grid-cols-3">
        <CustomInput
            v-model="data.priceThreeMonths"
            :label-name="'Precio (3 Meses)'"
            :typeInput="'number'"
        />
        <CustomInput
            v-model="data.priceSixMonths"
            :label-name="'Precio (6 Meses)'"
            :typeInput="'number'"
        />
        <CustomInput
            v-model="data.priceTwelveMonths"
            :label-name="'Precio (12 Meses)'"
            :typeInput="'number'"
        />
        <CustomInput
            v-model="data.DanosPropiedadAjena"
            :label-name="'DPA'"
            :typeInput="'text'"
            :readonly="true"
            :disabled="true"
        />
        <CustomInput
            v-model="data.ResponsabilidadCivil"
            :label-name="'RC'"
            :typeInput="'text'"
            :readonly="true"
            :disabled="true"
        />
        <CustomInput
            v-model="data.ResponsabilidadCivil2"
            :label-name="'RC2'"
            :typeInput="'text'"
            :readonly="true"
            :disabled="true"
        />
        <CustomInput
            v-model="data.FianzaJudicial"
            :label-name="'FJ'"
            :typeInput="'text'"
            :readonly="true"
            :disabled="true"
        />
        <CustomInput
            v-model="data.UnaPersona"
            :label-name="'AP'"
            :typeInput="'text'"
            :readonly="true"
            :disabled="true"
        />
    </div>
</div>
<CustomInput
    v-model="data.placas"
    :label-name="'Identificador de Placas'"
    :typeInput="'text'"
    :readonly="true"
    :disabled="true"
/>
</template>

<script>
import CustomInput from '../../components/CustomInput.vue'

export default {
    name:"EditFormTarifa",
    components:{
        CustomInput,
    },
    props:{
        data:Object,
    }

}
</script>

<style>

</style>