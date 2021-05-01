<template>
    <div class="bg-gray-100 overflow-x-hidden">
        <nav class="bg-white px-6 py-4 shadow">
            <div class="flex flex-col container mx-auto md:flex-row md:items-center md:justify-between">
                <div class="flex justify-between items-center">
                    <div>
                        <inertia-link href="/" class="text-gray-800 text-xl font-bold md:text-2xl flex">
                            <img src="/images/logo.jpeg" class="flex-col" alt="square1"> <span class="flex-col pt-1 ml-2"> Blog</span>
                        </inertia-link>
                    </div>
                    <div>
                        <button type="button" class="block text-gray-800 hover:text-gray-600 focus:text-gray-600 focus:outline-none md:hidden">
                            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                <path d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div v-if="canLogin" class="md:flex flex-col md:flex-row md:-mx-4 hidden">
                    <inertia-link v-if="$page.props.auth.user" href="/dashboard" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">
                        Dashboard
                    </inertia-link>

                    <template v-else>
                        <inertia-link :href="route('login')" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">
                            Log in
                        </inertia-link>

                        <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">
                            Register
                        </inertia-link>
                    </template>
                </div>
            </div>
        </nav>
        <div class="px-6 py-8">
            <div class="flex justify-between container mx-auto">
                <div class="w-full">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                        
                        <div class="flex">
                            <div class="relative mx-auto text-gray-600 mr-2">
                                <input 
                                    v-model="search" 
                                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                    type="text" 
                                    name="search" 
                                    placeholder="Search"
                                    ref="search"
                                    @keyup.enter="index"
                                >
                                <button type="submit" class="absolute right-0 top-0 mt-3 mr-4" @click.prevent="index">
                                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                        width="512px" height="512px">
                                        <path
                                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                    </svg>
                                </button>
                            </div>
                            <select v-model="order" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="desc" selected>Latest</option>
                                <option value="asc">Oldest</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6" v-for="post in posts" :key="post.id">
                        <div class="w-full px-10 py-6 bg-white rounded-lg shadow-md">
                            <div class="flex justify-between items-center">
                                <span class="font-light text-gray-600">{{post.publication_date_formated}}</span>
                            </div>
                            <div class="mt-2">
                                <inertia-link :href="post.url" class="text-2xl text-gray-700 font-bold hover:underline">
                                    {{ post.title }}
                                </inertia-link>
                                <p class="mt-2 text-gray-600">{{post.short_description}}</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <inertia-link :href="post.url" class="text-blue-500 hover:underline">
                                    Read more
                                </inertia-link>
                                <div>
                                    <div class="flex items-center">
                                        <h1 class="text-gray-700 font-bold hover:underline">{{post.author_name}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <paginator :pagination="pagination" @changePage="index" ></paginator>
                </div>
            </div>
        </div>
        <footer class="px-6 py-2 bg-gray-800 text-gray-100">
            <div class="flex flex-col justify-between items-center container mx-auto md:flex-row">
                <inertia-link href="/" class="text-2xl font-bold">
                    Square1 Blog
                </inertia-link>
                <p class="mt-2 md:mt-0">All rights reserved 2021.</p>
            </div>
        </footer>
    </div>
</template>

<script>

    import Post from '@/Models/Post';
    import Paginator from '@/Components/SitePaginator';
    
    export default {
        components:{
            Paginator
        },

        props: {
            auth: Object,
            canLogin: Boolean,
            canRegister: Boolean,
        },

        data(){
            return{
                posts:[],
                pagination:{},
                order:'desc',
                search:''
            }
        },

        created(){
            this.index();
        },

        methods:{
            index(page = 1){
                let parameters = {
                    page:page,
                    search:this.search,
                    order_col:'publication_date',
                    order: this.order
                };

                Post.get(parameters, data => {
                    this.posts = data.data;
                    this.pagination = data.meta;
                });
            }
        },
        watch:{
            order(){
                this.index();
            }
        }

    }
</script>
