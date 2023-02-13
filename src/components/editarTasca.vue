<template>

        <div class="container">
            <div class="dades1">
                <input type="text" name="name" id="name" placeholder="Name" class="dades2">
                <input type="date" name="date" id="date" placeholder="Date" class="dades2">
            </div>
        </div>

        <div class="container">
            <div class="dades1">
                <select name="equipoLocal" id="equipoLocal" class="dades2">
                    <option disabled selected>Equipo Local</option>
                    <option value="1">Equipo 1</option>
                    <option value="2">Equipo 2</option>
                </select>

                <select name="equipoVisitante" id="equipoVisitante" class="dades2">
                    <option disabled selected>Equipo Visitante</option>
                    <option value="1">Equipo 1</option>
                    <option value="2">Equipo 2</option>
                </select>

                <select name="priority" id="priority" class="dades2">
                    <option disabled selected>Priority</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                </select>

                <select name="user" id="user" class="dades2">
                    <option value="1">Trabajador 1</option>
                    <option value="2">Trabajador 2</option>
                    <option value="3">Trabajador 3</option>
                </select>
            </div>
        </div>

        <div class="container">
            <div class="dades1">
                <input type="text" name="description" id="description" placeholder="Description" class="dades3">
            </div>
        </div>

        <RouterLink to="/works">
            <div class="container">
                <button class="button-1" id="addWork">EDIT WORK</button>
            </div>
        </RouterLink>

</template>

<script>
export default{
    name:"editarTasca"
}
</script>

<style src="../../styles/addWork.css" scoped>

</style>