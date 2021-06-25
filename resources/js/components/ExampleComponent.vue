<script>
  import { mapState } from 'vuex';
  export default {
    data(){
      return {
        searchQuery: '',
        currentSort:'name',
        currentSortDir:'asc',
        pageSize:5,
        currentPage:1
      }
    },
    created() {
      this.$store.dispatch("getBooks")
    },
    computed:{
      ...mapState({
        'books': (state) => state.books
      }),

      filterTable(){
          return this.books.filter((item)=>{
            if(this.searchQuery == '') return this.books;
            return this.searchQuery.toLowerCase().split(' ').every(v => item.name.toLowerCase().includes(v))
          })
      },

      sortTable(){
        return this.filterTable.sort((a,b) => {
          let modifier = 1;
          if(this.currentSortDir === 'desc') modifier = -1;
          if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
          if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
          return 0;
        }).filter((row, index) => {
          let start = (this.currentPage-1)*this.pageSize;
          let end = this.currentPage*this.pageSize;
          if(index >= start && index < end) return true;
        });
      }
    },

    methods:{
      sort(s) {
        if(s === this.currentSort) {
          this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
        }
        this.currentSort = s;
      },

      nextPage(){
        if((this.currentPage*this.pageSize) < this.books.length) this.currentPage++;
      },

      prevPage(){
        if(this.currentPage > 1) this.currentPage--;
      }

    }
  }
</script>

<template>
  <div class="w-screen h-screen bg-white flex flex-row flex-wrap p-3">
    <div class="mx-auto w-2/2">
      <div class="rounded-lg shadow-lg bg-gray-600 w-full flex flex-row flex-wrap p-3 antialiased" style="
          background-image: url('https://images.unsplash.com/photo-1578836537282-3171d77f8632?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80');
          background-repeat: no-repat;
          background-size: cover;
          background-blend-mode: multiply;
          ">
        <div class="table-responsive"> 
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

            <div class="mb-2 flex flex-row flex-wrap space-x-4">
              <div class="mr-5 ml-4 float-right bg-white font-bold rounded w-2/4 py-2 px-3 text-gray-700 leading-tight ">Basic table built vue, vuex, tailwind css and laravel</div>
              <!-- <div class="mr-5"></div> -->
              <input class="ml-5 shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="search" v-model="searchQuery" placeholder="Filter table by book name">
            </div>

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr style="cursor: pointer">
                    <th @click="sort('id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      ID 
                    </th>
                    <th @click="sort('name')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      Name <font-awesome-icon icon="chevron-down" />
                    </th>
                    <th @click="sort('isbn')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      ISBN <font-awesome-icon icon="chevron-down" />
                    </th>
                    <th @click="sort('authors')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      Authors 
                    </th>
                    <th @click="sort('country')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      Country <font-awesome-icon icon="chevron-down" />
                    </th>
                    <th @click="sort('number_of_pages')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      Pages <font-awesome-icon icon="chevron-down" />
                    </th>
                    <th @click="sort('publisher')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      Publisher <font-awesome-icon icon="chevron-down" />
                    </th>
                    <th @click="sort('released_date')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                      Release Date <font-awesome-icon icon="chevron-down" />
                    </th>
                  </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-if="books.length < 1">
                    <td colspan="8" class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">zero books found in our store</td>
                  </tr>
                  <tr v-for="(book, index) in sortTable" :key="index">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{index + 1}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{book.name}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{book.isbn}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{book.authors.join(', ')}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{book.country}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{book.number_of_pages}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{book.publisher}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{book.released_date}}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="px-4 py-3 flex items-center justify-between sm:px-6">
              <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                  <p class="text-sm text-white">
                    Showing page(s)
                    <span class="font-medium">{{ currentPage }}</span>
                    of
                    <span class="font-medium">{{Math.ceil(books.length / 5)}}</span>
                  </p>
                </div>
                <div>
                  <div class="flex-1 flex justify-between sm:hidden">
                    <button @click="prevPage" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                      Previous
                    </button>
                    <button @click="nextPage" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>





          </div>
        </div>
      </div>
    </div>
  </div> 
</template>

