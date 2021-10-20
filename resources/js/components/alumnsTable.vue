<template>
    <div class="container">
    <div v-if="showModal">
    <div ref="vuemodal" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">¿Estás seguro de que quieres eliminar a {{deleteName}} {{deleteLastname}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button v-on:click="deleteAlumn(deleteId)" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <h1 class="text-center my-5">Lista de nombres</h1>
    <form class="search form" v-on:submit.prevent="search">
        <div class="form-group d-flex">
          <input type="text" v-model="query" class="form-control" id="inputSearch" placeholder="Busque aqui">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
        <button v-on:click="initArray" type="submit" class="btn btn-primary">Limpiar busqueda</button>
    <a href="/names/create"><button type="button" class="btn btn-primary my-5">Crear nuevo nombre</button></a>
    <table class="table table-hover table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="alumn in alumns" :key="alumn.id" autofocus>
                <td>{{alumn.name}}</td>
                <td>{{alumn.lastname}}</td>
                <td class="d-flex">
                    <a :href="'/names/'+alumn.id+'/edit'" class="mr-2">
                        <i class="fas fa-user-edit"></i>
                    </a>
                    <div>
                        <i v-on:click="confirmDelete(alumn.id, alumn.name, alumn.lastname)" type="button" class="fas fa-user-slash" aria-hidden="true"></i>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
            <nav aria-label="...">
            <ul class="pagination">
                <li v-for="index in totalPages" :key="`${index}`" class="page-item">
                    <a class="page-link" v-on:click="goToPage(index)" href="#">{{index}}</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'alumns-table',
    data(){
        return{
            charging: true,
            showModal: false,
            alumns: [],
            totalPages: 0,
            query: '',
            deleteId: "", deleteName: "",deleteLastname:""
        }
    }, 
    methods:{
        deleteAlumn(id){
            axios.delete(`/names/${id}`)
            $(this.$refs.vuemodal).modal('hide');
            this.initArray();
        },
        confirmDelete(id, name, lastname){
            $(this.$refs.vuemodal).modal('show');
            this.deleteId = id;
            this.deleteName = name;
            this.deleteLastname = lastname;
            this.showModal = true;
        },
        updateArray(arrayAlumns){
            this.totalPages = arrayAlumns.names.last_page;
            this.alumns = arrayAlumns.names.data;
        },
        search(){
            axios.get(`/api/names?query=${this.query}`)
            .then(response => {
                this.updateArray(response.data);
            })
        },
        initArray(){
            this.query = ''
            axios.get('/api/names?page=1')
            .then(response => {
                this.updateArray(response.data);
            }) 
        },
        goToPage(page){
            let route = `/api/names?page=${page}`;
            if(this.query) route = `/api/names?query=${this.query}&page=${page}`;
            axios.get(route)
            .then(response => {
                this.updateArray(response.data);
            }) 
        },
    },
    mounted(){
        this.initArray();
    }
}
</script>
