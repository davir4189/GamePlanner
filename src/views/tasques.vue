<template><!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Works</title>
    </head>

    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="">
                <p class="role">Works</p>
            </div>
            <div class="header-2">
                <RouterLink to="/admin">
                    <button class="button-2" id="goBack">GO BACK</button>
                </RouterLink>
            </div>

        </div>

        <div>
            <hr>
        </div>

        <RouterLink to="/works/addWork">
            <div class="containerButton">
                <button class="button-2">ADD TASK</button>
            </div>
        </RouterLink>

        <div class="container">
            <tasquesCaixes v-for="item in componentes" :key="item.idTasca" :item="item">

            </tasquesCaixes>
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
import tasquesCaixes from '@/components/tasquesCaixes.vue';
import axios from 'axios';
console.log("entra");
export default {
    name: "totesTasques",
    components: { tasquesCaixes },
    data() {
        return {
            componentes: ''
        }
    },
    methods: {
        cargarComponentes() {
            axios.post('http://localhost/api/', {
                direccion: this.$route.name,
                token: sessionStorage.getItem("token"),
            }).then((resposta) => {
  
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

                    console.log(resposta)
                    this.componentes = ordenado;
                }
            })
        }
    },
    created() {
        this.cargarComponentes()
       
    }
}
</script>

<style src="../../styles/works.css" scoped></style>