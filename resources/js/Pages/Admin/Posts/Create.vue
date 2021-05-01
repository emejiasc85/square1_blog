<template>
<breeze-authenticated-layout>
    <template #header>
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex-1 min-w-0">
                <ul class="flex text-gray-500 text-sm lg:text-base mb-1">
                    <li class="inline-flex items-center ">
                        <svg class="h-5 w-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        <inertia-link :href="route('dashboard')" class="">
                            back
                        </inertia-link>
                    </li>
                </ul>
                <h2 class="text-xl font-semibold leading-7 text-gray-800 leading-tight">
                    Create Post
                </h2>
            </div>
        </div>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="action.php">
                        <div class="mb-4">
                            <label class="text-xl block text-gray-600">Title <span class="text-red-500">*</span></label>
                            <input type="text" class="border-1 border-gray-300 p-2 w-full" name="title" id="title" v-model="create.title" required>
                            <p v-if="errors.title" class="text-red-500">{{ errors.title[0]}}</p>
                        </div>

                        <div class="mb-8 h-full">
                            <label class="text-xl block text-gray-600">Description <span class="text-red-500">*</span></label>
                            <vue-editor v-model="create.description"></vue-editor>
                            <p v-if="errors.description" class="text-red-500">{{ errors.description[0]}}</p>
                        </div>

                        <div class="flex p-1">
                            <button @click.prevent="store" :disabled="btn_disabled" class="mt-4 sm:mt-0 rounded-full inline-flex items-center px-4 py-2 border border-indigo-600 text-sm leading-5 font-medium rounded-md text-indigo-600 bg-trasnparent hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                                Save and publish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</breeze-authenticated-layout>
  
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
    import Post from '@/Models/Admin/Post';
    import { VueEditor } from "vue3-editor";
   

    export default {
        components: {
            BreezeAuthenticatedLayout,
            VueEditor
        },

        data(){
            return{
                btn_disabled:false,
                create:{},
                errors:{},
            }
        },


        methods:{   
            store(){
                this.btn_disabled = true;
                Post.store(this.create, data => {
                    this.btn_disabled = false;
                    this.errors={}
                    this.create       = {};
                    this.$toast.success('Your post has been published');
                },error => {
                    this.$toast.error('The given data was invalid.');
                    this.btn_disabled = false;
                    this.errors       = error;
                })
            }
        }


    }
    
</script>

<style>

</style>