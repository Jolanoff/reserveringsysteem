<template>
    <div>
        <div class="container text-center">
            <div class="row">
                <div class="col mt-5">
                    <h3 style="color:#2A9D8F; text-align: left;">Medewerkers overzicht</h3>

                </div>
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>
        </div>

        <div class="container text-center">

            <div class="line mt-3"></div>
            <button type="button" class="btn btn-success mt-2 d-flex" data-bs-toggle="modal"
                data-bs-target="#MedewerkerToevoegen"> <i class="fa-solid fa-plus">Voeg Toe</i></button>
            <div class="row">
                <div class="col">

                </div>
                <div class="mt-2">

                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Gebruiksnaam</th>
                                <th>Wachtwoord</th>
                                <th>Role</th>
                                <th>Wijzigen</th>
                                <th>verwijderen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="users in UsersList" v-bind:key="users">
                                <td>{{users.username}}</td>
                                <td>{{users.password}}</td>
                                <td>{{users.role}}</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#MedewerkerWijzigen"
                                        v-on:click=saveId(users.id,users.username,users.password)><i
                                            class="fa-regular fa-pen-to-square text-warning"></i></a></td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#MedewerkerVerwijderen"
                                        v-on:click=saveId(users.id,users.username,users.password)><i
                                            class="fa-solid fa-trash text-warning"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                </div>
            </div>
        </div>

        <!-- add new user -->

        <div class="modal fade" id="MedewerkerToevoegen" tabindex="-1" aria-labelledby="MedewerkerToevoegenLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MedewerkerToevoegenLabel">Voeg een medewerker toe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Naam:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="AddnickName"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Wachtwoord:</label>
                                <input type="password" class="form-control" id="recipient-name" v-model="Addpassword"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Role:</label>
                                <select class="form-select" v-model="AddRole">
                                    <option>Medewerker</option>
                                    <option>admin</option>
                                </select>
                            </div>
                            <h6 id="Invullen"></h6>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        <button type="submit" class="btn btn-primary" v-on:click="addUser()">Voeg Toe</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit user -->
        <div class="modal fade" id="MedewerkerWijzigen" tabindex="-1" aria-labelledby="MedewerkerToevoegenLabel"
            aria-hidden="true" v-for="users in UsersList" v-bind:key="users">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MedewerkerToevoegenLabel">Medewerker wijzigen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Naam:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="username">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Wachtwoord:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="password">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            v-on:click="editUser()">Wijzig</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete user -->
        <div class="modal" id="MedewerkerVerwijderen" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Verwijderen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Weet je zeker dat u deze medewerker wilt verwijderen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"
                            v-on:click="DelelteUser()">Verwijder</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    data: function () {
        return {
            UsersList: [],
            AddnickName: "",
            Addpassword: "",
            username: "",
            password: "",
            role: "",
            AddRole: "",
        };
    },
    async created() {
        if (!sessionStorage.getItem('role')) {
            location.href = '/'
        }
        const returenddata = await axios.get("http://localhost:8080/reserveringsysteem/src/components/php/process.php?action=read");
        this.UsersList = returenddata.data.users;
        console.log(this.UsersList)

    },

    methods: {
        DelelteUser() {
            location.reload()
            const returenddata = axios.post("http://localhost:8080/reserveringsysteem/src/components/php/process.php?action=delete", { "id": sessionStorage.getItem('Id') });
            this.UsersList = returenddata.data.users;


        },
        addUser() {
            if (this.AddnickName && this.Addpassword && this.AddRole) {
                location.reload()
                const returenddata = axios.post("http://localhost:8080/reserveringsysteem/src/components/php/process.php?action=create", { "username": this.AddnickName, "password": this.Addpassword, "role": this.AddRole, });
                this.UsersList = returenddata.data.users;
            }
            else {
                console.log("je moet alles invullen");
                document.getElementById('Invullen').innerHTML = "U moet alle informatie invullen";
            }

        },

        editUser() {
            location.reload()
            const returenddata = axios.post("http://localhost:8080/reserveringsysteem/src/components/php/process.php?action=update", { "id": sessionStorage.getItem('Id'), "username": this.username, "password": this.password, });
            this.UsersList = returenddata.data.users;

        },
        saveId(id, username, password) {
            sessionStorage.setItem('Id', id)
            this.username = username;
            this.password = password
        },

    }
}


</script>

<style>
.line {

    min-width: 100%;
    height: 3px;
    background-color: #2A9D8F;
}

body {
    background-color: #343a40;
}

.btn-success {
    background-color: #2A9D8F;
}

#Invullen {
    color: red;
}
</style>