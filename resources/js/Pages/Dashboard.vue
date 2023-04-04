<template>
        <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-20"  src="/ima/sc2_ic.png" alt="">
        </div>
    </div>
   <main
        class="bg-white max-w-lg mx-auto p-2 pb-8 md:p-4 md:pb-12 my-5 rounded-lg shadow-2xl"
    >
        <div class="text-center">
            <img class="inline" src="/ima/sc_ic.png">
        </div>
        <div class="grid grid-cols-12 gap-1">
        <div class="col-span-1">
        </div>
        <div class="col-span-9">
        <h3 class="font-bold text-2xl text-center">Seguro procesado correctamente
        </h3>
        </div>
        <div class="col-span-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
        </div>
        </div>
        <div class="text-center">
            <img class="inline h-12 w-25" src="/ima/sura-logo-act.png">
            <iframe
                :src="'https://multiseguros.com.do/Seg_V2Dev/Admin/Sist.Sucursal/Seguro/poliza.php?id='+transactionId"
                width="100%"
                height="630"
                frameborder="0" >
            </iframe>

             <div class="mt-5">
                    <a class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 px-6 mt-2 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" href="https://api.whatsapp.com/send/?phone=18297624444&text&type=phone_number&app_absent=0">WhatsApp</a>
                </div>
        </div>
    </main>
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { watch } from '@vue/runtime-core';
    export default {
        components: {
            Head,
            Link
        },
        data(){
            return{
                form:{
                    ResponseCode: '00',
                    TransactionID: '25',
                    RemoteResponseCode: '00',
                    AuthorizationCode: '012355',
                    RetrivalReferenceNumber: '000000029380',
                    TxToken: '000000029380'
                }
            }
        },
        methods:{
        submit(){
            this.$inertia.post(this.route('statusPayment'), this.form)
        }
        }
    }
</script>