<template>
    <section class="bg-gray-200">
        <Header :width="90" />
        
        <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4 ">
                <div class="text-center">
                  <!--<img class="inline h-12 w-25" src="/ima/sura-logo-act.png"><br>--> 
                    <h2 class="font-bold text-2xl text-center">Espere un momento… Estamos procesando su pago.</h2><br>
                    <div class="grid grid-cols-3 gap-1"> 
                        <div class="col-span-1">
                        </div>
                        <div class="col-span-1">
                            <div class="half-circle-spinner">
                                <div class="circle circle-1"></div>
                                <div class="circle circle-2"></div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <input type="hidden" placeholder="ResponseCode" v-model="form.ResponseCode">
                        <input type="hidden" placeholder="TransactionID" v-model="form.TransactionID">
                        <input type="hidden" placeholder="RemoteResponseCode" v-model="form.RemoteResponseCode">
                        <input type="hidden" placeholder="AuthorizationCode" v-model="form.AuthorizationCode">
                        <input type="hidden" placeholder="RetrivalReferenceNumber" v-model="form.RetrivalReferenceNumber" >
                        <input type="hidden" placeholder="TxToken" v-model="form.TxToken" >
                    </form>
                    
                </div>
        </section>
        <Footer class="mt-4" />
    </section>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

export default {
    components:{
        Head,
        Link,
        Header,
        Footer,
    },
    props:{
        ResponseCode: String,
        TransactionID: String,
        RemoteResponseCode: String,
        AuthorizationCode: String,
        RetrivalReferenceNumber: String,
        TxToken: String,
    },
        data(){
            return{
                form:{
                     ResponseCode: this.ResponseCode,
                    TransactionID: this.TransactionID,
                    RemoteResponseCode: this.RemoteResponseCode,
                    AuthorizationCode: this.AuthorizationCode,
                    RetrivalReferenceNumber: this.RetrivalReferenceNumber,
                    TxToken: this.TxToke
                    /*ResponseCode: '00',
                    TransactionID: '91',
                    RemoteResponseCode: '00',
                    AuthorizationCode: '055209',
                    RetrivalReferenceNumber: '000000000004',
                    TxToken: '000000000001'*/
                }
            }
        },
        mounted(){
            console.log('Entro')
            this.$inertia.post(this.route('generatePolicynew'), this.form)
        },
        methods:{
            submit(){
                this.$inertia.post(this.route('generatePolicynew'), this.form)
            }
        }
}
</script>
<style scoped>
.half-circle-spinner, .half-circle-spinner * {
      box-sizing: border-box;
    }

    .half-circle-spinner {
      width: 100px;
      height: 100px;
      border-radius: 100%;
      position: relative;
    }

    .half-circle-spinner .circle {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      border-radius: 100%;
      border: calc(60px / 10) solid transparent;
    }

    .half-circle-spinner .circle.circle-1 {
      border-top-color: #388FFF;
      animation: half-circle-spinner-animation 1s infinite;
    }

    .half-circle-spinner .circle.circle-2 {
      border-bottom-color: #388FFF;
      animation: half-circle-spinner-animation 1s infinite alternate;
    }

    @keyframes half-circle-spinner-animation {
      0% {
        transform: rotate(0deg);

      }
      100%{
        transform: rotate(360deg);
      }
    }
</style>
