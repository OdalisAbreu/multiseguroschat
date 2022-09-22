<template>
    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
        <div class="text-center">
            <img class="inline" src="ima/segchat.jpg">
            <h3 class="font-bold text-2xl text-center">Para procesar tu pago de manera segura pulsa Continuar </h3>
            <img class="inline"  src="/ima/secutity.png" alt="">
        </div> 
            <form action="https://testsecureacceptance.cybersource.com/pay" method="post">
                <input type="hidden" id="access_key" name="access_key" value="444844d8ec5b36acbad80fefbdc8e4b0"/>
                <input type="hidden" id="profile_id" name="profile_id" value="D0151565-28A7-4113-8F9B-402D4491B59E"/>
                <input type="hidden" id="transaction_uuid" name="transaction_uuid" v-model="form.transaction_uuid"/>
                <input type="hidden" id="signed_field_names" name="signed_field_names" value="merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data30,access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,override_custom_cancel_page,override_custom_receipt_page"/>
                <input type="hidden" id="unsigned_field_names" name="unsigned_field_names" value=""/>
                <input type="hidden" id="signed_date_time" name="signed_date_time" v-model="form.date"/>
                <input type="hidden" id="locale" name="locale" value="es"/>
                <input type="hidden" id="override_custom_cancel_page" name="override_custom_cancel_page" v-model="form.urlreturn"/>
                <input type="hidden" id="override_custom_receipt_page" name="override_custom_receipt_page" v-model="form.urlreturn"/>
                <input type="hidden" id="transaction_type" name="transaction_type" value="authorization"/>
                <input type="hidden" id="reference_number" name="reference_number" v-model="form.invoice_id"/>
                <input type="hidden" id="amount" name="amount" v-model="form.total"/>
                <input type="hidden" id="currency" name="currency" value="DOP"/>
                <input type="hidden" id="submit" name="submit" value="Submit"/>
                <input type="hidden" id="signature" name="signature" v-model="form.signature"/>
                <input type="hidden" id="merchant_defined_data1" name="merchant_defined_data1" value="Retail">
                <input type="hidden" id="merchant_defined_data2" name="merchant_defined_data2" value="visanetdr_000000432438001">
                <input type="hidden" id="merchant_defined_data3" name="merchant_defined_data3" value="Web">
                <input type="hidden" id="merchant_defined_data29" value="cedula">
                <input type="hidden" id="merchant_defined_data30" name="merchant_defined_data30" v-model="form.client_id">

                    <div class="flex flex-col">
                        <button class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200">Continuar</button>
                    </div>
        </form>
     </main>
      <footer class="bg-white rounded-lg shadow md:flex md:items-center md:justify-between dark:bg-gray-800">
        <div class="absolute inset-x-0 bottom-0 h-10 pl-4 text-gray-500 dark:text-gray-400">Seguros Chat 1.5.6</div>
    </footer>
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
       signature: String,
       urlreturn: String,
       date: String,
       client_id: String,
    },
    mounted(){
        console.log(this.total)
        console.log(this.invoice_id)
        console.log(this.signature)
        console.log(this.urlreturn)
        console.log(this.date)
    },
    data(){
        return{
            form:{
                total: this.total,
                invoice_id: this.invoice_id,
                client_id: this.client_id,
                signature: this.signature,
                urlreturn: this.urlreturn,
                date: this.date,
                transaction_uuid: 'bot2022'+this.invoice_id,
                access_key: '444844d8ec5b36acbad80fefbdc8e4b0',
                profile_id: 'D0151565-28A7-4113-8F9B-402D4491B59E',
                signed_field_names: 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,override_custom_cancel_page,override_custom_receipt_page',
                locale: 'es',
                transaction_type: 'authorization',
                currency: 'DOP',
                submit: 'Submit',
                merchant_defined_data1: 'Retail',
                merchant_defined_data2: 'visanetdr_000000432438001',
                merchant_defined_data3: 'Web',
                merchant_defined_data29: 'Cedula',
            }
        }
    },
    methods:{
        submit(){
           // axios.post(this.route('https://testsecureacceptance.cybersource.com/pay'), this.form)
           this.$inertia.psot(this.route('test.test', this.this.form))
        }
    },

}
</script>
