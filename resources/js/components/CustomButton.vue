<template>
    <div
        class="min-w-36 min-h-content justify-self-center self-center text-center"
        :class="Class"
    >
        <button
            :id="id"
            :disabled="disabled"
            class="w-full justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-2 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full"
            @click="$emit('submitButton')"
        >
            {{Text}}
        </button>
    </div>
</template>

<script>
export default {
    name:"CustomButton",
    props:{
        id: String,
        Text:{
            type:String,
            default:"Button"
        },
        disabled:Boolean,
    }
};
</script>

<style></style>
