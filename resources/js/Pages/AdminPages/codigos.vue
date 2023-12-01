/<script setup>
import axios from "axios";
import Nav from "../../components/Nav.vue";
import Sider from "../../components/Sider.vue";
</script>

<template><section class="w-full h-full pb-8">
    <div>
        <Nav :routeName="'Codigo de descuento'" class="fixed" />
    </div>
    <Sider />
    <div class="w-screen flex flex-col justify-center items-center pt-20">
        <div class="pt-20 columns-2 max-w-xl ">
            <div class="col">
                <input type="text" id="codigo" placeholder="Escribe tu Codigo" class="rounded-lg  border-gray-300 w-full" v-model="codigoDescuento">
                <input type="number" id="descuento" placeholder="Monto descuento %" class="rounded-lg  border-gray-300 w-full mt-5" v-model="porcentaje"> 
            </div>
            <div>
                <input type="button" value="Crear" id="btn-crearCodigo" class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-2" :onClick="crearCodigo">
                <input type="button" value="Generar" id="btn-crearCodigo" class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-2 mt-5">
            </div>
        </div>
          <div class="w-full flex flex-col justify-center items-center mt-10">
              <h1>Codigos de Descuento</h1>
              <div class="w-10/12 max-w-xl Consulta-Responsive flex justify-center">
                  <table class="w-full divide-y divide-gray-200">
                            <thead class="w-full bg-gray-50 text-center">
                                <tr class="w-full">
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Codigo
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Descuento %
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Activo
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="w-full divide-y divide-gray-200 text-center">
                                <tr class="w-full" v-for="(codigo, index) in codigos" :key="index">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ codigo.code }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                    {{ codigo.discount_amount }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                    {{ codigo.active }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-red-600 whitespace-nowrap">
                                     <button v-on:click="deleteCodigo(codigo.id)">Delete</button> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
              </div>
          </div>
      </div>
</section>
</template>

<script>
export default {
    name: "Codigos",
    data() {
        return { 
            codigos: [],
            codigoDescuento: '',
            porcentaje: '',
        };
    },
    beforeCreate() {
        axios.get("/api/internal/codigoDescuento")
            .then((response) => {
                this.codigos = response.data;
               // console.log(this.codigos)
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
    methods: {
        crearCodigo(){
            axios.post("/api/internal/codigoDescuento",{
                code: this.codigoDescuento,
                discount_amount: this.porcentaje
            })
            .then((response) => {
                this.codigos = response.data;
                this.codigoDescuento = '';
                this.porcentaje = '';
                alert('Codigo creado')
            })
            .catch((error) => {
                console.log(error.response);
            });
        },
        deleteCodigo(id){
            console.log(id)
            axios.delete("/api/internal/codigoDescuento/"+id)
            .then((response) => {
                this.codigos = response.data;
                alert('Codigo Eliminado')
            })
            .catch((error) => {
                console.log(error.response);
            });
        }
    }
}
</script>