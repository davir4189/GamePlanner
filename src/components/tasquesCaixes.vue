<template>
    <div class="container2" :id="item.idTasca">
        <div class="container3">
            <p class="name" id="name">{{ item.nom }}</p>
            <p class="description" id="description">{{ item.descripicio }}</p>
            <p class="datos">INFORMATION</p>
            <p class="trabajador">Date: {{ item.dataTasca }}</p>
            <p class="trabajador">Employee: {{ item.empleat }}</p>
            <p class="trabajador">Priority: {{ item.prioritat }} </p>
            <p class="trabajador ">Status: {{ item.estat }}</p>
        </div>
        <div class="container4" id="map">
            <div class="container5">
                <div class="div2">
                    <RouterLink to="/works/editWork">
                        <!-- hay que poner en onclick y te redireccion con la funcion -->
                        <button class="button" id="edit">EDIT</button>
                    </RouterLink>
                </div>
                <div class="div2-2">
                    <RouterLink to="/works">
                        <button class="button" id="delete">DELETE</button>
                    </RouterLink>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
 
    export default{
        name:"tasquesCaixes",
        props:['item'],
        methods:{
            mirarEstado(){
                if(this.item.estat==="proces"){
                    var divEdit = document.getElementById(this.item.idTasca);
                    divEdit.classList.add("blink");
                }

                if(this.item.estat==="final"){
                    var divEdit2 = document.getElementById(this.item.idTasca);
                    divEdit2.tabIndex = -1;
                    divEdit2.style.opacity = "70%";
                    divEdit2.style.pointerEvents = "none";
                }
            },

            borrarBoton(){
               //Aqui hay una redirccion pasando el item
            }
        },
        mounted(){
            this.mirarEstado();
        }
    }
</script>


<style src="../../styles/works.css" scoped>


</style>