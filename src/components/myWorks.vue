<template>
    <div class="fitxa" :id="item.idTasca">
        <div class="caja1">
            <div class="name" id="name" name="name">{{ item.nom }}</div>
            <div class="description" id="description" name="description">{{ item.descripicio }}</div>
        </div>
        <div class="caja2">
            <div class="container">
                <select name="estat" :id="'estat-' + item.idTasca" class="status" v-model="estat">
                    <option value="pendent" v-if="item.estat == 'pendent'" selected>pendent</option>
                    <option value="pedent" v-else>pendent</option>
                    <option value="proces" v-if="item.estat == 'proces'" selected>proces</option>
                    <option value="proces" v-else>proces</option>
                    <option value="final" v-if="item.estat == 'final'" selected>final</option>
                    <option value="final" v-else>final</option>
                </select>
            </div>
            <div class="container">
                <input type="text" class="comment" name="comments" :id="'comentari-' + item.idTasca"
                    placeholder="comments..." v-model="comentari">
            </div>
            <div class="container">
                <button class="buttonTasca" :id="'commentButton-' + item.idTasca" name="commentButton"
                    @click="mirarDatos">SAVE</button>
            </div>
            <div class="container">
                <p class="msgFinish" :id="'msgFinish-' + item.idTasca">FINISHED WORK</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "myWorks",
    props: ['item'],
    data() {
        return {
            estat: this.item.estat,
            comentari: this.item.comentari,
        }
    },
    methods: {
        mirarEstado() {
            if (this.item.estat === "final") {
                var divEdit = document.getElementById(this.item.idTasca);
                divEdit.style.opacity = "70%";

                var editButton = document.querySelector('#comentari-' + this.item.idTasca);
                var deleteButton = document.querySelector('#estat-' + this.item.idTasca);
                var sendButton = document.querySelector('#commentButton-' + this.item.idTasca);
                var msgFinish = document.querySelector('#msgFinish-' + this.item.idTasca);
                editButton.disabled = true;
                deleteButton.disabled = true;
                sendButton.disabled = true;
                msgFinish.style.display = "block";
            }
        },
        mirarDatos() {
            const selectStatus = document.querySelector('#estat-' + this.item.idTasca).value;
            const selectComent = document.querySelector('#comentari-' + this.item.idTasca).value;

            if (this.item.comentari != selectComent || this.item.estat != selectStatus) {
                const data = {
                    direccion: this.$route.name,
                    token: sessionStorage.getItem("token"),
                    comentari: selectComent,
                    estat: selectStatus,
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
    },
    mounted() {
        this.mirarEstado();
    }
}
</script>

<style src="../../styles/myWorks.css" scoped></style>