<template>
    <div>
        <div class="container text-center">
            <div class="row">
                <div class="col mt-5">
                    <h3 class="table-text" style="color:#2A9D8F; text-align: left;">Inkomsten overzicht</h3>
                </div>
                <div class="col">
                </div>
                <div class="col">
                </div>
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
                            <th>Bestelling nummer</th>
                            <th>Klant nummer</th>
                            <th>Bedrag</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="bestelling in reserveringenList" v-bind:key="bestelling">
                            <td>{{bestelling.bestelling_id}}</td>
                            <td>{{bestelling.klant_id}}</td>
                            <td>€{{bestelling.kosten}}</td>
                            <td>{{bestelling.status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
            </div>
        </div>
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
        const returenddata = await axios.get("http://localhost:8080/reserveringsysteem/src/components/php/getReserveringen.php?action=readBestellingen");
        this.reserveringenList = returenddata.data.reserveringen
    },
}
</script>

<style>

</style>