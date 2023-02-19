<template>
    <div class="container2">
        <div class="container3">
            <p class="name" id="name">FC BARCELONA - REAL MADRID</p>
            <p class="description" id="description">Partido que jugaran el Futbol Club Barcelona contra el Real Madrid en el Spotify Camp Nou</p>
            <p class="datos">DATOS</p>
            <p><input type="date" class="fehca" name="" id="" disabled></p>
            <p class="trabajador">Trabajador: Endrit Qukovci</p>
            <p class="trabajador">Prioridad: 9</p>
            <p class="trabajador">Estado: Pendiente</p>
            <div class="container5">
                <div class="div2">
                    <RouterLink to="/works/editWork">
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
        <div class="container4" id="map">
            
        </div>
    </div>
</template>

<script>

    export default{
        name:"tasquesCaixes"
    }
</script>

<style src="../../styles/works.css" scoped>

</style>