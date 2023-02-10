<template>
        <div class="fitxa">
            <div class="caja1">
                <div class="name" id="name" name="name">Barcelona - Real Madrid</div>
                <div class="description" id="description" name="description">Partido del Futbol Club Barcelona contra el Real Madrid en el Spotify Camp Nou</div>
                <div class="container">
                    <select class="status" name="status" id="status">
                        <option disabled selected>Status</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <button class="buttonTasca" id="statusButton" name="statusButton">SAVE</button>
                </div>
                <div class="container">
                    <input type="text" class="comment" name="comments" id="comments" placeholder="comments...">
                    <button class="buttonTasca" id="commentButton" name="commentButton">SAVE</button>
                </div>
            </div>
            <div class="caja2">
                <!-- AQUI TIENE QUE IR API GOOGLE MAPS -->
            </div>
        </div>
</template>

<script>
    export default{
        name:"myWorks"
    }
</script>

<style src="../../styles/myWorks.css" scoped>

</style>