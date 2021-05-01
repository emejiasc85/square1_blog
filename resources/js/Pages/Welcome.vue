<template>

<div class="bg-gray-100 overflow-x-hidden">
    <nav class="bg-white px-6 py-4 shadow">
        <div class="flex flex-col container mx-auto md:flex-row md:items-center md:justify-between">
            <div class="flex justify-between items-center">
                <div>
                    <a href="#" class="text-gray-800 text-xl font-bold md:text-2xl">Square1 Blog</a>
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
                    <div>
                        <select v-model="order" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="asc" selected>Latest</option>
                            <option value="desc">Oldest</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6" v-for="post in posts" :key="post.id">
                    <div class="w-full px-10 py-6 bg-white rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <span class="font-light text-gray-600">{{post.publication_date_formated}}</span>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="text-2xl text-gray-700 font-bold hover:underline">
                                {{ post.title }}
                            </a>
                            <p class="mt-2 text-gray-600">{{post.short_description}}</p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <a href="#" class="text-blue-500 hover:underline">Read more</a>
                            <div>
                                <a href="#" class="flex items-center">
                                    <h1 class="text-gray-700 font-bold hover:underline">{{post.author_name}}</h1>
                                </a>
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
            <a href="#" class="text-2xl font-bold">Square1 Blog</a>
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
            errors: Object,
            laravelVersion: String,
            phpVersion: String,
        },

        data(){
            return{
                posts:[],
                pagination:{},
                order:'asc',
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
