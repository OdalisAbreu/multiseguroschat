<template>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ligth:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-2 md:p-2 border-b rounded-t ligth:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 ligth:text-white">
                    {{headerTitle}}
                </h3>
                <button type="button" 
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center ligth:hover:bg-gray-600 ligth:hover:text-white" 
                    data-modal-toggle="crud-modal"
                    @click="$emit('closed-modal',$event)"
                >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4">
                <slot name="body"></slot>
            <!-- Modal footer -->
            </form>
            <div class="flex items-center p-2 border-t border-gray-200 rounded-b ligth:border-gray-600">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</div> 

</template>

<script>
export default {
    name:'CustomModal',
    props:{
        headerTitle:String
    }


}
</script>

<style>
#crud-modal {
    background: rgba(0, 0, 0, 0.7);
}
</style>