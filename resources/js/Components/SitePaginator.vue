<template>
    <div class="mt-8">
        <div class="flex">
            
            <a href="#" v-if="pagination.current_page > 1" @click.prevent="changePage(pagination.current_page - 1)" class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                previous
            </a>

            <template v-for="(n, index) in pagination.last_page">
                <a 
                    :key="'pag_'+index"
                    href="#" 
                    v-if="pagination.last_page > 1 && isVisible(index + 1)" 
                    @click.prevent="changePage(index + 1)" 
                    class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md"
                    :class="{'bg-blue-500 text-white border-blue-500' : isActive(index + 1), 'bg-white text-gray-700 border-gray-300' : !isActive(index + 1) }" 
                >
                    {{ index + 1 }}
                </a>
            </template>

            <a href="#" v-if="pagination.current_page < pagination.last_page"  @click.prevent="changePage(pagination.current_page + 1)" class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md cursor-not-allowed">
                Next
            </a>
    
        </div>
    </div>
</template>

<script>
    export default{
        props: ['pagination'],

        methods: {
            changePage(page) {
                this.$emit('changePage', page);
            },

            isActive(page) {
                return this.pagination.current_page == page;
            },

            isVisible(page) {
                if(this.isActive(page) || page == 1 || page == this.pagination.last_page) {
                    return true;
                }

                if(this.isPrevious(page, 1) || this.isPrevious(page, 2) || this.isPrevious(page, 3)) {
                    return true;
                }

                if(this.isNext(page, 1) || this.isNext(page, 2) || this.isNext(page, 3)) {
                    return true;
                }

                return false;
            },

            isPrevious(page, diff) {
                return page == parseInt(this.pagination.current_page) - parseInt(diff);
            },

            isNext(page, diff) {
                return page == parseInt(this.pagination.current_page) + parseInt(diff);
            }
        }
    }
</script>
