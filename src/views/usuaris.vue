<template><!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employees</title>
    </head>

    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner" title="Game Planner">
                <p class="role2">Employees</p>
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

        <RouterLink to="employees/addEmployee">
            <div class="containerButton">
                <button class="button-2" id="addEmployee">Add Employee</button>
            </div>
        </RouterLink>

        <div class="container">
            <usuarisCaixes v-for="item in componentes" :key="item.idUsuari" :item="item">

            </usuarisCaixes>
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
import usuarisCaixes from '@/components/usuarisCaixes.vue';
import axios from 'axios';

export default {
    name: "totsUsuaris",
    components: { usuarisCaixes },
    data() {
        return {
            componentes: '',
        }
    },
    methods: {
        getDades() {
            axios.post('http://localhost/api/', {
                direccion: this.$route.name,
                token: sessionStorage.getItem("token"),
            }).then((usuaris) => {
                console.log(usuaris)
                if (usuaris.data.rol) {

                    //ordenar por rol
                    var ordenado = [];

                    for (var i = 0; i < usuaris.data.usuaris.length; i++) {
                        if (usuaris.data.usuaris[i].rol == "admin") {
                            ordenado.push(usuaris.data.usuaris[i])
                        }
                    }

                    for (let i = 0; i < usuaris.data.usuaris.length; i++) {
                        if (usuaris.data.usuaris[i].rol == "gestor") {
                            ordenado.push(usuaris.data.usuaris[i])
                        }
                    }

                    for (let i = 0; i < usuaris.data.usuaris.length; i++) {
                        if (usuaris.data.usuaris[i].rol == "tecnic") {
                            ordenado.push(usuaris.data.usuaris[i])
                        }
                    }

                    console.log(ordenado)
                    this.componentes = ordenado;
                }
            }) //this.dadesUsuaris = usuaris.data.list)
        }
    },
    created() {
        this.getDades();
        console.log(this.$route.name);
    }
}

</script>

<style src="../../styles/employees.css" scoped></style>