<template>

    <div class="container">
        <div class="dades1">
            <input type="text" name="name" id="name" placeholder="Name" class="dades2">
            <input type="text" name="lastName" id="lastName" placeholder="Last name" class="dades2">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <input type="text" name="email" id="email" placeholder="Email" class="dades2">
            <input type="password" name="password" id="password" placeholder="Password" class="dades2">
        </div>
    </div>

    <div class="container">
        <div class="dades1">
            <select name="role" id="role" class="dades3">
                <option disabled selected>Role</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="technical">Technical</option>
            </select>
        </div>
    </div>

    <div class="container">
        <button class="button-1" id="addEmployee">EDIT EMPLOYEE</button>
    </div>
    
</template>
<script>
export default{
    name:"editarUsuari"
}
</script>

<style src="../../styles/addEmployee.css" scoped>

</style>