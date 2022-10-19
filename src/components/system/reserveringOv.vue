<template>
    <div>
        <div class="container text-center">
            <div class="row">
                <div class="col mt-5">
                    <h3 style="color:#2A9D8F; text-align: left;">Reserveringen overzicht</h3>
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
                                <th>Klant</th>
                                <th>Plaats</th>
                                <th>Check-in</th>
                                <th>Dagen</th>
                                <th>Details</th>
                                <th>Verwijderen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reservering in reserveringenList" v-bind:key="reservering">
                                <td>{{reservering.voornaam}}</td>
                                <td>{{reservering.naam}}</td>
                                <td>{{reservering.checkin}}</td>
                                <td>{{reservering.dagen}}</td>
                                <td>
                                    <Popper>
                                        <i class="fa-sharp fa-solid fa-circle-exclamation text-warning"></i>
                                        <template #content>
                                            <div class="container text-center">
                                                <div class="row">
                                                    
                                                    <div class="col">
                                                        <p>Aantal volwassenen:</p>
                                                        <p>Aantal volwassenen:</p>
                                                        <p v-if="reservering.hond == 1">Hond :Ja</p>

                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </template>
                                    </Popper>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#reserveringVerwijderen"
                                        v-on:click=saveId(reservering.bestelling_id)>
                                        <i class="fa-solid fa-trash text-warning"></i></a></td>
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

        <!-- details tonen -->
        <!-- delete reservering -->
        <!-- <div class="modal" id="details" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Informatie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Algemeen informatie</h6>
                        
                        <h6>Extra's</h6>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        
                    </div>
                </div>
            </div>
        </div> -->
    </div>

</template>

<script>
import axios from 'axios';
export default {

    data: function () {

        return {
            reserveringenList: [],
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
        deleteReservering() {
            location.reload()
            const returenddata = axios.post("http://localhost:8080/reserveringsysteem/src/components/php/getReserveringen.php?action=delete", { "id": sessionStorage.getItem('Id') });
            this.UsersList = returenddata.data.users;
        },
        saveId(id,) {
            sessionStorage.setItem('Id', id)
        },
    }
}
</script>

<style>

</style>