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
                    <article class="py-12 px-4">
                        <h1 class="text-4xl text-center mb-4 font-semibold font-heading font-semibold">{{post.title}}</h1>
                        <p class="text-center">
                            <span>{{publication_date}}</span>
                            <span class="ml-1 text-indigo-600 hover:underline">{{author_name}}</span>
                        </p>
                        <div class="max-w-3xl mx-auto">
                            <p v-html="post.description"></p>
                        </div>
                    </article>
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
    export default {
        props: {
            auth: Object,
            canLogin: Boolean,
            canRegister: Boolean,
            post:Object,
            author_name:String,
            publication_date:String
        },
    }
</script>
