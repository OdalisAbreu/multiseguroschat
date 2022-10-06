<template>
    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
        <div class="text-center">
            <img class="inline" src="ima/sc_ic.png">
            <h3 class="font-bold text-2xl text-center">Pulsa <i>CONTINUAR</i><br> para procesar tu pago de manera segura</h3>
            <img class="inline pb-4 pt-4 max-w-xs" src="ima/cardnet-payments.jpg">
        </div> 
            <form action='https://ecommerce.cardnet.com.do/authorize' method='POST' name='CardNet' class='CardNet' id='CardNet'>
                    <input type="hidden" name='TransactionType' id='TransactionType' value='0200'/>
                    <input type="hidden" name='CurrencyCode' id='CurrencyCode' value='214'/>
                    <input type="hidden" name='AcquiringInstitutionCode' id='AcquiringInstitutionCode' value='349'/>
                    <input type="hidden" name='MerchantType' id='MerchantType' v-model="form.merchanttype"/>
                    <input type="hidden" name='MerchantNumber' id='MerchantNumber' v-model="form.merchantnumber"/>
                    <input type="hidden" name='MerchantTerminal' id='MerchantTerminal' v-model="form.merchantterminal"/>
                    <input type="hidden" name='ReturnUrl' id='ReturnUrl' v-model="form.urlreturn"/>
                    <input type="hidden" name='CancelUrl' id='CancelUrl' v-model="form.urlreturn"/>
                    <input type="hidden" name='PageLanguaje' id='PageLanguaje' value='ESP'/>
                    <input type="hidden" name='OrdenId' id='OrdenId' v-model="form.transaction_uuid"/>
                    <input type="hidden" name='TransactionId' id='TransactionId' v-model="form.transactionid"/>
                    <input type="hidden" name='Amount' id='Amount' v-model="form.total"/>
                    <input type="hidden" name='Tax' id='Tax' v-model="form.tax"/>
                    <input type="hidden" name='MerchantName' id='MerchantName' value='SURA CHAT BOT-WB'/>
                    <input type="hidden" name='KeyEncriptionKey' id='KeyEncriptionKey' v-model="form.transaction_uuid"/>
                    <input type="hidden" name='Ipclient' id='Ipclient' v-model="form.clientip"/>
                    <input type="hidden" name='loteid' Value='001' />
                    <input type="hidden" name='seqid' id='seqid' Value='001'/>

                <div class="flex flex-col">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold mx-3 py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 sm:mx-3">Continuar</button>
                </div>
        </form>
     </main>

</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
export default {
    components:{
        Head,
        Link
    },
    props:{
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
       client_name: String
    },
    mounted(){
        key = md5(
            this.merchanttype + this.merchantnumber + this. merchantterminal + this.transactionid + this.total + this.value
        )
        console.log(key)
        console.log(this.clientip)
    },
    data(){
        return{
            form:{
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
                transactionid: this.transactionid

            }
        }
    },
    methods:{
        submit(){
           axios.post(this.route('https://testsecureacceptance.cybersource.com/pay'), this.form)
           //this.$inertia.psot(this.route('test.test', this.this.form))
        }
    },

}
</script>
