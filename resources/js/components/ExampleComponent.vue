<script>
  import { mapState } from 'vuex';
  export default {
    data(){
      return {
        searchQuery: null,
        filterQuery: null,
        currentSort:'name',
        currentSortDir:'asc'
      }
    },
    created() {
      this.$store.dispatch("getBooks")
    },
    computed:{
      ...mapState({
        'books': (state) => state.books
      }),

      filterSortTable(){
        if(this.searchQuery){
          return this.books.filter((item)=>{
            return this.searchQuery.toLowerCase().split(' ').every(v => item.title.toLowerCase().includes(v))
          })
        }else{
          return this.books;
        }

        if(this.filterQuery){
          return this.books.sort((a,b) => {
            let modifier = 1;
            if(this.currentSortDir === 'desc') modifier = -1;
            if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
            if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
            this.filterQuery = null;
            return 0;
          });
        }
      },
    },

    methods:{
      sort:function(s) {
        //if s == current sort, reverse
        this.filterQuery = '1';
        if(s === this.currentSort) {
          this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
        }
        this.currentSort = s;
      }
    }
  }
</script>

<template>
  <div class="w-screen h-screen bg-white flex flex-row flex-wrap p-3">
    <div class="mx-auto w-2/3">
      <div class="rounded-lg shadow-lg bg-gray-600 w-full flex flex-row flex-wrap p-3 antialiased" style="
          background-image: url('https://images.unsplash.com/photo-1578836537282-3171d77f8632?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80');
          background-repeat: no-repat;
          background-size: cover;
          background-blend-mode: multiply;
          ">
        <div class="table-responsive"> 
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

            <div class="mb-2 flex flex-row flex-wrap space-x-4">
              <div class="ml-4 float-right bg-white font-bold rounded w-1/3 py-2 px-3 text-gray-700 leading-tight ">Solution to test</div>
              <div class="w-1/6 "></div>
              <input class="ml-5 justify-self-end shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" v-model="searchQuery" placeholder="Filter table data">
            </div>

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th @click="sort('id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ID
                    </th>
                    <th @click="sort('name')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Name
                    </th>
                    <th @click="sort('isbn')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ISBN
                    </th>
                    <th @click="sort('authors')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Authors
                    </th>
                    <th @click="sort('country')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Country
                    </th>
                    <th @click="sort('number_of_pages')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Pages
                    </th>
                    <th @click="sort('publisher')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Publisher
                    </th>
                    <th @click="sort('released_date')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Release Date
                    </th>
                  </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-if="books.length < 1">
                    <td colspan="8" class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">zero books found in our store</td>
                  </tr>
                  <tr v-for="(book, index) in filterSortTable" :key="index">
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
                      {{book.authors}}
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
                      {{book.release_date}}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</template>

