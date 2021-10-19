<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <clock></clock>
                        <alumnsTable></alumnsTable>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import clock from './clock.vue'
    import alumnsTable from './alumnsTable.vue'

    export default {
        components: { 
            clock,
            alumnsTable
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
