<template>

    <body>
        <div class="header">
            <div class="header-1">
                <img src="../../images/logo.png" width="50" height="50" alt="Logo Game Planner" title="Game Planner"><p class="role">Manager</p>
            </div>
            <div class="header-2"><button class="button-2" id="logOut">LOG OUT</button></div>
        </div>

        <div>
            <hr>    
        </div>

        <div class="container">
            <div class="div1">
                <button class="works" id="works" name="works">WORKS</button>
            </div>

            <div class="div2">
                <button class="myWorks" id="myWorks" name="myWorks">MY WORKS</button>
            </div>
        </div>

        <footer>
            <div class="footer">
                <p>Game Planner</p>
            </div>    
        </footer>
    </body>

</template>

<script>
    export default{
        name:"iniciGestor"
    }
</script>

<style src="../../styles/gestor.css" scoped>

</style>