<template>
    <div class="container">
        <div class="dades1">
            <input type="text" name="name" id="name" placeholder="Name" class="dades2" v-model="nom">
            <input type="date" name="date" id="date" placeholder="Date" class="dades2" v-model="dataTasca">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <select name="priority" id="priority" class="dades2" v-model="prioritat">
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

            <input type="text" id="user" class="dades2" placeholder="id user" v-model="empleat">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <input type="text" name="description" id="description" placeholder="Description" class="dades3" v-model="descripicio">
        </div>
    </div>

    <div class="container">
        <button class="button-1" id="addWork" @click="añadirTrabajo">ADD WORK</button>
    </div>

    <div class="container">
        <p class="msgError1" id="msgError1">ERROR: fill in all fields</p>
        <p class="msgError2" id="msgError2">ERROR: wrong date</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "afegirTasca",
    data(){
        return{
            nom: "",
            dataTasca: "",
            prioritat: "",
            empleat: "",
            descripicio: "",
        }
    },
    methods: {
        añadirTrabajo() {

            if (this.valid() !== true) {
                return;
            }

            axios.post('http://gameplanner.daw.institutmontilivi.cat/api/', {
                token: sessionStorage.getItem("token"),
                direccion: this.$route.name,
                nom: this.nom,
                dataTasca: this.dataTasca,
                prioritat: this.prioritat,
                empleat: this.empleat,
                descripicio: this.descripicio,

            }).then((response) => {
                console.log(response);
                this.$router.push("/works");
            })
            .catch((error) => {
                console.error(error);
            });
        },

        valid(){
            if(this.nom == "" || this.dataTasca == "" || this.prioritat == "" || this.empleat == "" || this.descripicio == "")
            {
                var msgError1 = document.getElementById("msgError1");
                msgError1.style.display = "block";
                return false;
            }

            // Verificar si la fecha es anterior a la fecha actual
            var fechaActual = new Date();
            var fechaIngresada = new Date(this.dataTasca);

            if (fechaIngresada < fechaActual) {
                var msgError2 = document.getElementById("msgError2");
                msgError2.style.display = "block";
                return false;
            }

            return true;
        }
    }
 }

</script>

<style src="../../styles/addWork.css" scoped></style>