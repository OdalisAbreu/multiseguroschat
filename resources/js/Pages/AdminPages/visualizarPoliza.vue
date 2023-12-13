<template>
    <section class="bg-gray-100 min-h-screen flex flex-col">
        <Nav :routeName="'Visualizar Póliza'" class="fixed top-0 w-full bg-white shadow-md z-10" />
        <Sider />
        <div class="flex flex-grow mt-20 justify-center items-center">
        <div class="w-full max-w-screen-md" style="margin-top: 25px; margin-bottom: 25px;">
            <div class="bg-white p-8 rounded-md shadow-lg mb-6">
                <h2 class="text-2xl font-bold mb-4 text-center">Datos del Asegurado</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">Asegurado:</label>
                        <span class="text-gray-700">{{ invoice.cliente_nombre }} {{ invoice.cliente_apellido }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Cédula:</label>
                        <span class="text-gray-700">{{ invoice.cliente_cedula }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Dirección:</label>
                        <span class="text-gray-700">{{ invoice.cliente_direccion }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Teléfono:</label>
                        <span class="text-gray-700">{{ invoice.cliente_celular }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 rounded-md shadow-lg mb-6">
                <h2 class="text-2xl font-bold mb-4 text-center">Datos del Vehículo</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">Tipo de Vehículo:</label>
                        <span class="text-gray-700">{{ invoice.tipo_vehiculo }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Marca:</label>
                        <span class="text-gray-700">{{ invoice.marca }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Modelo:</label>
                        <span class="text-gray-700">{{ invoice.modelo }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Año:</label>
                        <span class="text-gray-700">{{ invoice.year }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Chasis:</label>
                        <span class="text-gray-700">{{ invoice.chasis }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Placa:</label>
                        <span class="text-gray-700">{{ invoice.placa }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 rounded-md shadow-lg mb-6">
                <h2 class="text-2xl font-bold mb-4 text-center">Datos de la Póliza</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">No. Póliza:</label>
                        <span class="text-gray-700">{{ invoice.numero_poliza }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Aseguradora:</label>
                        <span class="text-gray-700">{{ invoice.asegurtadora }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Fecha de Emisión:</label>
                        <span class="text-gray-700">{{ formatDate(invoice.policy_init_time) }}</span>
                    </div>
                    <div>
                        <label class="font-semibold">Fin de Vigencia:</label>
                        <span class="text-gray-700">{{ calcPolicyEndTime(invoice.policy_init_time, invoice.policy_time) }}</span>
                    </div>                  
                </div>
            </div>                        
            <div class="bg-white p-8 rounded-md shadow-lg mb-6">
                <h2 class="text-2xl font-bold mb-4 text-center">Plan y Total Póliza</h2>
                <table class="w-full border divide-y divide-gray-200 mb-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Servicios Opcionales</th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold text-gray-500 uppercase border">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="service in optional_services" :key="service.id" class="border">
                            <td class="px-6 py-4 whitespace-nowrap border">{{ service.nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border">RD$ {{ Intl.NumberFormat('en-IN').format(calculateServicePrice(service)) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-6">
                    <label class="font-semibold">Nombre del Plan:</label>
                    <span class="text-gray-700 block">{{ `${invoice.asegurtadora} | ${invoice.policy_time} meses` }}</span>
                    <span class="text-sm text-gray-500 pl-4">RD$ {{ `Precio: ${Intl.NumberFormat('en-IN').format(calculateTotalPoliza())}` }}</span>
                </div>                                
                <div class="mb-6">
                    <label class="font-semibold">Total Servicios Adicionales:</label>
                    <span class="text-gray-700 block">{{ `${invoice.asegurtadora} | Servicios Adicionales` }}</span>
                    <span class="text-sm text-gray-500 pl-4">RD$ {{ Intl.NumberFormat('en-IN').format(calculateTotalServicePrices()) }}</span>
                </div>                                                
                <div class="mt-4">
                    <label class="font-semibold">Total Póliza:</label>
                    <span class="text-gray-700 text-2xl font-semibold">RD$ {{ Intl.NumberFormat('en-IN').format(invoice.total) }}</span>
                </div>
            </div>
            <div class="mt-8 text-center">
                <a href="/admin/reporte-polizas" class="text-blue-500 hover:underline">Volver a Reporte de Pólizas</a>
            </div>
        </div>
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
            invoice: {
                servicios_id: [],
            },
            optional_services: [],
        };
    },
    props: {
        invoices_id: String,
    },
    created: async function () {
        if (this.invoices_id) {
            const apiUrl = `/api/V1/invoice/${this.invoices_id}`;
            try {
                const response = await axios.get(apiUrl);
                const data = response.data;
                if (data && data[0]) {
                    this.invoice = data[0];     
                    this.fetchOptionalServices();                               
                } else {
                    console.error("formato invalido:", data);
                }
            } catch (error) {
                console.error("Error al obtener la data:", error);
            }
        } else {
            console.error("invoices_id no esta definido");
        }
    },
    methods: {   
        async fetchOptionalServices() {
            const serviceIdsArray = this.parseServiceIds(this.invoice.servecios_id);
            if (serviceIdsArray.length >= 1) {
                for (const serviceId of serviceIdsArray) {
                    const apiUrl = `/api/V1/service/${serviceId}`;
                    try {
                        const response = await axios.get(apiUrl);
                        this.optional_services.push(...response.data);
                    } catch (error) {
                        console.error(`Error fetching service ${serviceId}:`, error);
                    }
                }
            } else {
                console.warn("No hay ningún servicio opcional.");
            }
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            const formattedDate = new Date(dateString).toLocaleString('es-DO', options);
            return formattedDate;
        },
        calcPolicyEndTime(initTime, months) {
            const initDate = new Date(initTime);
            initDate.setMonth(initDate.getMonth() + months);
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
            };
            return initDate.toLocaleString('es-DO', options);
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
        calculateServicePrice(service) {
            if (this.invoice.policy_time === 3) {
                return service.tresmeses;
            } else if (this.invoice.policy_time === 6) {
                return service.seismeses;
            } else if (this.invoice.policy_time === 12) {
                return service.docemeses;
            } else {
                return 0; 
            }
        },
        calculateTotalPoliza() {
            return this.invoice.total - this.calculateTotalServicePrices();
        },
        calculateTotalServicePrices() {
            return this.optional_services.reduce((total, service) => {
                return total + this.calculateServicePrice(service);
            }, 0);
        },
    },
};
</script>
