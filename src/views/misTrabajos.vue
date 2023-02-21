<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./myWorks.css" rel="stylesheet" type="text/css" content="width=device-width, initial-scale=1.0">
        <title>My Works</title>
    </head>
    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner"><p class="role">My Works</p>
            </div>
            <div class="header-2">
                <RouterLink to="/technical">
                    <button class="button-2" id="goBack">GO BACK</button>
                </RouterLink>
            </div>
        </div>
        
        <div>
            <hr>
        </div>

        <div class="container">
            <myWorks v-for="item in componentes" :key="item.idTasca" :item="item">
            
            </myWorks>
        </div>

        <footer>
            <div class="footer">
                <div class="ft1">
                    <img src="../../images/facebook.png" alt="" width="30" height="30" class="imgFooter">
                    <img src="../../images/instagram.png" alt="" width="30" height="30" class="imgFooter">
                    <img src="../../images/twitter.png" alt="" width="30" height="30" class="imgFooter">
                </div>

                <div class="ft4">
                    Game Planner © Authors: Endrit Qukovci and Davi Rodrigues
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
    import myWorks from '@/components/myWorks.vue'
    import axios from 'axios';

    export default{
        name:"misTrabajos",
        components: { myWorks },
        data() {
            return {
                componentes: '',
            }
        },
        methods: {
            getDades(){
                axios.post('http://localhost/api/', {
                    direccion: this.$route.name,
                    token: sessionStorage.getItem("token"),
                }).then((resposta) => {

                    console.log(resposta)

                    if (resposta.data.rol) {

                    //ordenar por estado
                    var ordenado = [];

                    for (var i = 0; i < resposta.data.tasques.length; i++) {
                        if (resposta.data.tasques[i].estat == "proces") {
                            ordenado.push(resposta.data.tasques[i])
                        }
                    }

                    for (let i = 0; i < resposta.data.tasques.length; i++) {
                        if (resposta.data.tasques[i].estat == "pendent") {
                            ordenado.push(resposta.data.tasques[i])
                        }
                    }

                    for (let i = 0; i < resposta.data.tasques.length; i++) {
                        if (resposta.data.tasques[i].estat == "final") {
                            ordenado.push(resposta.data.tasques[i])
                        }
                    }

                    console.log(ordenado)
                    this.componentes = ordenado;
                    }
                })
            }
        },
        created(){
            this.getDades();
            console.log(this.$route.name);
        }
    }
</script>
    
<style src="../../styles/myWorks.css">

</style>