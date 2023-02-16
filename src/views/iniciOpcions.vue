<template>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu Gestor</title>
    </head>

    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner" title="Game Planner"><p class="role" >{{ nomPagina }}</p>
            </div>
            <div class="header-2">
                <RouterLink to="/">
                    <button class="button-2" id="logOut">LOG OUT</button>
                </RouterLink>
            </div>
        </div>

        <div>
            <hr>    
        </div>

        <!-- V-IF segun la usuari que nos llegue -->
        <div class="container">
            <iniciAdmin></iniciAdmin>
            <!-- <iniciGestor></iniciGestor>
            <iniciTecnic></iniciTecnic> -->
        </div>

        <footer>
            <div class="footer">
                <div class="ft1">
                    <img src="../../images/facebook.png" alt="" width="30" height="30" class="imgFooter">
                    <img src="../../images/instagram.png" alt="" width="30" height="30" class="imgFooter">
                    <img src="../../images/twitter.png" alt="" width="30" height="30" class="imgFooter">
                </div>

                <div class="ft2">
                    <button class="ft3">Privacy policy</button>
                    <button class="ft3">Legal warning</button>
                    <button class="ft3">Cookies policy</button>
                </div>
            </div>    
        </footer>

    </body>
    </html>

</template>

<script>
import iniciAdmin from '@/components/iniciAdmin.vue';
// import iniciGestor from '@/components/iniciGestor.vue';
// import iniciTecnic from '@/components/iniciTecnic.vue';
import axios from 'axios';
export default{
    name:"iniciOpcions",
    components:{iniciAdmin },
    data(){
        return{
         nomPagina:this.$route.name,
         tipoUsuario:""
        }
    },
    created(){
        if(sessionStorage.getItem("token") === null){
            this.$router.push('/login') ;
        }
        else{
            //comprobamos que exista
            axios.post('http://localhost/api/',{
                token:sessionStorage.getItem("token")
            }).then((resultado)=>{
                if(resultado){
                 this.tipoUsuario=resultado
                }
                else{
                    this.$router.push('/login') ;
                }
            }
            )
        }
        
    }
    
}
</script>
    
<style src="../../styles/admin.css" scoped>

</style>