<template>
    <section class="h-screen w-screen bg-white overflow-hidden">
        <Header :width="95" />
        <main class="relative bg-white p-8 mt-5 shadow-2xl w-full h-full mx-auto">
            <div class="text-center">
                <h3 class="font-bold text-2xl text-center">Pulsa <i>CONTINUAR</i><br> para procesar tu pago de
                    manera segura
                </h3>
                <h4 class="font-bold text-2xl text-center text-red-900"><i>Seguros chat no guarda información de tu tarjera
                    </i></h4>
                <img class="inline pb-4 pt-4 max-w-xs" src="ima/cardnetLogo.png">
                <img class="inline pb-4 pt-4 max-w-xs" src="ima/tarjetas.png">
            </div>
            <form :action="`${paymentUrl}`" method='POST' name='CardNet' class='CardNet flex flex-col justify-center items-center' id='CardNet'>
                <input type="hidden" name='TransactionType' id='TransactionType' value='0200' />
                <input type="hidden" name='CurrencyCode' id='CurrencyCode' value='214' />
                <input type="hidden" name='AcquiringInstitutionCode' id='AcquiringInstitutionCode' value='349' />
                <input type="hidden" name='MerchantType' id='MerchantType' v-model="form.merchanttype" />
                <input type="hidden" name='MerchantNumber' id='MerchantNumber' v-model="form.merchantnumber" />
                <input type="hidden" name='MerchantTerminal' id='MerchantTerminal' v-model="form.merchantterminal" />
                <input type="hidden" name='ReturnUrl' id='ReturnUrl' v-model="form.urlreturn" />
                <input type="hidden" name='CancelUrl' id='CancelUrl' v-model="form.urlreturn" />
                <input type="hidden" name='PageLanguaje' id='PageLanguaje' value='ESP' />
                <input type="hidden" name='OrdenId' id='OrdenId' v-model="form.transaction_uuid" />
                <input type="hidden" name='TransactionId' id='TransactionId' v-model="form.transactionid" />
                <input type="hidden" name='Amount' id='Amount' v-model="form.total" />
                <input type="hidden" name='Tax' id='Tax' v-model="form.tax" />
                <input type="hidden" name='MerchantName' id='MerchantName' v-model="form.client_name" />
                <input type="hidden" name='KeyEncriptionKey' id='KeyEncriptionKey' v-model="form.transaction_uuid" />
                <input type="hidden" name='Ipclient' id='Ipclient' v-model="form.clientip" />
                <input type="hidden" name='loteid' Value='001' />
                <input type="hidden" name='seqid' id='seqid' Value='001' />

                <div class="w-full mt-5 mx-5 my-4 justify-self-center self-center text-center">
                    <button
                        class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
                        Continuar
                    </button>
                </div>
            </form>
        </main>
    </section>
    <!--  <Footer class="absolute bottom-0 w-screen"></Footer>-->
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

export default {
    components: {
        Header,
        Footer,
        Head,
        Link
    },
    props: {
        total: String,
        invoice_id: String,
        client_id: String,
        urlreturn: String,
        date: String,
        tax: String,
        merchanttype: String,
        merchantnumber: String,
        merchantterminal: String,
        transactionid: String,
        clientip: String,
        client_name: String,
        paymentUrl: String
    },
    mounted() {
        key = md5(
            this.merchanttype + this.merchantnumber + this.merchantterminal + this.transactionid + this.total + this.value
        )
        console.log(key)
        console.log(this.clientip)
    },
    data() {
        return {
            form: {
                total: this.total + '00',
                invoice_id: this.invoice_id,
                client_id: this.client_id,
                signature: this.signature,
                urlreturn: this.urlreturn,
                date: this.date,
                transaction_uuid: this.invoice_id,
                key: this.key,
                tax: this.tax,
                clientip: this.clientip,
                merchanttype: this.merchanttype,
                merchantnumber: this.merchantnumber,
                merchantterminal: this.merchantterminal,
                transactionid: this.transactionid,
                client_name: this.client_name
            }
        }
    },
    methods: {
        submit() {
            axios.post(this.route('https://testsecureacceptance.cybersource.com/pay'), this.form)
            //this.$inertia.psot(this.route('test.test', this.this.form))
        }
    },

}
</script>
