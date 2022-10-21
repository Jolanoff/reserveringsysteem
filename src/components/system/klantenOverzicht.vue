<template>
    <div>
        <div class="container text-center">
            <div class="row">
                <div class="col mt-5">
                    <h3 style="color:#2A9D8F; text-align: left;">klanten overzicht</h3>
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
                data-bs-target="#klantToevoegen"><i class="fa-solid fa-plus">Voeg Toe</i></button>
            <div class="row">
                <div class="col">
                </div>
                <div class="mt-2">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>KlantNr</th>
                                <th>Voornaam</th>
                                <th>Achternaam</th>
                                <th>Adres</th>
                                <th>Postcode</th>
                                <th>Email</th>
                                <th>Telefoon nummer</th>
                                <th>Wijzigen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="klanten in klantenList" v-bind:key="klanten">
                                <td>{{klanten.id}}</td>
                                <td>{{klanten.voornaam}}</td>
                                <td>{{klanten.achternaam}}</td>
                                <td>{{klanten.adres}}</td>
                                <td>{{klanten.postcode}}</td>
                                <td>{{klanten.email}}</td>
                                <td>{{klanten.telefoonNum}}</td>
                                <td><a href="#" data-bs-toggle="modal"
                                        v-on:click=saveId(klanten.id,klanten.voornaam,klanten.achternaam,klanten.adres,klanten.postcode,klanten.email,klanten.telefoonNum)
                                        data-bs-target="#KlantWijzigen">
                                        <i class="fa-regular fa-pen-to-square text-warning"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                </div>
            </div>
        </div>
        <!-- klant toevoegen -->
        <div class="modal fade" id="klantToevoegen" tabindex="-1" aria-labelledby="klantToevoegenLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="klantToevoegenLabel">Voeg een klant toe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Voornaam:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="addVoornaam">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Achternaam:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="addAchternaam">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Adres:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="addAdres">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Postcode:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="addPostcode">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="addEmail">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Telefoon Nummer:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="addTelefoonNum">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            v-on:click="AddKlant()">Voeg Toe</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- wijzig klant -->
        <div class="modal fade" id="KlantWijzigen" tabindex="-1" aria-labelledby="KlantWijzigenLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="KlantWijzigenLabel">Wijzig een klant</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Voornaam:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="voornaam">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Achternaam:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="achternaam">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Adres:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="adres">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Postcode:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="postcode">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="email">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Telefoon Nummer:</label>
                                <input type="text" class="form-control" id="recipient-name" v-model="telefoonNum">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            v-on:click="DelelteKlant()">Verwijderen</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            v-on:click="EditKlant()">Wijzigen</button>
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
            klantenList: [],
            role: "",
            addVoornaam: "",
            addAchternaam: "",
            addAdres: "",
            addPostcode: "",
            addEmail: "",
            addTelefoonNum: "",
            // voor wijzigen en verwijderen
            voornaam: "",
            achternaam: "",
            adres: "",
            postcode: "",
            email: "",
            telefoonNum: "",
        };
    },
    async created() {
        if (!sessionStorage.getItem("role")) {
            location.href = "/";
        }
        const returenddata = await axios.get("http://localhost:8080/reserveringsysteem/src/components/php/getKlanten.php?action=read");
        this.klantenList = returenddata.data.klanten;
        console.log(this.klantenList);
    },
    methods: {
        AddKlant() {
            if (this.addVoornaam || this.addAchternaam || this.addAdres || this.addPostcode || this.addEmail || this.addTelefoonNum) {
                location.reload();
                const returenddata = axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getKlanten.php?action=create", { "voornaam": this.addVoornaam, "achternaam": this.addAchternaam, "adres": this.addAdres, "postcode": this.addPostcode, "email": this.addEmail, "telefoonNum": this.addTelefoonNum, });
                this.klantenList = returenddata.data.klanten;
            }
            else {
                console.log("je moet alles invullen");
                document.getElementById("Invullen").innerHTML = "U moet alle informatie invullen";
            }
        },
        saveId(id, voornaam, achternaam, adres, postcode, email, telefoonNum) {
            sessionStorage.setItem("Id", id);
            this.voornaam = voornaam;
            this.achternaam = achternaam;
            this.adres = adres;
            this.postcode = postcode;
            this.email = email;
            this.telefoonNum = telefoonNum;
        },
        DelelteKlant() {
            location.reload();
            const returenddata = axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getKlanten.php?action=delete", { "id": sessionStorage.getItem("Id") });
            this.klantenList = returenddata.data.klanten;
        },
        EditKlant() {
            location.reload();
            const returenddata = axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getKlanten.php?action=update", { "id": sessionStorage.getItem("Id"), "voornaam": this.voornaam, "achternaam": this.achternaam, "adres": this.adres, "postcode": this.postcode, "email": this.email, "telefoonNum": this.telefoonNum, });
            this.klantenList = returenddata.data.klanten;
        },
    },
}
</script>

<style>

</style>