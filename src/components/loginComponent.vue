<template>
    <input type="text" class="email" name="email" id="email" title="Email" placeholder="Email" v-model="email">
    <input type="password" class="password" name="password" id="password" title="Password" placeholder="Password" v-model="contrasenya">
    <button class="button-login" id="buttonLogin" name="buttonLogin" @click="login">Log In</button>
    <div class="msgError" id="msgError">wrong username or password</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "loginComponente",
    data() {
        return {
            email:'',
            contrasenya: ''
        }
    },
    methods: {
        //funcion login
        login() {
            //si campos diferente de vacio entra
            if(this.email!="" || this.contrasenya !=""){
            axios.post('http://gameplanner.daw.institutmontilivi.cat/api/', {
                email: this.email,
                contrasenya: this.contrasenya,
                token: sessionStorage.token,
                direccion:this.$route.name
            }).then((resposta)=>{
                console.log(resposta);

                if(resposta.data){              
                    sessionStorage.token=resposta.data.token;
                    //creacion cookie token
                    document.cookie = "token='" + resposta.data.token + "';max-age=3600;path=/";
                    //comprobamos rol y mostramos vista
                    if(resposta.data.rol=='admin'){
                         this.$router.push('/admin') ;
                    }
                    else if(resposta.data.rol=='gestor')
                    {
                        this.$router.push('/manager') ;
                    }
                    else if(resposta.data.rol=='tecnic'){
                        this.$router.push('/technical') ;
                    }

                }             
            })
            //si error, mostramos
            .catch((error) => {
                if(error.response.status === 404)
                {
                    const msgError = document.getElementById("msgError");
                    msgError.style.display = "block";
                    this.email="";
                    this.contrasenya="";
                }
            })
        }
      }
    }
}
</script>

<style src="../../styles/portada.css" scoped>

</style>
