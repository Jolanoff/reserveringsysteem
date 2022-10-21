<template>
    <div class="login-block">
        <h1>Inloggen bij La Rustique</h1>
        <input type="text" id="user" placeholder="gebruikersnaam" name="user" v-model="gebruikersnaam" />
        <input type="password" id="pass" placeholder="wachtwoord" name="pass" v-model="wachtwoord" />
        <button type="submit" v-on:click="Login()">Login</button>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data: function () {
        return {
            UsersList: [],
            gebruikersnaam: "",
            wachtwoord: "",
            role: '',
        };
    },
    created() {
        if (sessionStorage.getItem('role')) location.href = '/home'
    },
    methods: {
        async Login() {
            const returenddata = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/login.php", { "username": this.gebruikersnaam, "password": this.wachtwoord, });
            this.UsersList = returenddata.data;
            this.role = returenddata.data.role;
            sessionStorage.setItem('role', returenddata.data.role)
            sessionStorage.setItem('username', returenddata.data.username)
            if (sessionStorage.getItem('role') != "undefined") location.href = '/home'
        }
    }
}
</script>

<style>
.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #45b828;
    margin: 0 auto;
    margin-top: 15%;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active,
.login-block input:focus {
    border: 1px solid #45b828;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #45b828;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #45b828;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #33801f;
}
</style>