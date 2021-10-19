<template>
    <h1>{{horaActual}}</h1>
</template>

<script>
const { DateTime } = require("luxon");

export default {
    name: 'clock',
    data(){
        return{
            horaActual: 'Cargando hora...'
        }
    }, 
    methods:{
        actualizarHora(){
            this.horaActual = DateTime.now().toFormat('hh:mm:ss');
        }
    },
    created() {
        setInterval(() => {this.actualizarHora()}, 1000)
    }
}
</script>
