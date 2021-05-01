<template>
    <breeze-authenticated-layout>
        <template #header>
            <div class="md:flex lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-xl font-semibold leading-7 text-gray-800 leading-tight">
                        Posts
                    </h2>
                </div>
                <div class="mt-5 sm:flex lg:mt-0 lg:ml-4">
                    <div class="relative sm:mr-2 md:mr-2 md:mx-auto text-gray-600">
                        <input 
                            class="rounded-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none w-full"
                            type="search" 
                            name="search" 
                            placeholder="Buscar" 
                            v-model="filter.search"
                            ref="search"
                            @keyup.enter="index"
                        >
                        <button @click.passive="index" type="submit" class="absolute right-0 top-0 mt-3 mr-4 focus:border-none">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                width="512px" height="512px">
                                <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                    <inertia-link :href="route('posts.create')" class="mt-4 sm:mt-0 rounded-full inline-flex items-center px-4 py-2 border border-indigo-600 text-sm leading-5 font-medium rounded-md text-indigo-600 bg-trasnparent hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                        Create Post
                    </inertia-link>
                </div>
            </div>

            
        </template>

         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <a href="#" @click="sortBy('title')">
                                                    Title
                                                    <svg v-if="filter.order_col == 'title' && filter.order == 'asc'" class="w-4 h-4 text-gray-500 inline-flex" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                                    <svg v-if="filter.order_col == 'title' && filter.order == 'desc'" class="w-4 h-4 text-gray-500 inline-flex" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                                </a>
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                <a href="#" @click="sortBy('publication_date')">
                                                    Publication date
                                                    <svg v-if="filter.order_col == 'publication_date' && filter.order == 'asc'" class="w-4 h-4 text-gray-500 inline-flex" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                                    <svg v-if="filter.order_col == 'publication_date' && filter.order == 'desc'" class="w-4 h-4 text-gray-500 inline-flex" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                                </a>
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="post in posts" :key="post.id">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                {{post.title}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                {{post.publication_date}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5">
                                                <button  class="hover:bg-gray-200 text-gray-500 hover:text-green-500 border border-transparent font-bold py-2 px-4 rounded inline-flex items-center">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                                    Read
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <paginator :pagination="pagination" @changePage="index"></paginator>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import Post from '@/Models/Admin/Post'
    import Paginator from '@/Components/Paginator'


    export default {
        components: {
            BreezeAuthenticatedLayout,
            Paginator
        },

        data(){
            return{
                posts:[],
                filter      : {
                    order:'publication_date',
                    order_col:'desc',
                },
                pagination:{},
            }
        },

        props: {
            auth: Object,
            errors: Object,
        },

        created(){
            this.index();
        },

        methods:{

            index(page = 1){
                let parameters = {
                    page    : page,
                    order_col: this.filter.order_col,
                    order   : this.filter.order,
                    search  : this.filter.search,
                };

                Post.get(parameters, data => {
                    this.posts = data.data;
                    this.pagination = data.meta;
                    console.log(this.posts);
                });
            },

            sortBy(col){
                

                if(this.filter.order_col == '' && this.filter.order == ''){
                    this.filter.order_col = col;
                    this.filter.order    = 'desc';
                }
                
                else if(this.filter.order_col == col && this.filter.order == 'desc'){
                    this.filter.order = 'asc';

                }

                else{
                    this.filter.order_col = '';
                    this.filter.order     = '';
                }

                this.index();
            }
        }
    }
</script>
