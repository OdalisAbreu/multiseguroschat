<template>
  <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
  <div class="flex flex-1 justify-between sm:hidden">
    <button 
      class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
      @click="previousPage"
    >Previous</button>
    <button 
      class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
      @click="nextPage"
    >Next</button>
  </div>
  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div>
      <p class="text-sm text-gray-700">
        Mostrando del
        <span class="font-medium">{{ starIndex + 1 }}</span>
        al
        <span class="font-medium">{{ endIndex }}</span>
        de
        <span class="font-medium">{{ totalItems }}</span>
        resultados
      </p>
    </div>
    <div>
      <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        <button 
          class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
          @click="previousPage"
        >
          <span class="sr-only">Previous</span>
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
          </svg>
        </button>
        <div v-for="num in showPages" :key="num">
          <a class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
              :class="{'bg-blue-600 pointer-events-none' : num === currentPage}"
              @click="goToPage(num)"
          >{{ num }}</a>   
        </div>
        <button 
          class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
          @click="nextPage"
        >
          <span class="sr-only">Next</span>
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
          </svg>
        </button>
      </nav>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name:'Pagination',
  props:{
    data: Array,
    itemPerPage:{
      type: Number,
      default: 10
    }
  },
  data() {
    return {
      currentPage: 1,
    }
  },
  methods:{
    previousPage(){
      if(this.currentPage > 1)
        this.currentPage--
    },
    nextPage(){
      if(this.currentPage < this.totalPage)
        this.currentPage++
    },
    emitPaginatedData(){
      this.$emit('starIndex',this.starIndex)
      this.$emit('endIndex',this.endIndex)
    },
    goToPage(num){
      this.currentPage = num
    }
  },
  
  watch:{
    currentPage(){
      this.emitPaginatedData()
    }
  },
  computed:{
    starIndex(){
      return (this.currentPage -1) * this.itemPerPage
    },
    endIndex(){
      const starIndex = (this.currentPage -1) * this.itemPerPage
      return starIndex + this.itemPerPage
    },
    totalPage(){
      return Math.ceil(this.totalItems / this.itemPerPage) 
    },
    totalItems(){
      return this.data.length
    },
    showPages(){
      if(this.totalPage < 9){
        return this.totalPage
      }
      else{
        debugger
        const maxButtonVisible = 9;
        const startPage = Math.max(1, this.currentPage - Math.floor(maxButtonVisible / 2));
        const endPage = Math.min(this.totalPage, startPage + maxButtonVisible - 1);
        return Array.from({ length: endPage - startPage + 1 }, (_, i) => startPage + i)
      } 
    }
  }
}
</script>

<style>
</style>