<template>
    <section class="w-full h-full pb-8">                
        <Nav :routeName="'Reportes de Pólizas'" class="fixed" />    
        <Sider />
        <div class="w-full max-w-screen-xl mx-auto flex flex-col justify-center items-center pt-20">
            <h1 class="text-2xl font-semibold mb-4" style="margin-top: 50px;">Reportes de Ventas de Póliza:</h1>
            <div class="flex space-x-4 mb-4">
                <label for="startDate">Inicio:</label>
                <input type="date" id="startDate" name="startDate" v-model="startDate" />
                <label for="endDate">Fin:</label>
                <input type="date" id="endDate" name="endDate" v-model="endDate" />
            </div>
            <div style="display: flex; justify-content: space-between; gap: 10px;">
                <button @click="generateReport" class="bg-blue-500 text-white py-2 px-4 rounded-full flex items-center space-x-2">
                    <span>Generar Reporte</span>
                </button>
                <button class="bg-green-500 text-white py-2 px-4 rounded-full flex items-center space-x-2">
                    <span>Descargar</span>
                    <img src="../../../assets/excelLogo.svg" alt="Excel Logo" class="h-4 w-4" />
                </button>
            </div>
            <div class="flex justify-around mt-8 w-full" style="margin-bottom: 35px;">
                <div class="bg-blue-200 p-4 rounded-md text-center w-1/4">
                    <p>Total Transferencias completadas</p>
                    <span>{{ total_complete }}</span>
                </div>
                <div class="bg-yellow-200 p-4 rounded-md text-center w-1/4">
                    <p>Total Transferencias incompletas</p>
                    <span>{{ total_incomplete }}</span>
                </div>
                <div class="bg-orange-200 p-4 rounded-md text-center w-1/4">
                    <p>Total Servicios Opcionales vendidos</p>
                    <span>{{total_servicios_opcionales}}</span>
                </div>
            </div>
            <table class="w-full border divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">No. Póliza</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Aseguradora</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Vigencia</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Asegurado</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Tipo de vehículo</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Servicios opcionales</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Estatus de pago</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Monto total</th>
                        <th scope="col" class="text-center px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Acciones</th>
                    </tr>
                </thead>
                <tbody ref="invoiceTableBody" id="invoiceTableBody" class="divide-y divide-gray-200">
                    <tr v-for="invoice in invoices" :key="invoice.invoices_id" class="border">
                        <td class="px-6 py-4 whitespace-nowrap border">{{ invoice.numero_poliza }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ invoice.asegurtadora }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ invoice.policy_time }} meses</td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ invoice.cliente_nombre }} {{ invoice.cliente_apellido }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border">
                            <span>
                                {{ invoice.tipo_vehiculo }}
                                <span>
                                    <br />
                                    <p class="muted">{{ invoice.marca }} {{ invoice.modelo }}</p>
                                </span>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border">
                            <span v-if="parseServiceIds(invoice.servecios_id).length >= 1">
                                Si
                                <span>
                                    <br />
                                    <p class="muted">IDs: {{ parseServiceIds(invoice.servecios_id).join(', ') }}</p>
                                </span>
                            </span>
                            <span v-else>No</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border">{{ invoice.estatus_pago }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border">RD$ {{ invoice.total }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border">
                            <center>
                                <a :href="generatePolizaUrl(invoice.invoices_id)">
                                    <img src="../../../assets/visualizar.svg" alt="Visualizar Reporte" class="h-4 w-4" />
                                </a>
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
<style scoped>
    .muted {
    color: grey;
    }
</style>
<script setup>
    import axios from "axios";
    import Nav from "../../components/Nav.vue";
    import Sider from "../../components/Sider.vue";
</script>
<script>
    export default {
        data() {
            return {
                startDate: "",
                endDate: "",
                invoices: [],
                total_complete: 0,
                total_incomplete: 0,
                total_servicios_opcionales: 0,
            };
        },
        methods: {
            async generateReport() {
                console.log("Fecha de inicio:", this.startDate);
                console.log("Fecha Final:", this.endDate);

                if (!this.startDate || !this.endDate) {
                    alert("Por favor seleccione ambas fechas.");
                    return;
                }
                const apiUrl = `/api/V1/invoices?date_init=${this.startDate}&date_end=${this.endDate}`;
                try {
                    const response = await axios.get(apiUrl);
                    const data = response.data;
                    this.invoices = data;
                    this.updateTotals();
                    this.$refs.invoiceTableBody.scrollIntoView({ behavior: "smooth" });
                } catch (error) {
                    console.error("Error al obtener data:", error);
                }
            },
            parseServiceIds(serviceIdsString) {
                try {        
                    const serviceIdsArray = JSON.parse(serviceIdsString);            
                    if (Array.isArray(serviceIdsArray) && serviceIdsArray.length >= 1) {
                        return serviceIdsArray;
                    }
                } catch (error) {        
                    console.error("Error con los ID de servicio:", error);
                }
                return [];
            },
            updateTotals() {
                this.total_complete = 0;
                this.total_incomplete = 0;
                this.total_servicios_opcionales = 0;

                this.invoices.forEach((invoice) => {
                    const status = invoice.estatus_pago.toLowerCase();
                    if (status === 'pending') {
                        this.total_incomplete += 1;
                    } else if (status === 'accept') {
                        this.total_complete += 1;
                    }
                    const services = this.parseServiceIds(invoice.servecios_id);
                    if (services.length >= 1) {
                        this.total_servicios_opcionales += services.length;
                    }
                });
            },   
            generatePolizaUrl(invoiceId) {
                return `/admin/reporte-polizas/${invoiceId}`;
            },         
        },
    };
</script>
