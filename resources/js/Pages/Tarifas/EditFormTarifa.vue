<template>
<div class="w-full bg-white p-2 border border-gray-200 rounded-lg shadow ligth:bg-gray-800 ligth:border-gray-700">
    <div class="grid gap-2 grid-cols-2">
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
        />
        <CustomInput
            v-model="data.ResponsabilidadCivil"
            :label-name="'RC'"
            :typeInput="'text'"
        />
        <CustomInput
            v-model="data.ResponsabilidadCivil2"
            :label-name="'RC2'"
            :typeInput="'text'"
        />
        <CustomInput
            v-model="data.FianzaJudicial"
            :label-name="'FJ'"
            :typeInput="'text'"
        />
        <CustomInput
            v-model="data.UnaPersona"
            :label-name="'AP'"
            :typeInput="'text'"
        />
    </div>
    <div class="mt-2">
        <label class="pt-1 font-bold">Notas</label>
        <textarea v-model="data.note_cobertura" class="w-full h-24 border border-gray-300 rounded-lg p-2" rows="5" cols="40"></textarea>
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
        data:Object
    }

}
</script>

<style>

</style>