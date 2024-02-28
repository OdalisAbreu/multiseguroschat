<template>
    <KeepAlive>
        <div class="bg-blue-700 mb-3">
            <div class="flex flex-col justify-center bg-blue-800">
                <div class="flex justify-between items-center overflow-x-hidden pr-6 bg-blue">
                    <div class="p-2">
                        <img class="w-60" src="../../../public/ima/Seguros_Chat-11.png" alt="Logo" />
                    </div>
                    <div>
                        <img class="w-8 cursor-pointer" src="../../../public/ima/menu.png" alt="Menu">
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute z-0">
                <path fill="rgb(30 64 175)" fill-opacity="1"
                    d="M0,224L120,202.7C240,181,480,139,720,138.7C960,139,1200,181,1320,202.7L1440,224L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z">
                </path>
            </svg>
        </div>
    </KeepAlive>
</template>


<script>

export default {
    name: "Header",
    props: {
        width: Number, /* Prop para asignar tamaño a barra en navegacion */
    },
}
</script>