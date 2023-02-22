<template>

    <div class="container">
        <div class="dades1">
            <input type="text" name="name" id="name" placeholder="Name" class="dades2" v-model="nom">
            <input type="text" name="lastName" id="lastName" placeholder="Last name" class="dades2" v-model="cognom">
            <input type="text" name="email" id="email" placeholder="Email" class="dades2" v-model="email">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <input type="password" name="password" id="password" placeholder="Password" class="dades2" v-model="contrasenya">
            <input type="password" name="password2" id="password2" placeholder="Confirm password" class="dades2" v-model="contrasenya2">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <select name="role" id="role" class="dades3" v-model="rol">
                <option disabled selected>Role</option>
                <option value="admin">admin</option>
                <option value="gestor">gestor</option>
                <option value="tecnic">tecnic</option>
            </select>
        </div>
    </div>

    <div class="container">
        <button class="button-1" id="addEmployee" @click="crearUsuari">ADD EMPLOYEE</button>
    </div>
    
    <div class="container">
        <p class="msgError1" id="msgError1">ERROR: minimum password characters 8</p>
        <p class="msgError2" id="msgError2">ERROR: confirm password</p>
        <p class="msgError3" id="msgError3">ERROR: fill in all fields</p>
        <p class="msgError4" id="msgError4">ERROR: wrong email </p>
        <p class="msgError5" id="msgError5">ERROR: wrong password (Aa-Zz0-9!)</p>
    </div>

</template>

<script>
import axios from 'axios';

export default{
    name:"afegirUsuari",
    data(){
        return {
            nom: "",
            cognom: "",
            email: "",
            contrasenya: "",
            contrasenya2: "",
            rol: "",
        }
    },
    methods: {
        crearUsuari(){

            if (this.valid() !== true) {
                return;
            }

            axios.post('http://gameplanner.daw.institutmontilivi.cat/api/', {
                token: sessionStorage.getItem("token"),
                direccion: this.$route.name,
                nom: this.nom,
                cognom: this.cognom,
                email: this.email,
                contrasenya: this.contrasenya,
                contrasenya2: this.contrasenya2,
                rol: this.rol,
            })
            .then((response) => {
                console.log(response);
                this.$router.push("/employees");
            })
            .catch((error) => {
                console.error(error);
            })
        },

        valid(){
            // Comprobación de campos vacíos
            if(this.nom == "" || this.cognom == "" || this.email == "" || this.contrasenya == "" || this.rol == "")
            {
                var msgError1 = document.getElementById("msgError3");
                msgError1.style.display = "block";
                return false;
            }

            // Comprobación de longitud de la contraseña
            if(this.contrasenya.length < 8)
            {
                var msgError2 = document.getElementById("msgError1");
                msgError2.style.display = "block";
                return false;
            }

            // Comprobación de contraseñas iguales
            if(this.contrasenya !== this.contrasenya2)
            {
                var msgError3 = document.getElementById("msgError2");
                msgError3.style.display = "block";
                return false;
            }

            // Comprobación de formato de email mediante regex
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!emailRegex.test(this.email))
            {
                var msgError4 = document.getElementById("msgError4");
                msgError4.style.display = "block";
                return false;
            }

            // Comprobación de seguridad de la contraseña
            var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
            if(!passwordRegex.test(this.contrasenya))
            {
                var msgError5 = document.getElementById("msgError5");
                msgError5.style.display = "block";
                return false;
            }

            return true;
        }
    }
}
</script>

<style src="../../styles/addEmployee.css" scoped>

</style>