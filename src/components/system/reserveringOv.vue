<template>
    <div>
        <loading v-model:active="isLoading" :can-cancel="false" :is-full-page="fullPage" :color="colorLoader"
            :background-color="backgroundColorLoader" />
        <div class="container text-center">
            <div class="row">
                <div class="col mt-5">
                    <h3 class="table-text" style="color:#2A9D8F; text-align: left;">Reserveringen overzicht</h3>
                </div>
                <div class="col">
                </div>
                <div class="col">
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="line mt-3"></div>
            <div class="row">
                <div class="col">
                </div>
                <div class="mt-2">

                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Klant_id</th>
                                <th>Klant</th>
                                <th>Plaats</th>
                                <th>Check-in</th>
                                <th>Dagen</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Verwijderen</th>
                                <th>Cehck Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reservering in reserveringenList" v-bind:key="reservering">
                                <td>{{reservering.klant_id}}</td>
                                <td>{{reservering.voornaam}}</td>
                                <td>{{reservering.naam}}</td>
                                <td>{{reservering.checkin}}</td>
                                <td>{{reservering.dagen}}</td>
                                <td>{{reservering.status}}</td>
                                <td>
                                    <Popper>
                                        <i class="fa-sharp fa-solid fa-circle-exclamation text-warning"></i>
                                        <template #content>
                                            <div class="container text-center">
                                                <div class="row">
                                                    <div class="col">
                                                        <p v-if="reservering.volwassenen != 0">Aantal volwassenen:
                                                            {{reservering.volwassenen}}</p>
                                                        <p v-if="reservering.kinderen12 != 0">Aantal kinderen van 12 tot
                                                            4: {{reservering.kinderen12}}</p>
                                                        <p v-if="reservering.kinderen4 != 0">Aantal kinderen tot 4:
                                                            {{reservering.kinderen12}}</p>
                                                        <p v-if="reservering.hond == 1">Hond : Ja</p>
                                                        <p v-if="reservering.auto == 1">Auto : Ja</p>
                                                        <p v-if="reservering.bezoekers == 1">Bezoekers : Ja</p>
                                                        <p v-if="reservering.douche == 1">Douche : Ja</p>
                                                        <p v-if="reservering.elektriciteit == 1">Elektriciteit : Ja</p>
                                                        <p v-if="reservering.wasdroger == 1">wasdroger : Ja</p>
                                                        <p v-if="reservering.wasmachine == 1">wasmachine : Ja</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </Popper>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#reserveringVerwijderen"
                                        v-on:click=saveId(reservering.bestelling_id)>
                                        <i class="fa-solid fa-trash text-warning"></i></a></td>
                                <td><a href="#"
                                        v-on:click="checkOutId(reservering.bestelling_id, reservering.plaats_id)"><i
                                            class="fa-sharp fa-solid fa-credit-card text-warning"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                </div>
            </div>
        </div>
        <!-- delete reservering -->
        <div class="modal" id="reserveringVerwijderen" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Verwijderen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Weet je zeker dat u deze reservering wilt verwijderen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"
                            v-on:click="deleteReservering()">Verwijder</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    components: { Loading },
    data: function () {

        return {
            reserveringenList: [],
            isLoading: false,
            fullPage: true,
            colorLoader: "#009e4c",
            backgroundColorLoader: "#000000",
        };
    },
    async created() {
        if (!sessionStorage.getItem('role')) {
            location.href = '/'
        }
        const returenddata = await axios.get("http://localhost:8080/reserveringsysteem/src/components/php/getReserveringen.php?action=read");
        this.reserveringenList = returenddata.data.reserveringen
        console.log(this.reserveringenList)
    },
    methods: {
        async deleteReservering() {
            location.reload()
            const returenddata = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getReserveringen.php?action=delete", { "id": sessionStorage.getItem('Id') });
            this.UsersList = returenddata.data.users;
            const plekkenData = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getReserveringen.php?action=checkOutPlaats", { "id": sessionStorage.getItem('plaatsId'), });
            this.reserveringenList = plekkenData.data.bestellingen;
        },
        saveId(id,) {
            sessionStorage.setItem('Id', id)
        },
        checkOutId(ReserveringId, plaatsId) {
            sessionStorage.setItem('reserveringId', ReserveringId)
            sessionStorage.setItem('plaatsId', plaatsId)
            this.checkOut()
        },
        async checkOut() {
            const returenddata = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getReserveringen.php?action=update", { "id": sessionStorage.getItem('reserveringId'), });
            this.reserveringenList = returenddata.data.bestellingen;
            const plekkenData = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getReserveringen.php?action=checkOutPlaats", { "id": sessionStorage.getItem('plaatsId'), });
            this.reserveringenList = plekkenData.data.bestellingen;
            this.isLoading = true;
            window.setTimeout(function () {
                window.location.reload();
                this.isLoading = false
            }, 3000);
        },
    }
}
</script>

<style>
.table-text{
    font-weight: 900;
}
</style>