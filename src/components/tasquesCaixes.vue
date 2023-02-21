<template>
    <div class="container2" :id="item.idTasca">
        <div class="container3">
            <p class="name" id="name">{{ item.nom }}</p>
            <p class="description" id="description">{{ item.descripicio }}</p>
            <p class="datos">INFORMATION</p>
            <p class="trabajador">Date: {{ item.dataTasca }}</p>
            <p class="trabajador">Employee: {{ item.empleat }}</p>
            <p class="trabajador">Priority: {{ item.prioritat }} </p>
            <p class="trabajador2 ">Status: {{ item.estat }}</p>
        </div>
        <div class="container4" id="map">
            <div class="container5">
                <div class="div2">
                    <RouterLink to="/works/editWork">
                        <!-- hay que poner en onclick y te redireccion con la funcion -->
                        <button class="button" :id="'edit-' + item.idTasca">EDIT</button>
                    </RouterLink>
                </div>
                <div class="div2-2" @click="borrar">
                    <!-- <RouterLink to="/works"> -->
                        <button class="button" :id="'delete-' + item.idTasca">DELETE</button>
                    <!-- </RouterLink> -->
                </div>
                <img src="../../images/live.png" alt="" width="90" height="90" class="imgLive" :id="'imgLive-' + item.idTasca">
                <p class="msgError" :id="'msgError-' + item.idTasca">WORK IN PROGRESS</p>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default{
        name:"tasquesCaixes",
        props:['item'],
        methods:{
            //funcion para mirar el estado de la tarea
            mirarEstado(){
                //si proceso estilos diferentes
                if(this.item.estat==="proces"){
                    var divEdit = document.getElementById(this.item.idTasca);
                    divEdit.classList.add("blink");

                    var editButton = document.querySelector('#edit-' + this.item.idTasca);
                    var deleteButton = document.querySelector('#delete-' + this.item.idTasca);
                    var msgError = document.querySelector('#msgError-' + this.item.idTasca);
                    var imgLive = document.querySelector('#imgLive-' + this.item.idTasca);
                    editButton.disabled = true;
                    deleteButton.disabled = true;
                    editButton.style.display = "none";
                    deleteButton.style.display = "none";
                    msgError.style.display = "block";
                    imgLive.style.display = "block";
                }
                //si final estilo diferente
                if(this.item.estat==="final"){
                    var divEdit2 = document.getElementById(this.item.idTasca);
                    divEdit2.tabIndex = -1;
                    divEdit2.style.opacity = "70%";
                    divEdit2.style.pointerEvents = "none";

                    var imgLive2 = document.querySelector('#imgLive-' + this.item.idTasca);
                    imgLive2.style.display = "none";
                }
                //si pendent estilo diferente
                if(this.item.estat==="pendent"){
                    var imgLive3 = document.querySelector('#imgLive-' + this.item.idTasca);
                    imgLive3.style.display = "none";
                }
            },
            //funcion para borrar tarea
            borrar() {
            axios.delete('http://localhost/api/', {
                data: { direccion: this.$route.name,token: sessionStorage.getItem("token"),idTasca: this.item.idTasca  },

            }).then((resposta) => {
                //cuando tarea borrada recargo pagina
                console.log(resposta)
                window.location.reload();
            })
        }
        },
        mounted(){
            this.mirarEstado();
        }
    }
</script>


<style src="../../styles/works.css" scoped>


</style>