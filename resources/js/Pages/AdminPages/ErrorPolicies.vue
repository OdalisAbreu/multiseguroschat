/<script setup>
import axios from "axios";
import Nav from "../../components/Nav.vue";
import Sider from "../../Components/Sider.vue";
</script>
<template>
    <section class="w-full h-full pb-8">
        <div>
            <Nav :routeName="'Regenerar Póliza'" class="fixed" />
        </div>
        <Sider />
        <div class="w-screen flex flex-col justify-center items-center pt-20">
                      <div class="w-full flex flex-col justify-center items-center mt-10">
              <h1>Codigos de Descuento</h1>
              <div class="w-10/12 max-w-xl Consulta-Responsive flex justify-center">
                  <table class="w-full divide-y divide-gray-200">
                            <thead class="w-full bg-gray-50 text-center">
                                <tr class="w-full">
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        No.
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Telefono
                                    </th>
                                      <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        No. Autorización 
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Total Póliza 
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Estatus 
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Detalle Error 
                                    </th>
                                    <th scope="col"
                                        class=" text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="w-full divide-y divide-gray-200 text-center">
                                <tr class="w-full" v-for="transaction in transactionDetail">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ transaction.id  }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ transaction.invoice.client.name }} {{ transaction.invoice.client.lastname  }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ transaction.invoice.client.phonenumber  }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ transaction.invoice.AuthorizationCode  }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ transaction.invoice.totalGeneral  }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ transaction.status  }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ transaction.error  }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-blue-600 whitespace-nowrap">
                                     <CustomButton :Text="'Enviar'" />
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
import CustomButton from '../../components/CustomButton.vue';
export default {
    name: "ProvisionalErrorPolicies",
    components:{
        CustomButton
    },
    props: {
        transactionDetail: Object
    },
    data() {
        return{
        }
    },
    mounted() {
        console.log(this.transactionDetail)
    }
}
</script>

<style>

</style>