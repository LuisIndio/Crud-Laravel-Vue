<template>
<div>
<!-- Formulario En Vue 
    <form @submit.prevent="agregar">
        <input type="text" placeholder="Titulo"
        class="form-control mb-2" v-model="anuncio.titulo"
        >
        <input type="text" placeholder="Descripcion"
        class="form-control mb-2" v-model="anuncio.descripcion"
        >
        <input type="number" placeholder="Numero"
        class="form-control mb-2" v-model="anuncio.numero"
        >
        <button class="btn btn-primary" type="submit">Agregar</button>
    </form>
-->
    <h3>Listado De Anuncios</h3>
        <form class="form-inline my-2 my-lg-0">
                        <input
                        class="form-control mr-sm-2 buscador"
                        type="search"
                        placeholder="Buscar Anuncio"
                        aria-label="Search"
                        v-model="buscador"
                        @keyup="buscarAnuncio"
                        >
        </form>
        <div>
                    <paginate ref="paginator" name="anuncios" :list="anuncios" :per="20">

            <table class="table-fixed w-full">
                
                <thead>
                    <tr style="text-align: center;" >
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Titulo</th>
                        <th class="border px-4 py-2">DESCRIPCION</th>
                        <th class="border px-4 py-2">NUMERO</th>
                        <th class="border px-4 py-2">IMAGEN</th>
                        <th class="border px-4 py-2">BOTONES</th>
                    </tr>  
                </thead>    
                <tbody>
                    <tr style="text-align: center;" v-for="(item,index) in paginated('anuncios')" :key="item.id">
                        <td  class="border px-14 py-1">{{item.id}}</td>
                        <td  class="border px-14 py-1">{{item.titulo}}</td>
                        <td  class="border px-14 py-1">{{item.descripcion}}</td>
                        <td class="border px-14 py-1"> 
                        <a class="btn btn-success btn-sm" :href="'https://api.whatsapp.com/send?phone='+ item.numero">{{item.numero}} </a>
                        </td>
                        <td  class="border px-14 py-1">
                            <img :src="'/imagen/'+item.imagen" width="40%">
                        </td>                        
                        <td class="border px-4 py-2">
                            <div class="flex justify-center rounded-lg text-lg" role="group">
                                <button class="btn btn-danger btn-sm" @click="eliminarAnuncio(item,index)">Eliminar</button>
            <a class="btn btn-info" :href= "'anuncio/'+item.id">Show</a>

            <a class="btn btn-info" :href= "'anuncio/'+item.id+'/edit'">Editar</a> 
                            </div>
                        </td>
                        
                    </tr>
                </tbody>  
            </table>
                    </paginate>

        </div>     
<!--
    <ul class="list-group my-2">
        <li class="list-group-item" v-for="(item,index) in paginated('anuncios')" :key="item.id">
            <img :src="'/imagen/'+item.imagen" width="50%">
            <h1>{{item.titulo}}</h1>
            <p>{{item.descripcion}}</p>
            <h3>CATEGORIAS</h3>
            <div v-for="(a, i) in item.categorias" :key="i">{{a.nombre}}</div>
            <a class="btn btn-success btn-sm" :href="'https://api.whatsapp.com/send?phone='+ item.numero">{{item.numero}} </a>
            <hr>
            <button class="btn btn-danger btn-sm" @click="eliminarAnuncio(item,index)">Eliminar</button>
            <a class="btn btn-info" :href= "'anuncio/'+item.id">Show</a>
            <a class="btn btn-info" :href= "'anuncio/'+item.id+'/edit'">Editar</a> 
        </li>
    </ul>-->
    <div>
            <paginate-links :classes="{ul: 'pagination',li: 'page-item',a:'page-link'}" for="anuncios" show-step-links="true" :async="true"></paginate-links>

    </div>

            <a class="btn btn-primary" href="/form">Crear Anuncio</a>
            
</div>
    
</template>

<script>
import axios from 'axios';

export default{
data(){
    return{
        anuncios:[],
        anuncio:{titulo: '',descripcion: '',numero: ''},
        paginate: ["anuncios"],
        buscador: '',
        setTimeoutBuscador: ''
    }
},created(){
    this.traerAnuncios();
},
methods:{
    traerAnuncios(){
        axios.get('/anuncio',{
            params: {
                buscador: this.buscador
            }
        })
            .then(res=>{
                this.anuncios = res.data
                console.log(res.data[0].categorias);
        })
    },
    agregar(){
        console.log(this.anuncio.titulo, this.anuncio.descripcion,this.anuncio.numero)
        const params = {titulo:this.anuncio.titulo,descripcion:this.anuncio.descripcion,numero:this.anuncio.numero}
        this.anuncio.titulo = '';
        this.anuncio.descripcion = '';
        this.anuncio.numero = '';
        axios.post('/anuncio',params)
        .then(
            res =>{
                this.anuncios.push(res.data)
            }
        )
    },
    eliminarAnuncio(item,index){
        console.log(item.id);
        axios.delete(`/anuncio/${item.id}`)
        .then(()=>{
            this.anuncios.splice(index,1)
        })
    },
    buscarAnuncio(){
        clearTimeout(this.setTimeoutBuscador)
        this.setTimeoutBuscador = setTimeout((this.traerAnuncios),360)
    }


}
}
</script>