<template>
        <div class="fitxa">
            <div class="caja1">
                <div class="name" id="name" name="name">{{ item.nom }}</div>
                <div class="description" id="description" name="description">{{ item.descripicio }}</div>
            </div>
            <div class="caja2">
                <div class="container">
                    <select name="status" id="status" class="status">
                        <option value="pendent" v-if="item.estat == 'pendent'" selected>pendent</option>
                        <option value="pedent" v-else>pendent</option>
                        <option value="proces" v-if="item.estat == 'proces'" selected>proces</option>
                        <option value="proces" v-else>proces</option>
                        <option value="final" v-if="item.estat == 'final'" selected>final</option>
                        <option value="final" v-else>final</option>
                    </select>
                </div>
                <div class="container">
                    <input type="text" class="comment" name="comments" id="comments" placeholder="comments..." v-model="comentario">
                </div>
                <div class="container">
                    <button class="buttonTasca" id="commentButton" name="commentButton" @click="mirarDatos">SAVE</button>
                </div>
            </div>
        </div>
</template>

<script>
import axios from 'axios';

    export default{
        name:"myWorks",
        props: ['item'],
        data(){
            return{
                selectedOption: this.item.estat,
                comentario: this.item.comentario,
            }
        },
        methods: {
            mirarDatos(){
                const selectStatus = document.getElementById('status').value;
                const selectComent = document.getElementById('comments').value;

                if(this.item.comentario != selectComent || this.item.estat != selectStatus){
                    const data = {
                        direccion: this.$route.name,
                        token: sessionStorage.getItem("token"),
                        comentario: selectComent,
                        estado: selectStatus,
                        idTasca: this.item.idTasca
                    }

                    console.log(data);

                    axios.put('http://localhost/api/', data)
                        .then((resposta) => {
                        console.log(resposta);
                        window.location.reload();
                    })
                }
            }
        }
    }
</script>

<style src="../../styles/myWorks.css" scoped>

</style>