<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game Planner</title>
    </head>
    <body>
        <div class="div1">
            <img src="../images/logo2.png" class="logo" width="150" height="150" alt=""><br><br>
            <img src="../images/slogan2.png" class="slogan" width="400" height="35" alt="">
        </div>

        <loginComponent>
        
        </loginComponent>

    </body>
    </html>
</template>

<script>
    import loginComponent from '@/components/loginComponent.vue';

    export default{
        name:"loginUsuaris",
        components:{loginComponent}
    }
</script>
    
<style>
html, body{
    height: 100%;
    width: 100%;
    margin: 0;
    display: flex;
    flex-direction: row;
}

.div1{
    height: 100%;
    width: 40%;
    background-color: rgb(0, 85, 20);
    justify-content: center;
    align-content: center;
    display: flex;
    align-items: center;
    flex-direction: column;
}
/* RESPONSIVE */

@media  screen and (max-width: 1100px) {
    .slogan{
        display: none;
    }
}

@media  screen and (max-width: 600px) {
    body{
        flex-direction: column;
        width: 100%;
    }

    .div1{
        width: 100%;
    }

    .div2{
        width: 100%;
    }
}
</style>