<template>
    <div>
        <loading v-model:active="isLoading" :can-cancel="false" :is-full-page="fullPage" :color="colorLoader"
            :background-color="backgroundColorLoader" />
        <p id="bezit"></p>
        <h1 class="mt-5 text-center title">Reservering aanmaken</h1>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-5">
                    <h5 class="mt-3 hlabel">Zoek klant bij achternaam:</h5>
                    <v-select :options="filterdArray" v-model="selectedKlant" :change="getSelectedKlantID()">
                    </v-select>
                    <h5 class="mt-3 hlabel">Plek plaats:</h5>
                    <v-select :options="filterdPlaatsen" v-model="selectedPlaats" :change="getSelectedPlekID()">
                    </v-select>
                    <p id="plekk"></p>
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <h5 class="mt-3 hlabel">check in datum:</h5>
                                <Datepicker v-model="checkin" type="date" range :minDate="checkin"
                                    @update:modelValue="handleDate(checkin)" />
                            </div>
                            <div class="col">
                                <h5 class="mt-3 hlabel">aantal dagen:</h5>
                                <vue-number-input v-model="dagen" size="small" :min="1" :max="10" inline controls
                                    class="">
                                </vue-number-input>
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-3 hlabel">aantal personen</h5>
                    <Popper>
                        <button type="button" class="btn btn-success"> <i class="fa-solid fa-person"> :
                                {{ aantaalPersonen
                                        = volwassenen + kinderen12 + kinderen4
                                }} </i></button>
                        <template #content>
                            <div class="popper-text">volwassenen:</div>
                            <vue-number-input v-model="volwassenen" size="small" :min="1" :max="6" inline controls
                                class="">
                            </vue-number-input>
                            <div class="popper-text">Kinderen van 4 tot 12:</div>
                            <vue-number-input v-model="kinderen12" size="small" :min="0" :max="10" inline controls
                                class="">
                            </vue-number-input>
                            <div class="popper-text">kinderen tot 4:</div>
                            <vue-number-input v-model="kinderen4" size="small" :min="0" :max="10" inline controls
                                class="">
                            </vue-number-input>
                        </template>
                    </Popper>
                    <h5 class="mt-3 hlabel">Extra's</h5>
                    <Popper>
                        <button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                        <template #content>
                            <div class="container">
                                <div class="row">
                                    <div class="col d-flex flex-column">
                                        <label for="hond" class="label-text">Hond :&nbsp;</label>
                                        <input class="form-check-input" type="checkbox" id="checkbox" v-model="hond"
                                            @change="calc()" />
                                        <label for="bezoker" class="label-text">Bezoker :&nbsp;</label>
                                        <input class="form-check-input" type="checkbox" id="checkbox" v-model="bezoker"
                                            @change="calc()" />
                                        <label for="auto" class="label-text">Auto :&nbsp;</label>
                                        <input class="form-check-input" type="checkbox" id="checkbox" v-model="auto"
                                            @change="calc()" />
                                        <label for="elektriciteit" class="label-text">elektriciteit :&nbsp;</label>
                                        <input class="form-check-input" type="checkbox" id="checkbox"
                                            v-model="elektriciteit" @change="calc()" />
                                        <label for="wasmachine" class="label-text">wasmachine :&nbsp;</label>
                                        <input class="form-check-input" type="checkbox" id="checkbox"
                                            v-model="wasmachine" @change="calc()" />
                                        <label for="douche" class="label-text">douche :&nbsp;</label>
                                        <input class="form-check-input" type="checkbox" id="checkbox" v-model="douche"
                                            @change="calc()" />
                                        <label for="wasdroger" class="label-text">wasdroger :&nbsp;</label>
                                        <input class="form-check-input" type="checkbox" id="checkbox"
                                            v-model="wasdroger" @change="calc()" />
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Popper>
                </div>
                <div class="col">

                </div>
            </div>
        </div>
        <!-- off canvas -->
        <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" href="">
            <footer class=" text-center text-white footer">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <h4 class="footer-text">Bestelling : ???{{ totaalPrijs }}</h4>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">
                            <h5 class="footer-text">klik om te bevestigen </h5>
                        </div>
                    </div>
                </div>
            </footer>
        </a>
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom"
            aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Bestelling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body large">
                <div class="container text-center">
                    <div class="row">
                        <div class="col" id="Print1">
                            <h4 class="col-tiltle">Bestelling informatie </h4>
                            <p class="bestelling-info">Achternaam : {{ selectedKlant }}</p>
                            <p class="bestelling-info">Plaats : {{ selectedPlaats }}</p>
                            <p class="bestelling-info">Check in datum : {{ startDate }}</p>
                            <p class="bestelling-info">Volwassenen : {{ volwassenen }}</p>
                            <p class="bestelling-info">Kinderen van 4 tot 12 jaar : {{ kinderen12 }}</p>
                            <p class="bestelling-info">Kinderen tot 4 jaar : {{ kinderen4 }}</p>
                            <h3 class="bestelling-info fw-bolder">Prijs : {{ totaalPrijs }}</h3>
                        </div>
                        <div class="col" id="Print2">
                            <h4 class="col-tiltle">Extra's </h4>
                            <p v-if="hond" class="bestelling-info">Hond : 2 euro</p>
                            <p v-if="elektriciteit" class="bestelling-info">Elektriciteit : 2 euro</p>
                            <p v-if="bezoker" class="bestelling-info">Bezoekers : 2 euro</p>
                            <p v-if="douche" class="bestelling-info">Douche : 0.50 euro</p>
                            <p v-if="wasmachine" class="bestelling-info">Wasmachine : 6 euro</p>
                            <p v-if="wasdroger" class="bestelling-info">Wasdroger : 4 euro</p>
                            <p v-if="auto" class="bestelling-info">Auto : 3 euro</p>
                        </div>
                        <div class="col d-flex flex-column">
                            <button type="button" class="btn btn-danger off-btn"
                                v-on:click="refresh()">aanuleren/opnieuw</button>
                            <button type="button" class="btn btn-success off-btn"
                                v-on:click="checkIn()">Check-In</button>

                            <button type="button" class="btn btn-warning off-btn" v-on:click="bonPrinten()">Print
                                bon</button>
                            <p id="vulling"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Datepicker from '@vuepic/vue-datepicker';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    components: { Datepicker, Loading },

    data: function () {
        return {
            //reservation info
            klantenList: [],
            filterdArray: [],
            plaatsen: [],
            filterdPlaatsen: [],
            selectedKlant: "",
            selectedPlaats: "",
            volwassenen: 1,
            kinderen12: 0,
            kinderen4: 0,
            startDate: "",
            endDate: "",
            aantaalPersonen: null,
            checkin: new Date(),
            dagen: 1,
            // get klant id and plek id
            selectedklantId: "",
            selectedPlaatsId: "",
            selectedPlaatsPrijs: "",
            // extra's
            hond: false,
            bezoker: false,
            auto: false,
            elektriciteit: false,
            wasmachine: false,
            douche: false,
            wasdroger: false,
            // total prijs 
            totaalPrijs: 0,
            bestelling: [],
            plaats: [],
            // loading 
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
        const returenddata = await axios.get("http://localhost:8080/reserveringsysteem/src/components/php/getKlanten.php?action=read");
        this.klantenList = returenddata.data.klanten;
        this.klantenList.forEach(klant => {
            this.filterdArray.push(klant.achternaam)
        })

        console.log(this.selectedPlaats)
        const plekkenData = await axios.get("http://localhost:8080/reserveringsysteem/src/components/php/getPlekken.php?action=read_bb");
        this.plaatsen = plekkenData.data.plaatsen;
        this.plaatsen.forEach(plaats => {
            this.filterdPlaatsen.push(plaats.naam)

        })

    },
    methods: {
        async getSelectedKlantID() {
            const returenddata = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/reserveren.php?action=getKlantID", { "achternaam": this.selectedKlant });
            this.selectedklantId = parseInt(returenddata.data.klanten[0].id);


        },
        async getSelectedPlekID() {
            this.selectedPlaatsPrijs = 0;
            const plekkenData = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/reserveren.php?action=getPlekkenID", { "naam": this.selectedPlaats });
            this.selectedPlaatsId = parseInt(plekkenData.data.plekken[0].id);
            this.selectedPlaatsPrijs = parseInt(plekkenData.data.plekken[0].prijs);

            this.calc()


        }
        ,
        calc() {

            this.totaalPrijs = (this.selectedPlaatsPrijs + (this.volwassenen * 5) + (this.kinderen12 * 4)) * this.dagen

            if (this.hond) {
                this.totaalPrijs = this.totaalPrijs + 2
            }
            if (this.bezoker) {
                this.totaalPrijs = this.totaalPrijs + 2
            }
            if (this.elektriciteit) {
                this.totaalPrijs = this.totaalPrijs + 2
            }
            if (this.wasmachine) {
                this.totaalPrijs = this.totaalPrijs + 6
            }
            if (this.wasdroger) {
                this.totaalPrijs = this.totaalPrijs + 4
            }
            if (this.douche) {
                this.totaalPrijs = this.totaalPrijs + 0.50
            }
            if (this.auto) {
                this.totaalPrijs = this.totaalPrijs + 3
            }
        },
        async handleDate(array) {
            this.startDate = new Date(array[0]).toISOString().substring(0, 10);
            this.endDate = new Date(array[1]).toISOString().substring(0, 10);

            if (this.getSelectedPlekID) {
                const returenddata = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/reserveren.php?action=checkPlek", { "klant_id": this.selectedklantId, "plaats_id": this.selectedPlaatsId, "checkin": this.startDate, "checkout": this.endDate, });
                this.bestelling = returenddata.data;
                console.log(this.bestelling.plek)
                if (this.bestelling.plek == "plek beshickbaar") {
                    const plek = document.getElementById('plekk').innerHTML = " <span style='color:#2ad421'> plek beschikbaar </span>";
                    plek.style.color = 'green'
                }
                else {
                    document.getElementById('plekk').innerHTML = " <span style='color:#d42121'>het plek die u gekozen heeft is op deze datum niet beschikbaar</span> ";
                }
            }

        },
        refresh() {
            location.reload()
        },
        async checkIn() {
            if (this.selectedKlant && this.selectedPlaats && this.startDate && this.endDate) {
                const returenddata = await axios.post("http://localhost:8080/reserveringsysteem/src/components/php/reserveren.php?action=create", { "klant_id": this.selectedklantId, "plaats_id": this.selectedPlaatsId, "checkin": this.startDate, "checkout": this.endDate, "dagen": this.dagen, "volwassenen": this.volwassenen, "kinderen12": this.kinderen12, "kinderen4": this.kinderen4, "hond": this.hond, "elektriciteit": this.elektriciteit, "bezoekers": this.bezoker, "douche": this.douche, "wasmachine": this.wasmachine, "wasdroger": this.wasdroger, "auto": this.auto, "kosten": this.totaalPrijs, });
                this.bestelling = returenddata.data;
                console.log(this.bestelling.message)
                if (this.bestelling.message == "Klant is toegevoegd") {
                    this.doAjax()
                }
                else {
                    document.getElementById('bezit').innerHTML = "het plek die u gekozen heeft is op deze datum niet beschikbaar";
                }

            }
            else {
                document.getElementById('vulling').innerHTML = "U moet alle informatie invullen";
            }

        },
        doAjax() {
            this.isLoading = true;
            window.setTimeout(function () {
                location.reload()
                this.isLoading = false
            }, 3000);
        },
        bonPrinten() {
            var divContents = document.getElementById("Print1").innerHTML;
            var divContents2 = document.getElementById("Print2").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Bestelling bon<br>');
            a.document.write(divContents + divContents2);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        },

    },

}
</script>

<style>
.offcanvas,
.offcanvas-lg,
.offcanvas-md,
.offcanvas-sm,
.offcanvas-xl,
.offcanvas-xxl {
    --bs-offcanvas-height: 60vh;
}

:root {
    --popper-theme-background-color: #2A9D8F;
    --popper-theme-background-color-hover: #2A9D8F;
    --popper-theme-text-color: #ffffff;
    --popper-theme-border-width: 0px;
    --popper-theme-border-style: solid;
    --popper-theme-border-radius: 6px;
    --popper-theme-padding: 32px;
    --popper-theme-box-shadow: 0 6px 30px -6px rgba(0, 0, 0, 0.25);
}


.label {
    font-weight: 700;
    color: white;
}

.col-tiltle {
    font-weight: 600;
}

.hlabel {
    color: white;
    font-weight: 600;
}

.form-check-input {
    margin-left: 40%;
}

.footer {
    height: 17vh;
    margin-top: 2%;
    background-color: #264653;
}

.footer-text {
    margin-top: 13%;
    font-weight: 600;
}

.off-btn {
    margin: 3%;
}

#vulling {
    color: red;
}

#bezit {
    color: red;
}
</style>