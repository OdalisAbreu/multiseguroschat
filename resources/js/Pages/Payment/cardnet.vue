<template>
    <section
        class="h-screen w-screen bg-white overflow-y-scroll"
        :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }"
    >
        <!--  <Header :width="95" /> -->

        <div
            v-if="Loading"
            class="fixed inset-0 flex items-center justify-center z-50"
        >
            <svg
                aria-hidden="true"
                role="status"
                class="inline w-12 h-12 text-gray-200 animate-spin dark:text-gray-600"
                viewBox="0 0 100 101"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor"
                />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="#E5E7EB"
                />
            </svg>
        </div>

        <main
            class="bg-white p-8 mt-5 shadow-2xl w-full h-full mx-auto overflow-y-scroll"
        >
            <form
                :action="`${paymentUrl}`"
                method="POST"
                name="CardNet"
                class="CardNet flex flex-col justify-center items-center"
                id="CardNet"
            >
                <input
                    type="hidden"
                    name="TransactionType"
                    id="TransactionType"
                    value="0200"
                />
                <input
                    type="hidden"
                    name="CurrencyCode"
                    id="CurrencyCode"
                    value="214"
                />
                <input
                    type="hidden"
                    name="AcquiringInstitutionCode"
                    id="AcquiringInstitutionCode"
                    value="349"
                />
                <input
                    type="hidden"
                    name="MerchantType"
                    id="MerchantType"
                    v-model="form.merchanttype"
                />
                <input
                    type="hidden"
                    name="MerchantNumber"
                    id="MerchantNumber"
                    v-model="form.merchantnumber"
                />
                <input
                    type="hidden"
                    name="MerchantTerminal"
                    id="MerchantTerminal"
                    v-model="form.merchantterminal"
                />
                <input
                    type="hidden"
                    name="ReturnUrl"
                    id="ReturnUrl"
                    v-model="form.urlreturn"
                />
                <input
                    type="hidden"
                    name="CancelUrl"
                    id="CancelUrl"
                    v-model="form.urlreturn"
                />
                <input
                    type="hidden"
                    name="PageLanguaje"
                    id="PageLanguaje"
                    value="ESP"
                />
                <input
                    type="hidden"
                    name="OrdenId"
                    id="OrdenId"
                    v-model="form.transaction_uuid"
                />
                <input
                    type="hidden"
                    name="TransactionId"
                    id="TransactionId"
                    v-model="form.transactionid"
                />
                <input
                    type="hidden"
                    name="Amount"
                    id="Amount"
                    v-model="form.total"
                />
                <input type="hidden" name="Tax" id="Tax" v-model="form.tax" />
                <input
                    type="hidden"
                    name="MerchantName"
                    id="MerchantName"
                    v-model="form.client_name"
                />
                <input
                    type="hidden"
                    name="KeyEncriptionKey"
                    id="KeyEncriptionKey"
                    v-model="form.transaction_uuid"
                />
                <input
                    type="hidden"
                    name="Ipclient"
                    id="Ipclient"
                    v-model="form.clientip"
                />
                <input type="hidden" name="loteid" Value="001" />
                <input type="hidden" name="seqid" id="seqid" Value="001" />

                <div
                    class="w-full mt-5 mx-5 my-4 pb-8 justify-self-center self-center text-center"
                >
                    <button
                        :onclick="(Loading = true)"
                        ref="myButton"
                        class="w-2"
                    ></button>
                </div>
            </form>
        </main>
    </section>
    <!--  <Footer class="absolute bottom-0 w-screen"></Footer>-->
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import axios from "axios";

export default {
    components: {
        Header,
        Footer,
        Head,
        Link,
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
        paymentUrl: String,
    },
    mounted() {
        console.log(this.paymentUrl);
        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get("/api/V1/validarVista/" + this.client_id + "/Pago Carnet");
        this.sendPayment();
        key = md5(
            this.merchanttype +
                this.merchantnumber +
                this.merchantterminal +
                this.transactionid +
                this.total +
                this.value
        );

        console.log(key);
        console.log(this.clientip);
    },
    data() {
        return {
            Loading: false,
            form: {
                total: this.total + "00",
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
                client_name: this.client_name,
            },
        };
    },
    methods: {
        submit() {
            this.Loading = true;
            axios.post(
                this.route("https://testsecureacceptance.cybersource.com/pay"),
                this.form
            );
            //this.$inertia.psot(this.route('test.test', this.this.form))
        },
        sendPayment() {
            const button = this.$refs.myButton;

            // Disparar el evento de clic en el botón
            button.click();
        },
    },
};
</script>
