<template>
    <div>
        <h1 class="mt-5 text-center title">camping plaatsen beschickbaar</h1>
        <div>
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="container d-flex flex-wrap mt-2 mb-2 justify-content-center ">
                        <div class="plekkenCard" v-for="plaats in plaatsen" v-bind:key="plaats">
                            <h2 class="plekkenText">{{plaats.naam}}</h2>
                            <p class="plekkenText">{{plaats.soort}}</p>
                            <p class="plekkenText">prijs: €{{plaats.prijs}}</p>
                        </div>
                    </div>
                    <div class="col">
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
            plaatsen: [],
        };
    },
    async created() {
        if (!sessionStorage.getItem("role")) {
            location.href = "/";
        }
        else {
            const returenddata = await axios.get("http://localhost:8080/reserveringsysteem/src/components/php/getPlekken.php?action=read_bb");
            this.plaatsen = returenddata.data.plaatsen;
            console.log(this.plaatsen);
        }
    },
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

.plekkenCard {
    border: 3px solid rgb(0, 59, 10);
    border-radius: 30px;
    background-color: rgb(0, 179, 155);
    width: 20vh;
    height: 20vh;
    margin: 2%;
}

.title {
    color: white;
    text-transform: uppercase;
    font-family: 'Kanit', sans-serif;
}

.plekkenText {
    margin-top: 3%;
    font-weight: 600;
}
</style>