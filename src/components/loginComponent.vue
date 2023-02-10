<template>
    <div class="div2">
        <input type="text" class="email" name="email" id="email" title="Email" placeholder="Email">
        <input type="password" class="password" name="password" id="password" title="Password" placeholder="Password">
        <button class="button-login" id="buttonLogin" name="buttonLogin">Log In</button>
    </div>
</template>

<script>
    export default{
        name:"loginComponente"
    }
</script>

<style>
.div2{
    height: 100%;
    width: 60%;
    background-color: rgb(255, 255, 255);
    justify-content: center;
    align-content: center;
    display: flex;
    align-items: center;
    flex-direction: column;
}
.email{
    width: 40%;
    background-color: rgb(0, 85, 20);
    color: white;
    border: 0;
    padding: 5px 10px;
    text-align: center;
    margin-bottom: 30px;
}

.password{
    width: 40%;
    background-color: rgb(0, 85, 20);
    color: white;
    border: 0;
    padding: 5px 10px;
    text-align: center;
    margin-bottom: 30px;
}
.button-login{
    padding: 10px 20px;
    background-color: white;
    color: rgb(0, 85, 20);
    border: 1px solid rgb(0, 85, 20);
}

.button-login:hover{
    background-color: rgb(0, 85, 20);
    color: white;
    transition: 0.3s;
}

::placeholder{
    color: rgb(195, 195, 195);
}
</style>