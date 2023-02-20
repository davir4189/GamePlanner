<template>
    <div class="container">
        <div class="dades1">
            <input type="text" name="name" id="name" placeholder="Name" class="dades2" v-model="nom">
            <input type="date" name="date" id="date" placeholder="Date" class="dades2" v-model="data">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <select name="equipoLocal" id="equipoLocal" class="dades2" v-model="equipoLocal">
                <option disabled selected>Equipo Local</option>
                <option value="1">Equipo 1</option>
                <option value="2">Equipo 2</option>
            </select>

            <select name="equipoVisitante" id="equipoVisitante" class="dades2" v-model="equipoVisitante">
                <option disabled selected>Equipo Visitante</option>
                <option value="1">Equipo 1</option>
                <option value="2">Equipo 2</option>
            </select>

            <select name="priority" id="priority" class="dades2" v-model="prioridad">
                <option disabled selected>Priority</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>

            <select name="user" id="user" class="dades2" v-model="trabajador">
                <option value="1">Trabajador 1</option>
                <option value="2">Trabajador 2</option>
                <option value="3">Trabajador 3</option>
            </select>
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <input type="text" name="description" id="description" placeholder="Description" class="dades3" v-model="descripcio">
        </div>
    </div>

    <RouterLink to="/works">
        <div class="container">
            <button class="button-1" id="addWork" @click="añadirTrabajo">ADD WORK</button>
        </div>
    </RouterLink>
</template>

<script>
// import axios from 'axios';

export default {
    name: "afegirTasca",
    // data(){
    //     return{
    //         nom: "",
    //         descripicio: "",
    //         prioritat: "",
    //         trabajador: "",
    //     }
    // },
    // methods: {
    //     //funcion revisar token
    //     añadirTrabajo() {
    //         //no token, mandamos a login
    //         if (sessionStorage.getItem("token") === null) {
    //             this.$router.push('/login');
    //         }
    //         else {
    //             //comprobamos que token existe
    //             axios.post('http://localhost/api/', {
    //                 token: sessionStorage.getItem("token"),
    //                 direccion: this.$route.name,
    //                 nom: this.nom,
    //                 data: this.data,
    //                 equipoLocal: this.equipoLocal,
    //                 equipoVisitante: this.equipoVisitante,
    //                 prioridad: this.prioridad,
    //                 trabajador: this.trabajador,
    //                 descripcio: this.descripcio,

    //             }).then((resultado) => {
    //                 console.log(resultado);
    //                 if (resultado.data.token) {
    //                     console.log(resultado.data)

    //                     if (resultado.data.rol == 'admin' || resultado.data.rol == 'gestor') {

    //                     }
    //                     else{
    //                         this.$router.push('/login');
    //                     }

    //                 }
    //                 else {
    //                     //sino login
    //                     this.$router.push('/login');
    //                 }
    //             }
    //             )
    //         }
    //     }
    // },
    // created(){
    //     this.añadirTrabajo();
    //     console.log(this.$route.name);
    // }
}

</script>

<style src="../../styles/addWork.css" scoped></style>